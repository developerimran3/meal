<?php

namespace App\Http\Controllers;

use App\Models\Bazar;
use Illuminate\Http\Request;

class BazarController extends Controller
{
    /** 
     * Bazar Data Show With Oprations Member 
     */

    public function viewBazar($id = null)
    {
        //edit Id Data Load
        $bazar = null;
        if ($id) {
            $bazar = Bazar::findOrFail($id);
        }

        //bazar list
        $dailyBazar = Bazar::orderBy('date', 'DESC')->get();

        return view('bazar.create', compact('dailyBazar', 'bazar'));
    }

    /**
     *  Daily Bazar Store
     */
    public function storeBazar(Request $request)
    {
        $request->validate([
            'date'            => 'required|date',
            'amount'          => 'required|numeric',
            'money_recipt'    => 'required'
        ]);
        // Upload new photo
        $photo = $this->fileUpload($request->file("money_recipt"), "media/bazar/");
        //Bazar Data Create with DataBase
        Bazar::create([
            'operations_id' => auth()->id(),
            'date'          => $request->date,
            'amount'        => $request->amount,
            'money_recipt'  => $photo,
        ]);
        return back()->with('success', 'Bazar recorded');
    }


    /** 
     * Bazar Delete Data with Database
     */
    public function deleteBazar($id)
    {
        $bazar = Bazar::findOrFail($id);
        unlink('media/bazar/' . $bazar->money_recipt);
        $bazar->delete();
        //return back
        return back()->with('success', 'bazar deleted successfully!');
    }

    public function showRecipt($id)
    {
        $bazar = Bazar::findOrFail($id);
        return view('bazar.show', compact('bazar'));
    }

    public function updateBazar(Request $request, $id)
    {
        $bazar = Bazar::findOrFail($id);

        $request->validate([
            'date'          => 'required|date',
            'amount'        => 'required|numeric',
            'money_recipt'  => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        // photo Uploade
        $money_recipt = $bazar->money_recipt;
        if ($request->hasFile('money_recipt')) {
            if ($bazar->money_recipt && file_exists(public_path("media/bazar/" . $bazar->money_recipt))) {
                unlink(public_path("media/bazar/" . $bazar->money_recipt));
            }
            $money_recipt = $this->fileUpload($request->file("money_recipt"), "media/bazar/");
        }

        $bazar->update([
            'date'          => $request->date,
            'amount'        => $request->amount,
            'money_recipt'  => $money_recipt,
        ]);
        return redirect()->route('bazar.view')->with('success', 'Bazar updated successfully!');
    }
}
