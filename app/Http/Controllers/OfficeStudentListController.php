<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class OfficeStudentListController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Filter students based on the logged-in office user's assigned office
        $user = auth()->user();
        if ($user && $user->role === 'offices' && $user->office_name) {
            $query->where('designated_office', $user->office_name);
        }

        if ($request->has('course') && $request->course !== '') {
            $query->where('course', $request->course);
        }
        if ($request->has('year_level') && $request->year_level !== '') {
            $query->where('year_level', $request->year_level);
        }
        // Remove office filter since office users should only see their assigned students
        // if ($request->has('office') && $request->office !== '') {
        //     $query->where('designated_office', $request->office);
        // }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%$search%")
                  ->orWhere('id_number', 'like', "%$search%")
                  ->orWhere('course', 'like', "%$search%")
                  ->orWhere('year_level', 'like', "%$search%");
                  // Remove designated_office from search since they can only see their own office students
                  // ->orWhere('designated_office', 'like', "%$search%");
            });
        }

        $students = $query->paginate(9)->appends($request->except('page'));
        
        // Pass the office name to the view for display
        $officeName = $user && $user->office_name ? $user->office_name : 'Unknown Office';
        
        return view('offices.studentlists.index', compact('students', 'officeName'));
    }
}
