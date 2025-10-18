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
        $evaluations = Evaluation::with(['student', 'evaluator'])
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('headoffice.reports.evaluation', compact('evaluations'));
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
