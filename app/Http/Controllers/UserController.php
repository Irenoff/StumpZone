<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.dashboard', compact('users'));
    }

    // Store new user
    public function store(Request $request)
    {
        $validated = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:6',
    'usertype' => 'required|in:admin,user,vendor,deliver',
    'address' => 'nullable|string|max:255',
]);


        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'address'  => $validated['address'] ?? null,
            'usertype' => $validated['usertype'],
        ]);

        return redirect()
            ->route('admin.users.dashboard')
            ->with('success', 'User added successfully!');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('admin.users.dashboard')
            ->with('success', 'User deleted successfully!');
    }
}
