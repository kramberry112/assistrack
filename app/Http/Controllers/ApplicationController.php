<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('application.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'block' => 'nullable|string|max:255',
            'age' => 'nullable|string|max:10',
            'id_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telephone' => 'nullable|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'father_name' => 'nullable|string|max:255',
            'father_age' => 'nullable|string|max:10',
            'father_occupation' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'mother_age' => 'nullable|string|max:10',
            'mother_occupation' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|string|max:255',
            'is_literate' => 'nullable|boolean',
            'tools' => 'nullable|array',
            'can_commit' => 'nullable|boolean',
            'willing_overtime' => 'nullable|boolean',
            'comfortable_clerical' => 'nullable|boolean',
            'strong_communication' => 'nullable|boolean',
            'willing_training' => 'nullable|boolean',
            'other_skills' => 'nullable|string',
        ]);

        // Handle picture upload
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        // Store tools as JSON
        if (isset($data['tools'])) {
            $data['tools'] = json_encode($data['tools']);
        }

        // Convert checkboxes to boolean
        foreach ([
            'is_literate', 'can_commit', 'willing_overtime', 'comfortable_clerical', 'strong_communication', 'willing_training'
        ] as $field) {
            $data[$field] = isset($data[$field]) ? (bool)$data[$field] : false;
        }

        \App\Models\Application::create($data);
    return redirect('/apply/thankyou');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
