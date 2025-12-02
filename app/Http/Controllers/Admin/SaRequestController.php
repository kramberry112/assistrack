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
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'exists:students,id'
        ]);

        // Allow assignment if request is pending OR if it's approved but not fully assigned
        $assignedCount = $saRequest->getAllAssignedStudents()->count();
        $isFullyAssigned = $assignedCount >= $saRequest->requested_count;
        
        if ($saRequest->status === 'rejected' || $isFullyAssigned) {
            return response()->json([
                'success' => false,
                'message' => $isFullyAssigned ? 'This request is already fully assigned.' : 'This request has been rejected.'
            ], 400);
        }

        $studentIds = $request->student_ids;
        $remainingNeeded = $saRequest->requested_count - $assignedCount;
        
        // Validate the number of students doesn't exceed what's needed
        if (count($studentIds) > $remainingNeeded) {
            return response()->json([
                'success' => false,
                'message' => "Only {$remainingNeeded} more student(s) needed for this request."
            ], 400);
        }

        $students = \App\Models\Student::whereIn('id', $studentIds)->get();

        // Check if any student is already assigned as SA elsewhere
        foreach ($students as $student) {
            if ($student->isAssignedAsSa()) {
                return response()->json([
                    'success' => false,
                    'message' => "Student {$student->student_name} is already assigned as SA to another office."
                ], 400);
            }
        }

        $assignedStudents = [];
        $newAssignmentCount = 0;

        // If this is the first assignment to this request, update the original request
        if ($assignedCount == 0 && $students->count() > 0) {
            $firstStudent = $students->first();
            
            $saRequest->update([
                'status' => 'approved',
                'assigned_student_id' => $firstStudent->id,
                'assigned_at' => now(),
                'approved_at' => now(),
                'reason' => $request->reason
            ]);

            // Update the student's designated office
            $firstStudent->update([
                'designated_office' => $saRequest->office
            ]);

            // Notify the student
            if ($firstStudent->user) {
                $firstStudent->user->notify(new \App\Notifications\SaAssigned($saRequest));
            }

            $assignedStudents[] = $firstStudent->student_name;
            $newAssignmentCount++;
            $students = $students->skip(1);
        }

        // Create additional SA requests for remaining students
        foreach ($students as $student) {
            $assignmentNumber = $assignedCount + $newAssignmentCount + 1;
            $newSaRequest = SaRequest::create([
                'office' => $saRequest->office,
                'description' => $saRequest->description . ' (Multi-assignment #' . $assignmentNumber . ')',
                'requested_count' => 1,
                'status' => 'approved',
                'assigned_student_id' => $student->id,
                'assigned_at' => now(),
                'approved_at' => now(),
                'reason' => $request->reason
            ]);

            // Update student's designated office
            $student->update([
                'designated_office' => $saRequest->office
            ]);

            // Notify the student
            if ($student->user) {
                $student->user->notify(new \App\Notifications\SaAssigned($newSaRequest));
            }

            $assignedStudents[] = $student->student_name;
            $newAssignmentCount++;
        }

        $totalAssigned = $assignedCount + $newAssignmentCount;
        $isNowFullyAssigned = $totalAssigned >= $saRequest->requested_count;
        
        $message = $newAssignmentCount > 1 
            ? $newAssignmentCount . ' students assigned successfully as SAs for ' . $saRequest->office . ': ' . implode(', ', $assignedStudents)
            : 'Student assigned successfully as SA for ' . $saRequest->office . '!';
            
        if ($isNowFullyAssigned) {
            $message .= ' This request is now fully assigned.';
        } else {
            $remaining = $saRequest->requested_count - $totalAssigned;
            $message .= " ({$totalAssigned}/{$saRequest->requested_count} assigned - {$remaining} more needed)";
        }

        return response()->json([
            'success' => true,
            'message' => $message
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
