<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadStudentListController extends Controller
{
    // Show the list of students for Head Office
    public function index()
    {
    $students = \App\Models\Student::paginate(9);
    return view('headoffice.studentlists.index', compact('students'));
    }

    // Show a specific student
    public function show($student)
    {
    $student = \App\Models\Student::findOrFail($student);
    return view('headoffice.studentlists.show', compact('student'));
    }
}
