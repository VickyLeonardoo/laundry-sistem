<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Orderitem;

class OrderController extends Controller
{
    public function show(){
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view('pelanggan.order.index', compact('orders'));
    }
    public function create(){
        $transactionNo = NULL;
        return view('pelanggan.order.create', compact('transactionNo'));
    }

    public function createTrackno(){
        date_default_timezone_set('Asia/Jakarta');
        $userId = auth()->user()->id;
        $randomNumbers = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        $today = Carbon::now()->format('Y-m-d');
        $transactionNo = "LAU" . $randomNumbers . "TRX";
        $orderCountToday = Order::where('user_id', $userId)
        ->whereDate('created_at', $today)
        ->count();
        $time = Carbon::now();

        if ($orderCountToday >= 3) {
            return redirect()->back()->with('errOrder',true);
        }else{
            Order::create([
                'user_id' => $userId,
                'transactionNo' => $transactionNo,
                'tglOrder' => $time,
            ]);
            return redirect()->back()->with('transactionNo', $transactionNo);
        }
    }

    public function viewTrack($transactionNo){
        $order = Order::where('transactionNo',$transactionNo)->first();
        $orderItem = Orderitem::where('order_id',$order->id)->first();
        return view('pelanggan.order.trackno', compact('order','orderItem'));
    }
}
