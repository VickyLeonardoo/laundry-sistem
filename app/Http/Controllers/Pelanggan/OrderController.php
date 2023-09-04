<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function show(){
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view('pelanggan.order.index', compact('orders'));
    }
    public function create(){
        $trackingNo = NULL;
        return view('pelanggan.order.create', compact('trackingNo'));
    }

    public function createTrackno(){
        date_default_timezone_set('Asia/Jakarta');
        $userId = auth()->user()->id;
        $randomNumbers = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        $today = Carbon::now()->format('Y-m-d');
        $trackingNo = "LAU" . $randomNumbers . "TRX";
        $orderCountToday = Order::where('user_id', $userId)
        ->whereDate('created_at', $today)
        ->count();
        $time = Carbon::now();

        if ($orderCountToday >= 3) {
            return redirect()->back()->with('errOrder',true);
        }else{
            Order::create([
                'user_id' => $userId,
                'trackingNo' => $trackingNo,
                'tglOrder' => $time,
            ]);
            return redirect()->back()->with('trackingNo', $trackingNo);
        }
    }

    public function viewTrack($trackingNo){
        $order = Order::where('trackingNo',$trackingNo)->first();
        return view('pelanggan.order.trackno', compact('order'));
    }
}
