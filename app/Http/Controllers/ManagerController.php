<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\UserRegisterMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ManagerController extends Controller
{
    /**
     * Show User Create Form
     */
    public function userCreateShow()
    {
        return view('manager.user_create');
    }

    /**
     * Store User Create
     */
    public function userCreate(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'set_no'   => 'required|string|max:255|unique:users,set_no',
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
            'set_no'   => $request->set_no,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);
        //send Mail
        Mail::to($user->email)->send(new UserRegisterMail($user, $password));

        return redirect()->back()->with('success', 'User created successfully!');
    }

    /**
     * Role Management Show
     */
    public function changeRole(Request $request)
    {
        $user = User::all();
        return view('manager.role-change', compact('user'));
    }

    /**
     * Role Management Change
     */
    public function changeRoleUpdate(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'role'    => 'required|in:manager,accountant,operations,member',
        ]);
        // Update Role And Set No
        User::where('id', $request->user_id)->update([
            'role'   => $request->role,
        ]);
        return back()->with('success', 'User role updated successfully!');
    }

    /**
     * Role Management Change
     */
    public function changeSet(Request $request)
    {
        $request->validate([
            'user_id'   => 'required',
            // 'set_no'    => 'required|unique:users,set_no',
            'set_no'    => 'required|unique:users,set_no|in:1,2,3,4,5,6,7,8,9,10',
        ]);
        // Update Role And Set No
        User::where('id', $request->user_id)->update([
            'set_no'   => $request->set_no,
        ]);
        return back()->with('success', 'User Set No updated successfully!');
    }

    /**
     * Delete Users
     */
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
