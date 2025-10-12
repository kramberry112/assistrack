<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\StudentTaskVerified;

class TaskController extends Controller
{
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
        $tasks = \App\Models\StudentTask::with('user')->orderBy('created_at', 'desc')->get();
        $students = \App\Models\User::where('role', 'student')->orderBy('name')->get();
        return view('offices.tasks.index', compact('tasks', 'students'));
    }

    /**
     * AJAX endpoint to return all student tasks for office tab polling.
     */
    public function ajaxTasks(Request $request)
    {
        $tasks = \App\Models\StudentTask::with('user')->orderBy('created_at', 'desc')->get();
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

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Task verified successfully.');
    }
}
