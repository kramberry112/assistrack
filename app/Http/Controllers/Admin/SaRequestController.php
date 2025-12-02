<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaRequest;
use App\Models\User;

class SaRequestController extends Controller
{
    public function index()
    {
        $saRequests = SaRequest::with(['assignedStudent'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.sa-requests.index', compact('saRequests'));
    }

    public function getAvailableStudents()
    {
        // Get students who are not currently assigned as SA
        $students = \App\Models\Student::whereDoesntHave('assignedSaRequests', function($query) {
            $query->where('status', 'approved');
        })->select('id', 'student_name', 'id_number', 'course', 'year_level')
        ->orderBy('student_name')
        ->get();

        return response()->json(['students' => $students]);
    }

    public function assign(Request $request, SaRequest $saRequest)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id'
        ]);

        if ($saRequest->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'This request has already been processed.'
            ], 400);
        }

        $student = \App\Models\Student::findOrFail($request->student_id);

        // Check if student is already assigned as SA elsewhere
        if ($student->isAssignedAsSa()) {
            return response()->json([
                'success' => false,
                'message' => 'This student is already assigned as SA to another office.'
            ], 400);
        }

        $saRequest->update([
            'status' => 'approved',
            'assigned_student_id' => $student->id,
            'assigned_at' => now(),
            'approved_at' => now(),
            'reason' => $request->reason
        ]);

        // Update the student's designated office to show they're now assigned to this office as SA
        $student->update([
            'designated_office' => $saRequest->office
        ]);

        // Notify the student about their assignment
        if ($student->user) {
            $student->user->notify(new \App\Notifications\SaAssigned($saRequest));
        }

        return response()->json([
            'success' => true,
            'message' => 'Student assigned successfully as SA for ' . $saRequest->office . '!'
        ]);
    }

    public function reject(Request $request, SaRequest $saRequest)
    {
        if ($saRequest->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'This request has already been processed.'
            ], 400);
        }

        $saRequest->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'reason' => $request->reason
        ]);

        // Note: No student notification for rejection since it's a department request, not student request

        return response()->json([
            'success' => true,
            'message' => 'SA request rejected successfully!'
        ]);
    }
}
