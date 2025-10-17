<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Student;
use App\Models\User;

class EvaluationController extends Controller
{
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('offices.studentlists.evaluation', compact('student'));
    }

    public function submit(Request $request, $studentId)
    {
        $request->validate([
            'department' => 'required|string|max:255',
            'overall_comments' => 'nullable|string',
        ]);

        $evaluation = new Evaluation();
        $evaluation->student_id = $studentId;
        $evaluation->evaluator_id = auth()->id();
        $evaluation->department = $request->department;
        $evaluation->submitted_at = now();

        // Work Skills
        $evaluation->problem_solving = $request->problem_solving;
        $evaluation->writing_skills = $request->writing_skills;
        $evaluation->oral_communication = $request->oral_communication;
        $evaluation->adaptability = $request->adaptability;
        $evaluation->service = $request->service;
        $evaluation->attention_to_detail = $request->attention_to_detail;
        $evaluation->attitude = $request->attitude;

        // Work Attributes
        $evaluation->interpersonal_communication = $request->interpersonal_communication;
        $evaluation->creativity = $request->creativity;
        $evaluation->confidentiality = $request->confidentiality;
        $evaluation->initiative = $request->initiative;
        $evaluation->teamwork = $request->teamwork;
        $evaluation->dependability = $request->dependability;
        $evaluation->punctuality = $request->punctuality;
        $evaluation->making_use_of_time_wisely = $request->making_use_of_time_wisely;

        $evaluation->overall_comments = $request->overall_comments;

        $evaluation->save();

        return response()->json([
            'success' => true,
            'message' => 'Evaluation submitted successfully!',
            'evaluation_id' => $evaluation->id
        ]);
    }

    public function viewSubmitted($id)
    {
        $evaluation = Evaluation::with(['student', 'evaluator'])->findOrFail($id);
        return view('admin.evaluations.view', compact('evaluation'));
    }
}
