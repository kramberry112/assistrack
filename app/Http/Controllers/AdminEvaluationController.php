<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;

class AdminEvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with(['student', 'evaluator'])
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('admin.reports.evaluation', compact('evaluations'));
    }

    public function headOfficeIndex()
    {
        // Get filters from session (set by dashboard)
        $schoolYear = session('head_school_year');
        $semester = session('head_semester');
        
        // Get distinct school years from students table
        $availableSchoolYears = \App\Models\Student::distinct()
            ->whereNotNull('school_year')
            ->pluck('school_year')
            ->sort()
            ->values();
        
        // Available semesters
        $availableSemesters = ['1st Semester', '2nd Semester', 'Summer'];
        
        $query = Evaluation::with(['student', 'evaluator']);
        
        // Apply filters if set
        if ($schoolYear || $semester) {
            $query->whereHas('student', function($q) use ($schoolYear, $semester) {
                if ($schoolYear) {
                    $q->where('school_year', $schoolYear);
                }
                if ($semester) {
                    $q->where('semester', $semester);
                }
            });
        }
        
        $evaluations = $query->orderBy('submitted_at', 'desc')->get();

        return view('headoffice.reports.evaluation', compact('evaluations', 'availableSchoolYears', 'availableSemesters', 'schoolYear', 'semester'));
    }

    public function view($id)
    {
        $evaluation = Evaluation::with(['student', 'evaluator'])->findOrFail($id);
        
        // Check if request is from head office
        if (request()->routeIs('head.*')) {
            return view('headoffice.evaluations.view-fullpage', compact('evaluation'));
        }
        
        return view('admin.evaluations.view-fullpage', compact('evaluation'));
    }
}
