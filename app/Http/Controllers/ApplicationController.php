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
        try {
            // Log the incoming request
            \Log::info('Application submission received', [
                'fields' => array_keys($request->all()),
                'csrf' => $request->has('_token'),
            ]);

            $data = $request->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'course' => 'required|string|max:255',
                'site_program' => 'nullable|string|max:255',
                'soe_program' => 'nullable|string|max:255',
                'ste_program' => 'nullable|string|max:255',
                'sba_program' => 'nullable|string|max:255',
                'sihm_program' => 'nullable|string|max:255',
                'sohs_program' => 'nullable|string|max:255',
                'soh_program' => 'nullable|string|max:255',
                'soc_program' => 'nullable|string|max:255',
                'year_level' => 'required|string|max:255',
                'age' => 'required|string|max:10',
                'id_number' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telephone' => 'required|string|max:255',
                'cropped_picture' => 'required|string',
                'father_name' => 'required|string|max:255',
                'father_age' => 'required|string|max:10',
                'father_occupation' => 'nullable|string|max:255',
                'mother_name' => 'required|string|max:255',
                'mother_age' => 'required|string|max:10',
                'mother_occupation' => 'nullable|string|max:255',
                'father_deceased' => 'nullable|boolean',
                'mother_deceased' => 'nullable|boolean',
                'monthly_income' => 'required|string|max:255',
                'parent_consent' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'is_literate' => 'required|in:0,1',
                'tools' => 'nullable|array',
                'can_commit' => 'required|in:0,1',
                'willing_overtime' => 'required|in:0,1',
                'comfortable_clerical' => 'required|in:0,1',
                'strong_communication' => 'required|in:0,1',
                'willing_training' => 'required|in:0,1',
                'other_skills' => 'nullable|string',
            ]);

            \Log::info('Validation passed');

            // Combine school and program into course field
            $school = $data['course'];
            $program = null;
            
            if ($school === 'SITE' && !empty($data['site_program'])) {
                $program = $data['site_program'];
            } elseif ($school === 'SOE' && !empty($data['soe_program'])) {
                $program = $data['soe_program'];
            } elseif ($school === 'STE' && !empty($data['ste_program'])) {
                $program = $data['ste_program'];
            } elseif ($school === 'SBA' && !empty($data['sba_program'])) {
                $program = $data['sba_program'];
            } elseif ($school === 'SIHM' && !empty($data['sihm_program'])) {
                $program = $data['sihm_program'];
            } elseif ($school === 'SOHS' && !empty($data['sohs_program'])) {
                $program = $data['sohs_program'];
            } elseif ($school === 'SOH' && !empty($data['soh_program'])) {
                $program = $data['soh_program'];
            } elseif ($school === 'SOC' && !empty($data['soc_program'])) {
                $program = $data['soc_program'];
            }

            // Format: "SCHOOL: PROGRAM" if program exists, otherwise just "SCHOOL"
            if ($program) {
                $data['course'] = $school . ': ' . $program;
            }

            // Remove program fields from data array as they're not database columns
            unset($data['site_program'], $data['soe_program'], $data['ste_program'], 
                  $data['sba_program'], $data['sihm_program'], $data['sohs_program'], 
                  $data['soh_program'], $data['soc_program']);

            // Handle cropped picture (base64)
            if ($data['cropped_picture']) {
                $base64Image = $data['cropped_picture'];
                // Extract base64 data and convert to image file
                if (strpos($base64Image, 'data:image') === 0) {
                    $image = substr($base64Image, strpos($base64Image, ',') + 1);
                    $image = base64_decode($image);
                    $filename = 'pictures/' . time() . '_' . uniqid() . '.png';
                    \Storage::disk('public')->put($filename, $image);
                    $data['picture'] = $filename;
                    \Log::info('Picture saved to: ' . $filename);
                }
            }
            // Remove the cropped_picture from data as it's not a database column
            unset($data['cropped_picture']);

            if ($request->hasFile('parent_consent')) {
                $data['parent_consent'] = $request->file('parent_consent')->store('parent_consents', 'public');
                \Log::info('Parent consent saved to: ' . $data['parent_consent']);
            }

            if (isset($data['tools'])) {
                $data['tools'] = json_encode($data['tools']);
            }

            // Convert string values to boolean
            foreach ([
                'is_literate', 'can_commit', 'willing_overtime',
                'comfortable_clerical', 'strong_communication', 'willing_training',
                'father_deceased', 'mother_deceased'
            ] as $field) {
                if (isset($data[$field])) {
                    if (is_string($data[$field])) {
                        $data[$field] = $data[$field] === '1' ? true : false;
                    }
                }
            }

            \Log::info('Creating application with data', [
                'last_name' => $data['last_name'] ?? 'N/A',
                'first_name' => $data['first_name'] ?? 'N/A'
            ]);
            $application = Application::create($data);
            \Log::info('Application created successfully', ['id' => $application->id]);

            // Return JSON response for AJAX request
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Application submitted successfully']);
            }

            // If the user is an admin, redirect to applicants list; otherwise, show thank you page
            if (auth()->check() && auth()->user()->is_admin) {
                return redirect()->route('applications.index')->with('success', 'Application submitted successfully.');
            }
            return view('application.show', compact('application'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error', ['errors' => $e->errors()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            \Log::error('Application submission error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'An error occurred: ' . $e->getMessage()
                ], 422);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
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
