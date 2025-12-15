<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentTask;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class HeadDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Auto-detect current school year and semester if not provided
        $currentMonth = (int) date('n');
        $currentYear = (int) date('Y');
        
        // Determine current school year
        if ($currentMonth >= 8) {
            $detectedSchoolYear = $currentYear . '-' . ($currentYear + 1);
        } else {
            $detectedSchoolYear = ($currentYear - 1) . '-' . $currentYear;
        }
        
        // Determine current semester
        if ($currentMonth >= 8 && $currentMonth <= 12) {
            $detectedSemester = '1st Semester';
        } elseif ($currentMonth >= 1 && $currentMonth <= 5) {
            $detectedSemester = '2nd Semester';
        } else {
            $detectedSemester = 'Summer';
        }
        
        // Use request values only if explicitly provided (don't auto-fill)
        $schoolYear = $request->input('school_year');
        $semester = $request->input('semester');

        // Get available school years from students
        $availableYears = Student::select('school_year')
            ->distinct()
            ->whereNotNull('school_year')
            ->orderBy('school_year', 'desc')
            ->pluck('school_year');

        // Total Students (filtered by school year only if specified)
        $studentsQuery = Student::query();
        if ($schoolYear) {
            $studentsQuery->where('school_year', $schoolYear);
        }
        $totalStudents = $studentsQuery->count();

        // Total Tasks (filtered by school year and semester only if specified)
        $tasksQuery = StudentTask::where('status', '!=', 'completed');
        if ($schoolYear) {
            $tasksQuery->where('school_year', $schoolYear);
        }
        if ($semester) {
            $tasksQuery->where('semester', $semester);
        }
        $totalTasks = $tasksQuery->count();

        // Today's Attendance (not filtered by school year/semester as it's date-based)
        $todayAttendance = Attendance::whereDate('created_at', today())->count();

        // Total Grades (filtered by school year and semester only if specified)
        $gradesQuery = Grade::query();
        if ($schoolYear) {
            $gradesQuery->where('school_year', $schoolYear);
        }
        if ($semester) {
            $gradesQuery->where('semester', $semester);
        }
        $totalGrades = $gradesQuery->count();

        // Total Evaluations (filtered by school year and semester only if specified)
        $evaluationsQuery = Evaluation::query();
        if ($schoolYear) {
            $evaluationsQuery->where('school_year', $schoolYear);
        }
        if ($semester) {
            $evaluationsQuery->where('semester', $semester);
        }
        $totalEvaluations = $evaluationsQuery->count();

        return view('headoffice.dashboard.index', compact(
            'totalStudents',
            'totalTasks',
            'todayAttendance',
            'totalGrades',
            'totalEvaluations',
            'schoolYear',
            'semester',
            'availableYears'
        ));
    }
}
