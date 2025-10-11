<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class OfficeStudentListController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->has('course') && $request->course !== '') {
            $query->where('course', $request->course);
        }
        if ($request->has('year_level') && $request->year_level !== '') {
            $query->where('year_level', $request->year_level);
        }
        if ($request->has('office') && $request->office !== '') {
            $query->where('designated_office', $request->office);
        }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%$search%")
                  ->orWhere('id_number', 'like', "%$search%")
                  ->orWhere('course', 'like', "%$search%")
                  ->orWhere('year_level', 'like', "%$search%")
                  ->orWhere('designated_office', 'like', "%$search%");
            });
        }

        $students = $query->paginate(9)->appends($request->except('page'));
        return view('offices.studentlists.index', compact('students'));
    }
}
