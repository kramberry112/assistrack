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
        // Filter out multi-assignment duplicates - only show the parent request
        $saRequests = SaRequest::with(['assignedStudent'])
            ->where(function($query) {
                $query->where('description', 'not like', '% (Multi-assignment #%')
                      ->orWhereNull('description');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.sa-requests.index', compact('saRequests'));
    }

    public function getAvailableStudents(Request $request)
    {
        $schoolYear = $request->query('school_year');
        $semester = $request->query('semester');
        
        // Get all students from the student list, filtered by school year and semester only
        $query = \App\Models\Student::select('id', 'first_name', 'last_name', 'middle_name', 'id_number', 'course', 'year_level', 'designated_office');
        
        // Filter by school year and semester (matching what's shown in admin student list)
        if ($schoolYear) {
            $query->where('school_year', $schoolYear);
        }
        
        if ($semester) {
            $query->where('semester', $semester);
        }
        
        $students = $query->orderBy('last_name')->orderBy('first_name')->get();
        
        // Map the students to include the computed student_name
        $students = $students->map(function($student) {
            return [
                'id' => $student->id,
                'student_name' => $student->student_name, // This uses the accessor
                'id_number' => $student->id_number,
                'course' => $student->course,
                'year_level' => $student->year_level,
                'designated_office' => $student->designated_office,
            ];
        });

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

        // Note: We allow students to be "borrowed" by multiple offices
        // A student from CANTEEN can work as SA in ACADS, LIBRARY, etc.
        // This is the "borrowed students" feature

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

            // Note: We don't update the student's designated_office
            // They remain assigned to their original office and appear in "Borrowed Students"

            // Notify the student
            if ($firstStudent->user) {
                $firstStudent->user->notify(new \App\Notifications\SaAssigned($saRequest));
            }

            // Notify the office user
            $officeUser = \App\Models\User::where('office_name', $saRequest->office)
                ->where('role', 'offices')
                ->first();
            if ($officeUser) {
                $officeUser->notify(new \App\Notifications\SaRequestApproved($saRequest));
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

            // Note: We don't update the student's designated_office
            // They remain assigned to their original office and appear in "Borrowed Students"

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

        // Notify the office user that their SA request was rejected
        $officeUser = \App\Models\User::where('office_name', $saRequest->office)
            ->where('role', 'offices')
            ->first();
        if ($officeUser) {
            $officeUser->notify(new \App\Notifications\SaRequestRejected($saRequest));
        }

        return response()->json([
            'success' => true,
            'message' => 'SA request rejected successfully!'
        ]);
    }
}
