<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class OfficeStudentListController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $officeName = $user && $user->office_name ? $user->office_name : 'Unknown Office';
        
        // Get the student type filter (default to 'assigned')
        $studentType = $request->get('student_type', 'assigned');
        
        $query = Student::query();

        // Filter students based on type
        if ($user && $user->role === 'offices' && $user->office_name) {
            if ($studentType === 'borrowed') {
                // Get students who are assigned as SA to this office but designated to another office
                // Only include approved (active) assignments, not completed ones
                $borrowedStudentIds = \App\Models\SaRequest::where('office', $user->office_name)
                    ->where('status', 'approved')
                    ->whereNotNull('assigned_student_id')
                    ->pluck('assigned_student_id')
                    ->toArray();
                
                // Get students whose designated_office is different from current office
                $query->whereIn('id', $borrowedStudentIds)
                      ->where(function($q) use ($user) {
                          $q->where('designated_office', '!=', $user->office_name)
                            ->orWhereNull('designated_office');
                      });
            } else {
                // Default: show students whose designated_office matches current office
                $query->where('designated_office', $user->office_name);
            }
        }

        if ($request->has('course') && $request->course !== '') {
            $query->where('course', $request->course);
        }
        if ($request->has('year_level') && $request->year_level !== '') {
            $query->where('year_level', $request->year_level);
        }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%$search%")
                  ->orWhere('id_number', 'like', "%$search%")
                  ->orWhere('course', 'like', "%$search%")
                  ->orWhere('year_level', 'like', "%$search%");
            });
        }

        $students = $query->orderBy('created_at', 'desc')->paginate(9)->appends($request->except('page'));
        
        return view('offices.studentlists.index', compact('students', 'officeName', 'studentType'));
    }

    public function requestSa(Request $request)
    {
        $request->validate([
            'requested_count' => 'required|integer|min:1|max:5',
            'description' => 'required|string|max:1000'
        ]);

        $user = auth()->user();
        
        // Check if office already has a pending SA request
        $existingRequest = \App\Models\SaRequest::where('office', $user->office_name)
            ->where('status', 'pending')
            ->first();
            
        if ($existingRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Your office already has a pending SA request. Please wait for admin response.'
            ], 400);
        }

        // Create the SA help request
        $saRequest = \App\Models\SaRequest::create([
            'office' => $user->office_name,
            'description' => $request->description,
            'requested_count' => $request->requested_count,
            'status' => 'pending'
        ]);

        // Notify admins about the new SA request
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\SaRequestCreated($saRequest));
        }

        return response()->json([
            'success' => true,
            'message' => 'SA help request submitted successfully! Admin will find and assign a student assistant to your office.'
        ]);
    }

    public function markAsDone($studentId)
    {
        $user = auth()->user();
        
        // Verify user is an office user
        if (!$user || $user->role !== 'offices' || !$user->office_name) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Find the SA request for this student assigned to this office
        $saRequest = \App\Models\SaRequest::where('office', $user->office_name)
            ->where('assigned_student_id', $studentId)
            ->where('status', 'approved')
            ->first();

        if (!$saRequest) {
            return redirect()->back()->with('error', 'SA assignment not found.');
        }

        // Mark the SA request as completed
        $saRequest->update(['status' => 'completed']);

        return redirect()->route('offices.studentlists.index', ['student_type' => 'borrowed'])
            ->with('success', 'Student assistant marked as done and returned to their designated office.');
    }
}
