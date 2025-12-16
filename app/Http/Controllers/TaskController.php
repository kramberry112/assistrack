<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\StudentTaskVerified;

class TaskController extends Controller {
    // ...existing code...
    // Office tasks report for sidebar dropdown
    public function officeReport(Request $request)
    {
        $user = auth()->user();
        if ($user && $user->role === 'offices' && $user->office_name) {
            $students = \App\Models\Student::with('user')
                ->where('designated_office', $user->office_name)
                ->whereNotNull('user_id')
                ->get()
                ->map(function($student) {
                    return $student->user;
                })
                ->filter();
        } else {
            $students = \App\Models\Student::with('user')
                ->whereNotNull('user_id')
                ->get()
                ->map(function($student) {
                    return $student->user;
                })
                ->filter();
        }

        // Attach student_tasks_count to each student user (only completed tasks) and filter out students with no completed tasks
        $studentsWithTasks = collect();
        foreach ($students as $studentUser) {
            $completedTasksCount = \App\Models\StudentTask::where('user_id', $studentUser->id)
                ->where('status', 'completed')
                ->count();
            
            if ($completedTasksCount > 0) {
                $studentUser->student_tasks_count = $completedTasksCount;
                $studentsWithTasks->push($studentUser);
            }
        }

        // Get distinct school years from students table
        $availableSchoolYears = \App\Models\Student::distinct()
            ->whereNotNull('school_year')
            ->where('school_year', '!=', '')
            ->pluck('school_year')
            ->sort()
            ->values();
        
        // Available semesters
        $availableSemesters = ['1st Semester', '2nd Semester', 'Summer'];
        
        // Get session values for school year and semester
        $selectedSchoolYear = session('head_school_year', '');
        $selectedSemester = session('head_semester', '');
        
        $currentUser = $user;
        return view('offices.reports.tasks', compact('studentsWithTasks', 'currentUser', 'availableSchoolYears', 'availableSemesters', 'selectedSchoolYear', 'selectedSemester'));
    }

    // Get completed tasks for a specific user (for modal view)
    public function getUserCompletedTasks(Request $request, $userId)
    {
        $user = auth()->user();
        
        // If office user, only allow viewing tasks from their office
        if ($user && $user->role === 'offices' && $user->office_name) {
            $student = \App\Models\Student::where('user_id', $userId)
                ->where('designated_office', $user->office_name)
                ->first();
            
            if (!$student) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }
        
        $tasks = \App\Models\StudentTask::where('user_id', $userId)
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get(['id', 'title', 'description', 'updated_at']);
        
        return response()->json(['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'priority' => 'required|string',
            'due_date' => 'required|date',
            'student_id' => 'required|exists:users,id',
        ]);

        $task = new \App\Models\StudentTask();
        $task->user_id = $request->student_id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->status = 'todo';
        $task->progress = 'not_started';
        $task->verified = true; // Automatically verified
        $task->save();

        // Optionally broadcast event if needed
        // broadcast(new StudentTaskVerified($task->id, $task->user_id));

        return redirect()->route('tasks.index')->with('success', 'Task created and assigned to student.');
    }
    public function create()
    {
        return view('offices.tasks.create');
    }
    public function index()
    {
        $user = auth()->user();
        
        // Filter tasks based on office user's designated office
        if ($user && $user->role === 'offices' && $user->office_name) {
            // Get student IDs assigned to this office
            $assignedStudentIds = \App\Models\Student::where('designated_office', $user->office_name)
                ->whereNotNull('user_id')
                ->pluck('user_id')
                ->toArray();
                
            $tasks = \App\Models\StudentTask::with('user')
                ->whereIn('user_id', $assignedStudentIds)
                ->orderBy('created_at', 'desc')
                ->get();
                
            $students = \App\Models\User::where('role', 'student')
                ->whereIn('id', $assignedStudentIds)
                ->orderBy('name')
                ->get();
        } else {
            // Admin or other roles see all tasks
            $tasks = \App\Models\StudentTask::with('user')->orderBy('created_at', 'desc')->get();
            $students = \App\Models\User::where('role', 'student')->orderBy('name')->get();
        }
        
        return view('offices.tasks.index', compact('tasks', 'students'));
    }

    /**
     * AJAX endpoint to return all student tasks for office tab polling.
     */
    public function ajaxTasks(Request $request)
    {
        $user = auth()->user();
        
        // Filter tasks based on office user's designated office
        if ($user && $user->role === 'offices' && $user->office_name) {
            // Get student IDs assigned to this office
            $assignedStudentIds = \App\Models\Student::where('designated_office', $user->office_name)
                ->whereNotNull('user_id')
                ->pluck('user_id')
                ->toArray();
                
            $tasks = \App\Models\StudentTask::with('user')
                ->whereIn('user_id', $assignedStudentIds)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Admin or other roles see all tasks
            $tasks = \App\Models\StudentTask::with('user')->orderBy('created_at', 'desc')->get();
        }
        
        // Format tasks for frontend
        $formatted = $tasks->map(function($task) {
            return [
                'id' => $task->id,
                'user_name' => $task->user ? $task->user->name : 'Unknown',
                'title' => $task->title,
                'priority' => $task->priority,
                'due_date_formatted' => \Carbon\Carbon::parse($task->due_date)->format('F d, Y'),
                'verified' => (bool)$task->verified,
                'status' => $task->status,
            ];
        });
        return response()->json($formatted);
    }

    public function verify($id)
    {
        $task = \App\Models\StudentTask::findOrFail($id);
        $task->verified = true;
        $task->save();

        // Broadcast verification event for student dashboard
        broadcast(new StudentTaskVerified($task->id, $task->user_id));

        // Send notification to current office user
        $studentName = $task->user ? $task->user->name : 'Unknown Student';
        auth()->user()->notify(new \App\Notifications\TaskVerifiedNotification($task, $studentName));

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Task verified successfully.');
    }
}
