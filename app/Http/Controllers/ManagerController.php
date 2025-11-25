<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            'email'    => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'phone'    => 'required|string|max:11',
            'role'     => 'required|in:accountant,operations,member',
            'password' => 'required'
        ]);

        $password = $request->password;
        $user = User::create([
            'name'     => $request->name,
            // 'username' => Str::slug($request->username) . rand(10, 99),
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);
        Mail::to($request->email)->send(new UserRegisterMail($user, $password));

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

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'manager') {
            return back()->withErrors(['Manager cannot be deleted.']);
        }
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }
}
