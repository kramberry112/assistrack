<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        // Render the evaluation view (create this view if needed)
        return view('offices.evaluation.index');
    }
}
