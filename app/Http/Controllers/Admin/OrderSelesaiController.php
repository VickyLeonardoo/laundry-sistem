<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderSelesaiController extends Controller
{
    public function show(){
        $orders = Order::where('statusOrder','Selesai')->get();
        return view('admin.order-selesai.index', compact('orders'));
    }

    public function edit($transactionNo){
        $order = Order::where('transactionNo', $transactionNo)->first();
        return view('admin.order-selesai.edit', compact('order','transactionNo'));
    }

    public function orderanDiterima($id){
        $order = Order::findOrFail($id);
        $order->update([
            'is_taken' => 'yes'
        ]);
        return redirect()->back()->with('success',true);
    }

}
