<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{
    public function index(){
        return view('track.index');
    }

    public function track(Request $request){
        $no = $request->orderNo;

        $order = Order::where('transactionNo',$no)->first();
        return view('track.track',compact('order'));
    }
}
