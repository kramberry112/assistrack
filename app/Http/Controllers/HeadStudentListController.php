<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadStudentListController extends Controller
{
    // Show the list of students for Head Office
    public function index()
    {
        $query = \App\Models\Student::query();
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
        $students = $query->paginate(9)->appends(request()->except('page'));
        return view('headoffice.studentlists.index', compact('students'));
    }

    // Show a specific student
    public function show($student)
    {
    $student = \App\Models\Student::findOrFail($student);
    return view('headoffice.studentlists.show', compact('student'));
    }
}
