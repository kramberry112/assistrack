<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('student')->orderBy('created_at', 'desc')->get();
        return view('admin.usermanagement.index', compact('users'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,head,offices'
        ];

        // If role is 'offices', office_name is required
        if ($request->role === 'offices') {
            $rules['office_name'] = 'required|string|max:255';
        }

        $request->validate($rules);

        // Generate standardized email for office accounts
        $email = $request->email;
        if ($request->role === 'offices' && $request->office_name) {
            // Format: officename.offices@cdd.edu.ph
            $officeEmail = strtolower(str_replace(' ', '', $request->office_name));
            $email = $officeEmail . '.offices@cdd.edu.ph';
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'office_name' => $request->role === 'offices' ? $request->office_name : null,
        ]);

        $message = 'User account created successfully!';
        if ($request->role === 'offices') {
            $message .= " Office email: {$email}";
        }

        return redirect()->back()->with('success', $message);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,head,offices,student'
        ];

        // If role is 'offices', office_name is required
        if ($request->role === 'offices') {
            $rules['office_name'] = 'required|string|max:255';
        }

        $request->validate($rules);

        // Handle email generation for office accounts
        $email = $request->email;
        if ($request->role === 'offices' && $request->office_name) {
            // Check if current email is not already in the office format
            $expectedOfficeEmail = strtolower(str_replace(' ', '', $request->office_name)) . '.offices@cdd.edu.ph';
            if ($request->email !== $expectedOfficeEmail) {
                $email = $expectedOfficeEmail;
            }
        }

        // Handle student email format
        if ($request->role === 'student') {
            // Generate student email format if not already set
            $expectedStudentEmail = strtolower(str_replace(' ', '', $request->name)) . '.stud@cdd.edu.ph';
            if ($request->email !== $expectedStudentEmail) {
                $email = $expectedStudentEmail;
            }
        }

        // Update user data
        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $email,
            'role' => $request->role,
            'office_name' => $request->role === 'offices' ? $request->office_name : null,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);

        return redirect()->back()->with('success', 'User account updated successfully!');
    }

    public function destroy(User $user)
    {
        // Prevent deletion of admin users
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot delete administrator accounts.');
        }

        // If user has a student record, remove the user_id link
        if ($user->student) {
            $user->student->user_id = null;
            $user->student->save();
        }

        // Delete the user
        $user->delete();

        return redirect()->back()->with('success', 'User account deleted successfully.');
    }
}