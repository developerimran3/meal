<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Meal;
use App\Models\User;
use App\Models\Bazar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    /**
     * Meal Show in Meal create Page
     */
    public function index()
    {
        $user = auth()->user();
        $currentMonth = now()->month;
        // one user see har all total meals
        $meals = $user->meals()
            ->whereMonth('date', $currentMonth)
            ->orderBy('date', 'DESC')
            ->get();
        // User own total meals
        $totalMeals = $meals->sum(fn($m) => $m->breakfast + $m->lunch + $m->dinner);


        // All User total meals with Meal Rate 
        $allMeals = Meal::whereMonth('date', $currentMonth)->get();
        $allTotalMeals = $allMeals->sum(fn($m) => $m->breakfast + $m->lunch + $m->dinner);
        // Total Bazar full this month
        $totalBazar = Bazar::whereMonth('date', $currentMonth)->sum('amount');
        // Meal Rate All user Same
        $mealRate = $allTotalMeals > 0 ? round($totalBazar / $allTotalMeals, 2) : 0;
        $mealCost = $totalMeals * $mealRate;


        $currentMonth = now()->format('Y-m');

        $bill = Bill::where('month', $currentMonth)->first();

        $otherBills = $bill->total / $user->count();


        // $otherBills = $payments->whereIn('type', ['rent', 'wifi', 'khala'])->sum('amount'); // payments recorded as bills

        // $paid = $payments->sum('amount');

        // $totalBill = $mealCost + $otherBills;
        // $due = $totalBill - $paid;

        // return view('member.dashboard', compact('meals', 'payments', 'totalMeals', 'mealRate', 'mealCost', 'otherBills', 'paid', 'due'));

        return view('meals.meal-create', compact('meals', 'totalMeals', 'mealRate', 'mealCost', 'otherBills'));
    }
    /** 
     * Meal Create 
     */
    public function store(Request $request)
    {
        $today = now()->toDateString();
        $request->validate([
            'date'      => 'required|date|in:' . $today,
            'breakfast' => 'required|integer|min:0',
            'lunch'     => 'required|integer|min:0',
            'dinner'    => 'required|integer|min:0',
        ]);

        $userId = auth()->id();
        // check if user already added meal today
        $already = Meal::where('user_id', $userId)
            ->whereDate('date', $today)
            ->exists();
        if ($already) {
            return back()->withErrors(['You already added today\'s meal. You cannot add more than once!']);
        }
        //Meal Store with Database
        Meal::create([
            'user_id'   => $userId,
            'date'      => $request->date,
            'breakfast' => $request->breakfast,
            'lunch'     => $request->lunch,
            'dinner'    => $request->dinner,
        ]);

        return back()->with('success', 'Meal added successfully!');
    }

    /**
     * Today Meal Show
     */
    public function todayMeals()
    {
        $today = now()->toDateString();
        $meals = Meal::with('user')
            ->whereDate('date', $today)
            ->orderBy('id', 'DESC')
            ->get();

        return view('meals.today-meal', compact('meals'));
    }

    /** 
     * Meal Delete
     */
    public function deleteMeal($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();

        return back()->with('success', 'Meal deleted successfully!');
    }

    /**
     *  Meal Search 
     */
    public function mealSearch(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);
        $date = $request->date;
        $meals = Meal::with('user')
            ->whereDate('date', $date)
            ->orderBy('id', 'DESC')
            ->get();
        // Total meal for selected date
        $totalMeals = $meals->sum(function ($m) {
            return $m->breakfast + $m->lunch + $m->dinner;
        });
        return view('meals.meal-search', compact('meals', 'date', 'totalMeals'));
    }
}
