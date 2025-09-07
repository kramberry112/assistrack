<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Get authenticated user
        $user = Auth::user();
        $email = $user->email;
        if (str_ends_with($email, '.admin@cdd.edu.ph')) {
            return redirect()->route('Admin');
        } elseif (str_ends_with($email, '.head@cdd.edu.ph')) {
            return redirect()->route('Head');
        } elseif (str_ends_with($email, '.stud@cdd.edu.ph')) {
            return redirect()->route('Student');
        }
        // More appropriate fallback: redirect to login with error
        Auth::logout();
        return redirect()->route('login')->withErrors(['email' => 'Your account type is not recognized.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
