<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Detect role from email
        $email = $request->email;
        $role = null;
        if (str_ends_with($email, '.admin@cdd.edu.ph')) {
            $role = 'admin';
        } elseif (str_ends_with($email, '.head@cdd.edu.ph')) {
            $role = 'head';
        } elseif (str_ends_with($email, '.stud@cdd.edu.ph')) {
            $role = 'student';
        } elseif (str_ends_with($email, '.offices@cdd.edu.ph')) {
            $role = 'offices';
        }
        if (!$role) {
            return back()->withErrors(['email' => 'Email must follow the format: username.role@cdd.edu.ph']);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

    event(new Registered($user));

    // Redirect to login page with success message
    return redirect()->route('login')->with('success', 'Registered successfully! Please log in.');
    }
}
