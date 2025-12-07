<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index($month = null)
    {
        $bill = $month ? Bill::where('month', $month)->first() : null;
        $allBills = Bill::orderBy('month', 'DESC')->get();

        return view('bill.create', compact('bill', 'allBills'));
    }


    public function storeBill(Request $request)
    {
        $request->validate([
            'month'         => 'required',
            'seat_rent'     => 'required|numeric',
        ]);
        // per month 1 Bill Create
        if (Bill::where('month', $request->month)->exists()) {
            return back()->with('error', 'You already added This Month\'s Bill. You cannot add more than once!');
        }
        Bill::create([
            'month'         => $request->month,
            'seat_rent'     => $request->seat_rent,
            'wifi'          => $request->wifi,
            'khala'         => $request->khala,
            'utility_bill'  => $request->utility_bill,
            'total'         => $request->wifi + $request->khala + $request->utility_bill,
        ]);
        return back()->with('success', 'Bill Create Successfull!');
    }


    public function updateBill(Request $request, $id)
    {
        $bill = Bill::findOrFail($id);

        $request->validate([
            'month'         => 'required',
            'seat_rent'     => 'required|numeric',
        ]);

        $bill->update([
            'month'         => $request->month,
            'seat_rent'     => $request->seat_rent,
            'wifi'          => $request->wifi,
            'khala'         => $request->khala,
            'utility_bill'  => $request->utility_bill,
            'total'         => $request->wifi + $request->khala + $request->utility_bill,
        ]);

        return redirect()->route('bill.index')->with('success', 'Bill updated successfully!');
    }



    public function billDelete($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();
        return back()->with('success', 'Bill Delete Successfull!');
    }
}
