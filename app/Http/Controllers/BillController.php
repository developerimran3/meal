<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::all();
        return view('bill.create', compact('bills'));
    }

    public function storeBill(Request $request)
    {
        $request->validate([
            'month'         => 'required',
            'seat_rent'     => 'required|numeric',
            'wifi'          => 'required|numeric',
            'khala'         => 'required|numeric',
        ]);

        // per month 1 Bill Create
        if (Bill::where('month', $request->month)->exists()) {
            return back()->withErrors(['You already added This Month\'s Bill. You cannot add more than once!']);
        }
        $total = $request->seat_rent + $request->wifi + $request->khala + $request->utility_bill;
        Bill::create([
            'month'         => $request->month,
            'seat_rent'     => $request->seat_rent,
            'wifi'          => $request->wifi,
            'khala'         => $request->khala,
            'utility_bill'  => $request->utility_bill,
            'total'         => $total
        ]);

        return back()->with('success', 'Bill Create Successfull!');
    }

    public function calculate($month)
    {
        $users = User::count();
        $bill = Bill::where('month', $month)->first();

        if (!$bill) return "No bill found";

        $otherBills = ($bill->wifi + $bill->khala + $bill->utility) / $users;

        return $otherBills;
    }
}
