<?php

namespace App\Http\Controllers;

use App\Models\Bazar;
use Illuminate\Http\Request;

class BazarController extends Controller
{
    public function viewBazar()
    {
        return view('operations.bazar');
    }

    public function storeBazar(Request $request)
    {
        $request->validate([
            'date'            => 'required|date',
            'amount'          => 'required|numeric',
            'money_recipt'    => 'required'
        ]);

        Bazar::create([
            'operations_id' => auth()->id(),
            'date'          => $request->date,
            'amount'        => $request->amount,
            'money_recipt'  => $request->date
        ]);
        return back()->with('success', 'Bazar recorded');
    }
}
