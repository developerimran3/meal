<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meal;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    public function viewBazar()
    {
        return view('operations.bazar');
    }

    public function storeBazar()
    {
        return view('operations.bazar');
    }
}
