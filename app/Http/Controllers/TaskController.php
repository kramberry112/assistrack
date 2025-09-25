<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Render the tasks view (create this view if needed)
        return view('offices.tasks.index');
    }
}
