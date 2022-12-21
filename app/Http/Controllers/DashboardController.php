<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('dashboard', [
            'vehicles' => Vehicle::orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
