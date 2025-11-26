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





        return view('meal', compact('meals', 'totalMeals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'      => 'required|date',
            'breakfast' => 'required',
            'lunch'     => 'required',
            'dinner'    => 'required',

        ]);
        Meal::updateOrCreate(
            [
                "user_id"   => auth()->id(),
                'date'      => $request->date,
                'breakfast' => $request->breakfast ?? 0,
                'lunch'     => $request->lunch ?? 0,
                'dinner'    => $request->dinner ?? 0
            ]
        );
        return back()->with('success', 'Meal created');
    }

    // আজকের Meal দেখার মেথড
    public function todayMeals()
    {

        $today = Carbon::today()->toDateString();

        $meals = Meal::with('user')
            ->whereDate('date', $today)
            ->orderBy('id', 'DESC')
            ->get();

        return view('manager.meal-today', compact('meals'));
    }

    // Delete a meal
    public function deleteMeal($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();

        return back()->with('success', 'Meal deleted successfully!');
    }
}
