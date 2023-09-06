<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisBarang;
use App\Models\Order;
use App\Models\OrderCount;
use App\Models\Orderitem;
use Illuminate\Http\Request;

class OrderMenungguController extends Controller
{
    public function show(){
        $orders = Order::where('statusOrder','Menunggu Verifikasi')->get();
        return view('admin.order-menunggu.index', compact('orders'));
    }

    public function edit($transactionNo){
        $order = Order::where('transactionNo', $transactionNo)->first();
        return view('admin.order-menunggu.edit', compact('order','transactionNo'));
    }

    public function createOrderItem($transactionNo){
        $order = Order::where('transactionNo', $transactionNo)->first();
        $id = $order->id;
        $jenis = JenisBarang::all();
        return view('admin.order-menunggu.create-item', compact('id','jenis','transactionNo'));
    }

    public function storeOrderItem(Request $request, $id){
        $order = Order::findOrFail($id);
        $jumlah = $request->berat == '' ? $request->jmlItem : $request->berat;
        $request->validate([
            'jenis_barang_id' => 'required',
            'tglDiantar' => 'required',
        ],[
            'jenis_barang_id.required' => 'Jenis Barang wajib Diisi',
            'tglDiantar.required' => 'Tanggal Diantar Wajib Diisi',
        ]);

        $data = [
            'order_id' => $order->id,
            'jenis_barang_id' => $request->jenis_barang_id,
            'tglDiantar' => $request->tglDiantar,
            'harga' => $request->harga,
            'jumlah' => $jumlah
        ];
        Orderitem::create($data);
        return redirect()->back()->with('success',true);
    }

    public function proses($transactionNo){
        $totalBerat = 0;
        $totalItem = 0;
        $pointKg = 0;
        $pointItem = 0;
        $pointOrder = 0;
        $order = Order::where('transactionNo', $transactionNo)->first();
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
        $countPoint = OrderCount::where('id',$order->user_id)->first();
        if (!$countPoint) {
            OrderCount::create([
                'user_id' => $order->user_id,
                'pointOrder' => $pointOrder,
            ]);
            $order->update([
                'statusOrder' => 'Diproses',
                'statusPembayaran' => 'Menunggu Pembayaran',
            ]);
            return redirect()->route('admin.order.menunggu.show')->with('success',true);
        }else{
            $order->update([
                'statusOrder' => 'Diproses',
                'statusPembayaran' => 'Menunggu Pembayaran',

            ]);
            $countPoint->update([
                'pointOrder' => $countPoint->pointOrder + $pointOrder,
            ]);
            return redirect()->route('admin.order.menunggu.show')->with('success',true);
        }
    }
}
