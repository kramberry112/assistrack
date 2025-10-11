<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function show($id)
    {
        $student = \App\Models\Student::findOrFail($id);
        return view('offices.studentlists.evaluation', compact('student'));
    }
}
