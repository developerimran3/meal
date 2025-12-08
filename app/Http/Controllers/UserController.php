<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Meal;
use App\Models\User;
use App\Models\Bazar;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\UserOtpSend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginView()
    {
        return view('login');
    }
    /**
     *  User Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'auth'     => 'required',
            'password' => 'required',
        ]);
        //Check login var Email/phone/username
        if (filter_var($credentials['auth'], FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->auth;
            unset($credentials['auth']);
        } else if (preg_match('/^[0-9]{11}$/', $credentials['auth'])) {
            $credentials['phone'] = $request->auth;
            unset($credentials['auth']);
        } else {
            $credentials['username'] = $request->auth;
            unset($credentials['auth']);
        }
        //Authentication logic goes here
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'User Login Successfull!');
        }

        return back()->with('error', 'The password is incorrect.');
    }
    /**
     * User Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('loginView')->with('success', 'Log Out Successfull!');
    }

    /**
     * All Information Show All User Dashboard
     */
    public function goDashboard()
    {
        /** Manager Dashboard Meal, Bazar Detels Show*/
        if (Auth::check() && Auth::user()->role == 'manager') {
            $user = User::all();
            /** Month Meal Show */
            $thisMonth = Carbon::now()->format('F');
            $currentMonth = Carbon::now()->month;
            $meals = Meal::with('user')
                ->whereMonth('date', $currentMonth)
                ->get();
            // all users one Month total meals
            $monthMeals = $meals->sum(function ($m) {
                return $m->breakfast + $m->lunch + $m->dinner;
            });

            // Total Bazar
            $totalBazar = Bazar::whereMonth('date', $currentMonth)
                ->sum('amount');

            // Meal Rate
            $mealRate = $monthMeals > 0 ? round($totalBazar / $monthMeals, 2) : 0;
            $mealBill = $mealRate * $monthMeals;

            //total Received Amount
            $paid = Payment::whereMonth('date', $currentMonth)
                ->sum('amount');
            //total Due
            $month = now()->format('Y-m');

            $billDue = Bill::where('month', $month)->get()
                ->sum(function ($item) {
                    $users = User::count();
                    return $item->total + ($item->seat_rent * $users);
                });

            return view('manager.dashboard', compact('user', 'meals', 'monthMeals', 'thisMonth', 'paid', 'billDue', 'mealBill'));


            /** Member Dashboard Meal, Bazar Detels Show*/
        } elseif (Auth::check() && Auth::user()->role == 'member') {
            return view('members.dashboard');


            /** Account Dashboard Meal, Bazar Detels Show*/
        } elseif (Auth::check() && Auth::user()->role == 'accountant') {
            return view('accountant.dashboard');


            /** Operations Dashboard Meal, Bazar Detels Show*/
        } elseif (Auth::check() && Auth::user()->role == 'operations') {
            /** Month Meal Show For All Users*/
            $thisMonth = Carbon::now()->format('F');
            $currentMonth = Carbon::now()->month;
            $meals = Meal::with('user')
                ->whereMonth('date', $currentMonth)
                ->get();
            // সব user এর পুরো মাসের total meals
            $monthMeals = $meals->sum(function ($m) {
                return $m->breakfast + $m->lunch + $m->dinner;
            });

            /** Today Meal Show */
            $today = Carbon::today()->toDateString();
            $meals = Meal::with('user')
                ->whereDate('date', $today)
                ->get();
            $totalMeals = $meals->sum(function ($m) {
                return $m->breakfast + $m->lunch + $m->dinner;
            });
            // Total Bazar full this month
            $totalBazar = Bazar::whereMonth('date', $currentMonth)->sum('amount');
            return view('operations.dashboard', compact('meals', 'totalMeals', 'monthMeals', 'thisMonth', 'totalBazar'));
        }
    }

    /**
     * Show Profile
     */
    public function profile()
    {
        if (Auth::user()->role) {
            return view('profile');
        }
    }


    /**
     * User Data Update
     */
    public function update(Request $request)
    {
        // valadation 
        $user = Auth::user();
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'phone'   => 'nullable',
            'dob'     => 'nullable|date',
            'photo'   => 'nullable',
        ]);
        // photo Uploade
        $photo = $user->photo;
        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path("media/profile/" . $user->photo))) {
                unlink(public_path("media/profile/" . $user->photo));
            }
            $photo = $this->fileUpload($request->file("photo"), "media/profile/");
        }
        // User Data Update to Data Base
        $user->update([
            "name"    => $request->name,
            "email"   => $request->email,
            "phone"   => $request->phone,
            "dob"     => $request->dob,
            "photo"   => $photo,
        ]);
        return back()->with("success", "Profile updated successfully!");
    }
    /**
     * User Password Change/Update
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);
        // Check current password
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('error', 'Current password does not match.');
        }
        // Update new password
        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    /**
     * Forget Password
     */
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        //Check This email
        $userEmail = User::where('email', $request->email)->first();

        if (!$userEmail) {
            return back()->withErrors([
                'email' => 'The Email User not Found',

            ]);
        }
        $userEmail->active_token = Str::random(40);
        $userEmail->otp = rand(100000, 999999);
        $userEmail->save();
        $userEmail->notify(new UserOtpSend($userEmail));
        return back()->with('success', 'Check Your Email, Reset your Password');
    }

    /**
     * Reset Password Form Show
     */
    public function resetPasswordForm($token)
    {
        return view('reset-password', compact('token'));
    }

    /**
     * Reset Password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp'       => 'required',
            "password"  => "required|confirmed",
        ]);
        //check otp
        $checkOtp = User::where('otp', $request->otp)->first();
        if (!$checkOtp) {
            return back()->withErrors([
                'otp' => 'OTP not Matched',
            ]);
        }
        $checkOtp->password = Hash::make($request->password);
        $checkOtp->otp = null;
        $checkOtp->active_token = null;
        $checkOtp->save();
        return redirect()->route('login')->with('success', 'Password Reset Successfull!');
    }
}
