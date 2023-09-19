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
        $discount = $order->discount;
        $nominalDiscount = 0;
        $hargaTotal = 0;
        foreach ($order->orderitem as $orderList) {
            $hargaTotal += $orderList->jenis->harga * $orderList->jumlah;
            if ($order->is_discount == 'yes') {
                if ($discount->tipeDiscount == 'percent') {
                    $percentDiscount = $discount->nominal;
                    $nominalDiscount = ($percentDiscount / 100) * $hargaTotal;
                    $hargaTotal -= $nominalDiscount;
                }else if($discount->tipeDiscount == 'harga'){
                    $nominalDiscount = $discount->nominal;
                    $hargaTotal = $hargaTotal - $nominalDiscount;
                }
            }
        }
        return view('admin.order-menunggu.edit', compact('order','transactionNo','hargaTotal'));
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

    public function proses($transactionNo,$hargaTotal){
        $order = Order::where('transactionNo', $transactionNo)->first();
        if ($order && $order->orderitem->isEmpty()) {
            return redirect()->back()->with('error','Masukkan Order Item Sebelum Proses Orderan');
        }
        $order->update([
            'statusOrder' => 'Diproses',
            'statusPembayaran' => 'Menunggu Pembayaran',
        ]);
        if ($order->is_discount == 'yes') {
            $order->update([
                'total' => $hargaTotal
            ]);
        }
        return redirect()->route('admin.order.menunggu.show')->with('success',true);
    }
}
