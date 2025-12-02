<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class OfficeStudentListController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Filter students based on the logged-in office user's assigned office
        $user = auth()->user();
        if ($user && $user->role === 'offices' && $user->office_name) {
            $query->where('designated_office', $user->office_name);
        }

        if ($request->has('course') && $request->course !== '') {
            $query->where('course', $request->course);
        }
        if ($request->has('year_level') && $request->year_level !== '') {
            $query->where('year_level', $request->year_level);
        }
        // Remove office filter since office users should only see their assigned students
        // if ($request->has('office') && $request->office !== '') {
        //     $query->where('designated_office', $request->office);
        // }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%$search%")
                  ->orWhere('id_number', 'like', "%$search%")
                  ->orWhere('course', 'like', "%$search%")
                  ->orWhere('year_level', 'like', "%$search%");
                  // Remove designated_office from search since they can only see their own office students
                  // ->orWhere('designated_office', 'like', "%$search%");
            });
        }

        $students = $query->orderBy('created_at', 'desc')->paginate(9)->appends($request->except('page'));
        
        // Pass the office name to the view for display
        $officeName = $user && $user->office_name ? $user->office_name : 'Unknown Office';
        
        return view('offices.studentlists.index', compact('students', 'officeName'));
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
}
