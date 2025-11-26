<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $meals = $user->meals()->whereMonth('date', now()->month)
            ->orderBy('date', 'DESC')
            ->get();
        // $payments = $user->payments()->whereMonth('date', now()->month)->get();

        // calculate totals
        $totalMeals = $meals->sum(function ($m) {
            return $m->breakfast + $m->lunch + $m->dinner;
        });
        // $totalBazar = Bazar::whereMonth('date', now()->month)->sum('amount');
        // $mealRate = $totalMeals > 0 ? round($totalBazar / $totalMeals, 2) : 0;

        // $mealCost = $totalMeals * $mealRate;
        // $otherBills = $payments->whereIn('type', ['rent', 'wifi', 'khala'])->sum('amount'); // payments recorded as bills
        // $paid = $payments->sum('amount');

        // $totalBill = $mealCost + $otherBills;
        // $due = $totalBill - $paid;

        // return view('member.dashboard', compact('meals', 'payments', 'totalMeals', 'mealRate', 'mealCost', 'otherBills', 'paid', 'due'));





        return view('meals.meal-create', compact('meals', 'totalMeals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'      => 'required|date',
            'breakfast' => 'required|integer|min:0',
            'lunch'     => 'required|integer|min:0',
            'dinner'    => 'required|integer|min:0',
        ]);

        $userId = auth()->id();
        $today = now()->toDateString();


        // check if user already added meal today
        $already = Meal::where('user_id', $userId)
            ->whereDate('date', $today)
            ->exists();

        if ($already) {
            return back()->withErrors(['You already added today\'s meal. You cannot add more than once!']);
        }

        Meal::create([
            'user_id'   => $userId,
            'date'      => $request->date,
            'breakfast' => $request->breakfast,
            'lunch'     => $request->lunch,
            'dinner'    => $request->dinner,
        ]);

        return back()->with('success', 'Meal added successfully!');
    }


    // আজকের Meal দেখার মেথড
    public function todayMeals()
    {
        $today = now()->toDateString();
        $meals = Meal::with('user')
            ->whereDate('date', $today)
            ->orderBy('id', 'DESC')
            ->get();

        return view('meals.today-meal', compact('meals'));
    }

    // Delete a meal
    public function deleteMeal($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();

        return back()->with('success', 'Meal deleted successfully!');
    }

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
