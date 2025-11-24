<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'email'    => 'required|email|exists:users',
            'password' => 'required',
        ]);
        // Authentication logic goes here
        if (Auth::attempt($credential)) {
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'password' => 'The password is incorrect.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('loginView');
    }




    public function goDashboard()
    {
        if (Auth::check() && Auth::user()->role == 'manager') {
            $user = User::all();
            return view('manager.dashboard', compact('user'));
        } elseif (Auth::check() && Auth::user()->role == 'member') {
            return view('members.dashboard');
        } elseif (Auth::check() && Auth::user()->role == 'accountant') {
            return view('accountant.dashboard');
        } elseif (Auth::check() && Auth::user()->role == 'operations') {
            return view('operations.dashboard');
        }
    }

    public function profile()
    {
        if (Auth::user()->role) {
            return view('profile');
        }
    }

    public function profileSetting()
    {
        if (Auth::user()->role) {
            return view('setting');
        }
    }



    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email',
            'phone'  => 'nullable',
            'dob'    => 'nullable|date',
            'gender' => 'nullable',
            'photo'  => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Keep old photo
        $photo = $user->photo;

        // If new photo uploaded
        if ($request->hasFile('photo')) {

            // Delete old photo (optional)
            if ($user->photo && file_exists(public_path("media/profile/" . $user->photo))) {
                unlink(public_path("media/profile/" . $user->photo));
            }

            // Upload new photo
            $photo = $this->fileUpload($request->file("photo"), "media/profile/");
        }

        $user->update([
            "name"   => $request->name,
            "email"  => $request->email,
            "phone"  => $request->phone,
            "dob"    => $request->dob,
            "gender" => $request->gender,
            "photo"  => $photo,  // Save new or old photo
        ]);

        return back()->with("success", "Profile updated successfully!");
    }
}
