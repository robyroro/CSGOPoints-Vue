<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;
use App\Models\Orders;

class AdminController extends Controller
{
    public function dashboard()
    {
      return response()->json([
        'users' => User::all(),
        'user' => User::orderBy('created_at','desc')->get()->take(10),
        'logs' => Logs::with('user')->orderBy('created_at','desc')->get()->take(10),
        'wd' => Orders::where('status', 0)->get(),
      ]);
    
    }
}
