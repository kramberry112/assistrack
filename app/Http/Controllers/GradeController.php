<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller {
    // ...existing code...
    // Office grades report for sidebar dropdown
    public function officeReport(Request $request)
    {
        $user = auth()->user();
        if ($user && $user->role === 'offices' && $user->office_name) {
            $studentIds = \App\Models\Student::where('designated_office', $user->office_name)
                ->pluck('id')->toArray();
            $grades = \App\Models\Grade::whereIn('student_id', $studentIds)
                ->with(['student', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $grades = \App\Models\Grade::with(['student', 'user'])->orderBy('created_at', 'desc')->get();
        }
        
        // Get distinct school years from students table
        $availableSchoolYears = \App\Models\Student::distinct()
            ->whereNotNull('school_year')
            ->where('school_year', '!=', '')
            ->pluck('school_year')
            ->sort()
            ->values();
        
        // Available semesters
        $availableSemesters = ['1st Semester', '2nd Semester', 'Summer'];
        
        // Get session values for school year and semester
        $selectedSchoolYear = session('head_school_year', '');
        $selectedSemester = session('head_semester', '');
        
        return view('offices.reports.grades', compact('grades', 'availableSchoolYears', 'availableSemesters', 'selectedSchoolYear', 'selectedSemester'));
    }

    // Office grade details fullpage
    public function officeGradeDetails(Request $request)
    {
        $id = $request->input('id');
        $grade = \App\Models\Grade::findOrFail($id);
        return view('offices.reports.grade-details-fullpage', compact('grade'));
    }
// removed stray curly brace
    // Student submits grades
    public function store(Request $request)
    {
        $subjects = json_decode($request->subjects, true);
        $request->merge(['subjects' => $subjects]);
        $request->validate([
            'student_name' => 'required|string',
            'year_level' => 'required|string',
            'semester' => 'required|string',
            'subjects' => 'required|array',
            'subjects.*.subject' => 'required|string',
            'subjects.*.grade' => 'required|string',
            'subjects.*.remarks' => 'required|string',
            'proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'scheduleFileInput' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $proofUrl = null;
        if ($request->hasFile('proof')) {
            $proofUrl = $request->file('proof')->store('grades', 'public');
        }

        $scheduleUrl = null;
        if ($request->hasFile('scheduleFileInput')) {
            $scheduleUrl = $request->file('scheduleFileInput')->store('schedules', 'public');
        }

        // Get current user and their student record
        $user = auth()->user();
        $student = $user->student;

        Grade::create([
            'student_id' => $student ? $student->id : null,
            'user_id' => $user->id,
            'student_name' => $request->student_name,
            'year_level' => $request->year_level,
            'semester' => $request->semester,
            'subjects' => $subjects,
            'proof_url' => $proofUrl,
            'schedule_url' => $scheduleUrl,
        ]);

        return redirect()->route('student.grades')->with('success', 'Grades submitted successfully!');
    }

    // Show student grades form
    public function showForm()
    {
        return view('students.grades.index');
    }

    // Admin views all grades
    public function index()
    {
        $grades = Grade::with(['student', 'user'])->orderBy('created_at', 'desc')->get();
        return view('admin.reports.grades', compact('grades'));
    }

    // Admin views details for a single grade
    public function show($id)
    {
        $grade = Grade::findOrFail($id);
        
        // Check if request is from head office
        if (request()->routeIs('head.*')) {
            return view('headoffice.reports.grade-details-fullpage', compact('grade'));
        }
        
        return view('admin.reports.grade-details-fullpage', compact('grade'));
    }
}
