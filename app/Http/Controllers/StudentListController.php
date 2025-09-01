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
        ]);
        return redirect()->back()->with('success', 'Student added to list successfully!');
    }
}
