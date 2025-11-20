<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource (all applicants).
     */
    public function index(Request $request)
    {
        $query = Application::query();
        if ($request->has('course') && $request->course != '') {
            $query->where('course', $request->course);
        }
        if ($request->has('year') && $request->year != '') {
            $query->where('year_level', $request->year);
        }
        // Show newest applicants first
        $applications = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.applicants.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource (application form).
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
            'year_level' => 'nullable|string|max:255',
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
            'father_deceased' => 'nullable|boolean',
            'mother_deceased' => 'nullable|boolean',
            'monthly_income' => 'nullable|string|max:255',
            'parent_consent' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'is_literate' => 'nullable|boolean',
            'tools' => 'nullable|array',
            'can_commit' => 'nullable|boolean',
            'willing_overtime' => 'nullable|boolean',
            'comfortable_clerical' => 'nullable|boolean',
            'strong_communication' => 'nullable|boolean',
            'willing_training' => 'nullable|boolean',
            'other_skills' => 'nullable|string',
        ]);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        if ($request->hasFile('parent_consent')) {
            $data['parent_consent'] = $request->file('parent_consent')->store('parent_consents', 'public');
        }

        if (isset($data['tools'])) {
            $data['tools'] = json_encode($data['tools']);
        }

        foreach ([
            'is_literate', 'can_commit', 'willing_overtime',
            'comfortable_clerical', 'strong_communication', 'willing_training',
            'father_deceased', 'mother_deceased'
        ] as $field) {
            $data[$field] = isset($data[$field]) ? (bool)$data[$field] : false;
        }

        $application = Application::create($data);

        // If the user is an admin, redirect to applicants list; otherwise, show thank you page
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('applications.index')->with('success', 'Application submitted successfully.');
        }
        return view('application.show', compact('application'));
    }

    /**
     * Display the specified resource (single applicant details).
     */
    public function show(Application $application)
    {
        return view('admin.applicants.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        return view('application.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        // your update logic here...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        // Delete associated files if they exist
        if ($application->picture) {
            \Storage::disk('public')->delete($application->picture);
        }
        
        if ($application->parent_consent) {
            \Storage::disk('public')->delete($application->parent_consent);
        }
        
        // Delete the application record
        $application->delete();
        
        return redirect()->route('applicants.list')->with('success', 'Deleted successfully');
    }
}
