<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderProsesController extends Controller
{
    public function show(){
        $orders = Order::where('statusOrder','Diproses')->get();
        return view('admin.order-diproses.index', compact('orders'));
    }

    public function edit($transactionNo){
        $order = Order::where('transactionNo', $transactionNo)->first();
        return view('admin.order-diproses.edit', compact('order','transactionNo'));
    }

    public function selesai($id){
        $order = Order::findOrFail($id);
        $order->update([
            'statusOrder' => 'Selesai'
        ]);
        return redirect()->back()->with('success',true);
    }

    public function pembayaranSelesai($id){
        $totalBerat = 0;
        $totalItem = 0;
        $pointKg = 0;
        $pointItem = 0;
        $pointOrder = 0;
        $order = Order::findOrFail($id);

        foreach ($order->orderitem as $orderList) {
            if ($orderList->jenis->satuan == 'KG') {
                $totalBerat += $orderList->jumlah;
            } else {
                $totalItem += $orderList->jumlah;
            }
            $pointKg = floor($totalBerat / 5) * 2;
            $pointItem = $totalItem * 3;
            $pointOrder = $pointKg + $pointItem;
        }
        $countPoint = OrderCount::where('user_id',$order->user_id)->first();
        if (!$countPoint) {
            OrderCount::create([
                'user_id' => $order->user_id,
                'pointOrder' => $pointOrder,
            ]);
            $order->update([
                'modePembayaran' => 'Cash On Deal',
                'statusPembayaran' => 'Terbayar',
            ]);
            return redirect()->route('admin.order.menunggu.show')->with('success',true);
        }else{
            $order->update([
                'modePembayaran' => 'Cash On Deal',
                'statusPembayaran' => 'Terbayar',
            ]);
            $countPoint->update([
                'pointOrder' => $countPoint->pointOrder + $pointOrder,
            ]);
            return redirect()->route('admin.order.menunggu.show')->with('success',true);
        }
    }

}
