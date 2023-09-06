<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\OrderCount;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $orderPoint = OrderCount::where('user_id',auth()->user()->id)->first();
        $poin = 0;
        if ($orderPoint) {
            $poin = $orderPoint->pointOrder;
        }
        return view('pelanggan.dashboard', compact('poin'));
    }

}
