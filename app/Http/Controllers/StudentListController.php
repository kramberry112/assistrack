<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentListController extends Controller
{
    public function add($id)
    {
        $application = Application::findOrFail($id);
        $student = Student::create([
            'student_name' => $application->student_name,
            'course' => $application->course,
            'year_level' => $application->year_level,
            'id_number' => $application->id_number,
            'age' => $application->age,
            'address' => $application->address,
            'email' => $application->email,
            'telephone' => $application->telephone,
            'picture' => $application->picture,
            // Family background
            'father_name' => $application->father_name,
            'father_age' => $application->father_age,
            'father_occupation' => $application->father_occupation,
            'mother_name' => $application->mother_name,
            'mother_age' => $application->mother_age,
            'mother_occupation' => $application->mother_occupation,
            'monthly_income' => $application->monthly_income,
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
        $students = Student::all();
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
}
