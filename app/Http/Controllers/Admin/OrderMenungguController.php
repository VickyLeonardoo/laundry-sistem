<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderMenungguController extends Controller
{
    public function show(){
        $orders = Order::where('statusOrder','Menunggu Verifikasi')->get();
        return view('admin.order-menunggu.index', compact('orders'));
    }
}
