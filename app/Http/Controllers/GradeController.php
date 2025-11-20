<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
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


        Grade::create([
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
        $grades = Grade::all();
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
