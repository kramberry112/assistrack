<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadStudentListController extends Controller
{
    // Show the list of students for Head Office
    public function index()
    {
        // Get filters from session (set by dashboard)
        $schoolYear = session('head_school_year');
        $semester = session('head_semester');
        
        $query = \App\Models\Student::query()->orderByDesc('id');
        
        // Apply session filters
        if ($schoolYear) {
            $query->where('school_year', $schoolYear);
        }
        if ($semester) {
            $query->where('semester', $semester);
        }
        
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
        if (request('course')) {
            $query->where('course', request('course'));
        }
        if (request('year_level')) {
            $query->where('year_level', request('year_level'));
        }
        if (request('office')) {
            $query->where('designated_office', request('office'));
        }
        $students = $query->paginate(9)->appends(request()->except('page'));
        return view('headoffice.studentlists.index', compact('students', 'schoolYear', 'semester'));
    }

    // Show a specific student
    public function show($student)
    {
    $student = \App\Models\Student::findOrFail($student);
    return view('headoffice.studentlists.show', compact('student'));
    }
}
