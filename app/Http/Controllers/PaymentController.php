<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Meal;
use App\Models\User;
use App\Models\Bazar;
use App\Models\Payment;
use Illuminate\Http\Request;


class PaymentController extends Controller
{


    public function makePayment(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount'  => 'required|numeric|min:1',
            'date'    => 'required'
        ]);

        Payment::create([
            'user_id' => $request->user_id,
            'amount'  => $request->amount,
            'date'    => $request->date,
        ]);

        return back()->with('success', 'Payment Successful!');
    }


    public function payment()
    {
        $month       = now()->format('Y-m');
        $prevMonth   = now()->subMonth()->format('Y-m');
        $users       = User::all();
        $userCount   = User::count();

        /* ========= Meal Rate ========= */
        $totalMeals = Meal::whereMonth('date', Carbon::parse($month)->month)
            ->selectRaw('SUM(breakfast + lunch + dinner) as meals')
            ->value('meals') ?? 0;

        $totalBazar = Bazar::whereMonth('date', Carbon::parse($month)->month)->sum('amount');
        $mealRate   = $totalMeals > 0 ? round($totalBazar / $totalMeals, 2) : 0;

        /* ========= Build Overview ========= */
        $overview = $users->map(function ($user) use (

            $month,
            $prevMonth,
            $mealRate,
            $userCount
        ) {
            $currentMonthNum = Carbon::parse($month)->month;
            $prevMonthNum    = Carbon::parse($prevMonth)->month;

            // User total meals
            $userMeals = Meal::where('user_id', $user->id)
                ->whereMonth('date', $currentMonthNum)
                ->selectRaw('SUM(breakfast + lunch + dinner) as meals')
                ->value('meals') ?? 0;

            $mealBill = $userMeals * $mealRate;

            // Other shared bill
            $bill = Bill::where('month', $month)->first();
            $otherBill = $bill ? ($bill->total / $userCount + $bill->seat_rent) : 0;

            // Previous Month Due
            $prevBill = Bill::where('month', $prevMonth)->first();
            $prevShared = $prevBill ? ($prevBill->total / $userCount + $prevBill->seat_rent) : 0;

            $prevPaid = Payment::where('user_id', $user->id)
                ->whereMonth('date', $prevMonthNum)
                ->sum('amount');

            $prevDue = max($prevShared - $prevPaid, 0);

            // Total Bill
            $totalBill = $mealBill + $otherBill + $prevDue;

            // Current Paid
            $paid = Payment::where('user_id', $user->id)
                ->whereMonth('date', $currentMonthNum)
                ->sum('amount');

            $due = max($totalBill - $paid, 0);

            return [
                'user'       => $user,
                'meal_bill'  => $mealBill,
                'other_bill' => $otherBill,
                'prev_due'   => $prevDue,
                'total_bill' => $totalBill,
                'paid'       => $paid,
                'due'        => $due,
            ];
        });
        $payment = Payment::whereMonth('date', Carbon::parse($month)->month)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('payment.create', compact('overview', 'month', 'payment'));
    }

    /**
     * Payment Edit
     */
    public function paymentEdit($id)
    {
        $payEdit = Payment::findOrFail($id);
        return view('payment.edit', compact('payEdit'));
    }


    /**
     * Payment Update
     */
    public function paymentupdate(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'date'   => 'required|date'
        ]);
        $payment = Payment::findOrFail($id);

        $payment->update([

            'amount'  => $request->amount,
            'date'    => $request->date,
        ]);

        return redirect()->route('payment.index')->with('success', 'Payment Updated Successfully');
    }
}
