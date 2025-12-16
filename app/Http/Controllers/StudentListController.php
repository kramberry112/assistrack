<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\StudentAccountCreated;

class StudentListController extends Controller
{
    public function updateMatriculation(Request $request, Student $student)
    {
        $request->validate([
            'matriculation' => 'required|string|max:255',
        ]);
        $student->matriculation = $request->input('matriculation');
        $student->save();
        return response()->json(['success' => true, 'matriculation' => $student->matriculation]);
    }
    public function add($id)
    {
        $application = Application::findOrFail($id);
        
        // Determine current semester based on month
        $currentMonth = date('n'); // 1-12
        if ($currentMonth >= 8 && $currentMonth <= 12) {
            $semester = '1st Semester';
        } elseif ($currentMonth >= 1 && $currentMonth <= 5) {
            $semester = '2nd Semester';
        } else {
            $semester = 'Summer';
        }
        
        // Determine school year
        $currentYear = date('Y');
        if ($currentMonth >= 8) {
            // August onwards, school year is current-next year
            $schoolYear = $currentYear . '-' . ($currentYear + 1);
        } else {
            // January to July, school year is previous-current year
            $schoolYear = ($currentYear - 1) . '-' . $currentYear;
        }
        
        $student = Student::create([
            'last_name' => $application->last_name,
            'first_name' => $application->first_name,
            'middle_name' => $application->middle_name,
            'course' => $application->course,
            'year_level' => $application->year_level,
            'id_number' => $application->id_number,
            'age' => $application->age,
            'address' => $application->address,
            'email' => $application->email,
            'telephone' => $application->telephone,
            'picture' => $application->picture,
            'semester' => $semester,
            'school_year' => $schoolYear,
            // Family background
            'father_name' => $application->father_name,
            'father_age' => $application->father_age,
            'father_occupation' => $application->father_occupation,
            'father_deceased' => $application->father_deceased,
            'mother_name' => $application->mother_name,
            'mother_age' => $application->mother_age,
            'mother_occupation' => $application->mother_occupation,
            'mother_deceased' => $application->mother_deceased,
            'monthly_income' => $application->monthly_income,
            'parent_consent' => $application->parent_consent,
            // Computer literacy
            'is_literate' => $application->is_literate,
            'tools' => $application->tools,
            'can_commit' => $application->can_commit,
            'willing_overtime' => $application->willing_overtime,
            'comfortable_clerical' => $application->comfortable_clerical,
            'strong_communication' => $application->strong_communication,
            'willing_training' => $application->willing_training,
            'other_skills' => $application->other_skills,
        ]);
        $application->delete(); // Remove applicant from New Applicants
        return redirect()->route('student.list')->with('success', 'Student added to list successfully!');
    }

    public function index()
    {
    $query = Student::query()->orderBy('created_at', 'desc');
        if (request('keyword')) {
            $keyword = request('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('student_name', 'like', "%$keyword%")
                  ->orWhere('course', 'like', "%$keyword%")
                  ->orWhere('year_level', 'like', "%$keyword%")
                  ->orWhere('id_number', 'like', "%$keyword%")
                  ->orWhere('designated_office', 'like', "%$keyword%");
            });
        }
        if (request('student_name')) {
            $query->where('student_name', 'like', '%' . request('student_name') . '%');
        }
        if (request('course')) {
            $query->where('course', request('course'));
        }
        if (request('year_level')) {
            $query->where('year_level', request('year_level'));
        }
        if (request('id_number')) {
            $query->where('id_number', request('id_number'));
        }
        if (request('office')) {
            $query->where('designated_office', request('office'));
        }
        if (request('semester')) {
            $query->where('semester', request('semester'));
        }
        if (request('school_year')) {
            $query->where('school_year', request('school_year'));
        }
        
        // Check if this is a print request (for getting all students)
        if (request('print') === 'all') {
            $students = $query->paginate(999999)->appends(request()->except('page'));
        } else {
            $students = $query->paginate(9)->appends(request()->except('page'));
        }
        
        return view('admin.studentlists.index', compact('students'));
    }
    public function show(Student $student)
    {
        return view('admin.studentlists.show', compact('student'));
    }
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.list')->with('success', 'Student deleted successfully!');
    }
    public function updateOffice(Request $request, Student $student)
    {
        $request->validate([
            'designated_office' => 'required|string|max:255',
        ]);
        $student->designated_office = $request->input('designated_office');
        $student->save();
        return response()->json(['success' => true, 'office' => $student->designated_office]);
    }

    public function createAccount(Request $request, Student $student)
    {
        // Check if student already has an account
        if ($student->user_id) {
            return redirect()->back()->with('error', 'This student already has an account.');
        }

        // Generate username from student name (lowercase, no spaces)
        $username = strtolower(str_replace(' ', '', $student->student_name));
        
        // Check if username already exists, add number if needed
        $originalUsername = $username;
        $counter = 1;
        while (\App\Models\User::where('username', $username)->exists()) {
            $username = $originalUsername . $counter;
            $counter++;
        }

        // Generate student email format: fullname.stud@cdd.edu.ph
        $emailName = strtolower(str_replace(' ', '', $student->student_name));
        $studentEmail = $emailName . '.stud@cdd.edu.ph';

        // Set default password
        $defaultPassword = 'assistrack2025';

        try {
            // Create user account
            $user = \App\Models\User::create([
                'name' => $student->student_name,
                'username' => $username,
                'email' => $studentEmail,
                'password' => bcrypt($defaultPassword),
                'plain_password' => $defaultPassword,
                'role' => 'student',
            ]);

            // Link student to user
            $student->user_id = $user->id;
            $student->save();

            // Send congratulatory email to the student's registered email
            try {
                Mail::to($student->email)->send(new StudentAccountCreated(
                    $student,
                    $username,
                    $defaultPassword,
                    $studentEmail
                ));
                
                $emailStatus = 'Congratulatory email sent successfully!';
            } catch (\Exception $emailException) {
                // Log the email error but don't fail the account creation
                Log::error('Failed to send student account creation email: ' . $emailException->getMessage());
                $emailStatus = 'Account created but email notification failed to send.';
            }
            
            return redirect()->back()->with('success', "Account created successfully! Username: {$username}, Password: {$defaultPassword}. {$emailStatus}");
            
        } catch (\Exception $e) {
            // If account creation fails, return error
            return redirect()->back()->with('error', 'Failed to create account: ' . $e->getMessage());
        }
    }
}
