<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadController extends Controller
{
    // Show reports page or data
    public function reports(Request $request)
    {
        // You can customize this logic as needed
        return view('headoffice.reports.index');
    }
}
