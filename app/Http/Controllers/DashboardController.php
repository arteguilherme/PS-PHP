<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('dashboard', [
            'vehicles' => DB::table('vehicles')->orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
