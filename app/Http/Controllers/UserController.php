<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meal;
use App\Models\User;
use App\Models\Bazar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    /**
     * User Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('loginView');
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
            return view('manager.dashboard', compact('user', 'meals', 'monthMeals', 'thisMonth'));


            /** Member Dashboard Meal, Bazar Detels Show*/
        } elseif (Auth::check() && Auth::user()->role == 'member') {
            $currentMonth = Carbon::now()->month;
            /** My Meal Show */
            $user = auth()->user();
            $meals = $user->meals()->whereMonth('date',  $currentMonth)
                ->orderBy('date', 'DESC')
                ->get();
            $totalMeals = $meals->sum(function ($m) {
                return $m->breakfast + $m->lunch + $m->dinner;
            });


            // All User total meals with Meal Rate 
            $allMeals = Meal::whereMonth('date', $currentMonth)->get();
            $allTotalMeals = $allMeals->sum(fn($m) => $m->breakfast + $m->lunch + $m->dinner);
            // Total Bazar full this month
            $totalBazar = Bazar::whereMonth('date', $currentMonth)->sum('amount');
            // Meal Rate All user Same
            $mealRate = $allTotalMeals > 0 ? round($totalBazar / $allTotalMeals, 2) : 0;

            $mealCost = $totalMeals * $mealRate;
            return view('members.dashboard', compact('meals', 'totalMeals', 'mealRate', 'mealCost'));


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
     * Show Password Reset Page
     */
    public function profileSetting()
    {
        if (Auth::user()->role) {
            return view('setting');
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
}
