<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DashboardRedirectController extends Controller
{
    public function redirect(): RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        switch ($user->role) {
            case 'admin':
                return redirect()->route('Admin');
            case 'head':
                return redirect()->route('Head');
            case 'student':
                return redirect()->route('student.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Your account type is not recognized.']);
        }
    }
}
