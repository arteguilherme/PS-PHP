<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('welcome', [
            'vehicles' => Vehicle::whereDate('criado_em', '>', '2022-12-09')->get()
        ]);
    }
}
