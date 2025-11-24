<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    // Show Form
    public function userCreateShow()
    {
        return view('manager.user_create');
    }

    // Store User
    public function userCreate(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'username' => 'required',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:11',
            'role'     => 'required|in:accountant,operations,member',
            'password' => 'required'
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'User created successfully!');
    }
    public function changeRole(Request $request)
    {
        $user = User::all();

        return view('manager.role-change', compact('user'));
    }
    public function changeRoleUpdate(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'role'    => 'required|in:manager,accountant,operations,member',
        ]);

        User::where('id', $request->user_id)->update([
            'role' => $request->role,
        ]);

        return back()->with('success', 'User role updated successfully!');
    }
}
