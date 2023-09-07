<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\OrderCount;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function show(){
        $poin = 0;
        $poinCount = OrderCount::where('user_id',auth()->user()->id)->first();
        if ($poinCount) {
            $poin = $poinCount->pointOrder;
        }
        $promos = Discount::where('status','active')->paginate(12);
        return view('pelanggan.promo.index', compact('promos','poin'));
    }
}
