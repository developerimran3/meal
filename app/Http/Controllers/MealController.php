<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Meal;
use App\Models\User;
use App\Models\Bazar;
use App\Models\Payment;
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
        $month = now()->format('Y-m');

        // One user meals
        $meals = $user->meals()
            ->whereMonth('date', $currentMonth)
            ->orderBy('date', 'DESC')
            ->get();

        // User total meals
        $totalMeals = $meals->sum(fn($m) => $m->breakfast + $m->lunch + $m->dinner);

        // All users total meals
        $allMeals = Meal::whereMonth('date', $currentMonth)->get();
        $allTotalMeals = $allMeals->sum(fn($m) => $m->breakfast + $m->lunch + $m->dinner);


        // Total Bazar
        $totalBazar = Bazar::whereMonth('date', $currentMonth)->sum('amount');

        // Meal rate
        $mealRate = $allTotalMeals > 0 ? round($totalBazar / $allTotalMeals, 2) : 0;

        // Meal cost (rounded)
        $mealCost = round($totalMeals * $mealRate, 2);

        // Others Bill
        $users = User::count();
        $bill = Bill::where('month', $month)->first();

        $otherBills = 0;
        $seatBill = 0;

        if ($bill) {
            $seatBill = $bill->seat_rent;
            $bills = $bill->wifi + $bill->khala + $bill->utility_bill;

            if ($users > 0 && $bills > 0) {
                $otherBills = round($bills / $users, 2);
            }
        }
        $paid = Payment::where('user_id', $user->id)
            ->whereMonth('date', $currentMonth)
            ->sum('amount');

        return view('meals.meal-create', compact('meals', 'totalMeals', 'mealRate', 'mealCost', 'otherBills', 'seatBill', 'paid'));
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
            return back()->with('error', 'You already added today\'s meal. You cannot add more than once!');
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
