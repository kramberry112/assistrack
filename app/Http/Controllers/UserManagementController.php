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