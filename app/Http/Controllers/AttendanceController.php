<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        // Render the attendance view (create this view if needed)
        return view('offices.attendance.index');
    }
}
