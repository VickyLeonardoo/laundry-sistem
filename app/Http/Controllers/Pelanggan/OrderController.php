<?php

namespace App\Http\Controllers\Pelanggan;

use Midtrans\Snap;
use App\Models\Order;
use App\Models\Voucher;
use App\Models\Orderitem;
use App\Models\Snaptoken;
use App\Models\OrderCount;
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
        $userId = auth()->user()->id;
        $transactionNo = NULL;
        $vouchers = NULL;
        $vouchersSearch = Voucher::where('user_id', $userId)->where('jumlah', '>', 0)->get();
        if ($vouchersSearch->isEmpty()) {
            $vouchers = NULL;
        } else {
            $vouchers = $vouchersSearch;
        }
        return view('pelanggan.order.create', compact('transactionNo','vouchers'));
    }

    public function createTrackno(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        $userId = auth()->user()->id;
        $randomNumbers = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        $today = Carbon::now()->format('Y-m-d');
        $transactionNo = "LAU" . $randomNumbers . "TRX";
        $orderCountToday = Order::where('user_id', $userId)
        ->whereDate('created_at', $today)
        ->count();
        $time = Carbon::now();
        $voucher = Voucher::where('user_id',$userId)->where('discount_id',$request->discount_id)->first();

        if ($orderCountToday >= 3) {
            return redirect()->back()->with('errOrder',true);
        }else{
            Order::create([
                'user_id' => $userId,
                'transactionNo' => $transactionNo,
                'tglOrder' => $time,
                'discount_id' => $request->discount_id,
            ]);
            if ($voucher) {
                $voucher->update([
                    'jumlah' => $voucher->jumlah - 1,
                ]);
            }
            return redirect()->back()->with('transactionNo', $transactionNo);
        }
    }

    public function viewTrack(Request $request, $transactionNo){
        $order = Order::where('transactionNo',$transactionNo)->first();
        $orderItem = Orderitem::where('order_id',$order->id)->first();
        $orderItems = Orderitem::where('order_id',$order->id)->get();
        $snapTokenGet = Snaptoken::where('order_id',$order->id)->first();
        $snapToken = 0;
        if ($snapTokenGet) {
            $snapToken = $snapTokenGet->snapToken;
        }
        $totalHarga = 0;
        foreach ($orderItems as $item) {
            $totalHarga += $item->harga;
        }
        return view('pelanggan.order.trackno', compact('order','orderItem','totalHarga','snapToken'));
    }

    public function updateMetode(Request $request, $id){
        $order = Order::findOrFail($id);
        $orderItems = Orderitem::where('order_id',$order->id)->get();
        $orderItem = Orderitem::where('order_id',$order->id)->first();
        $snapTokenGet = Snaptoken::where('order_id',$order->id)->first();
        $snapToken = NULL;
        // $snapToken = $snapTokens->snapToken;
        $totalHarga = 0;
        foreach ($orderItems as $item) {
            $totalHarga += $item->harga;
        }
        if ($request->modePembayaran == 'Online') {
            $order->update([
                'modePembayaran' => 'Online'
            ]);
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order->id,
                    'gross_amount' => $totalHarga,
                ),
                'customer_details' => array(
                    'name' => auth()->user()->name,
                    'phone' => auth()->user()->noHp,
                ),
            );
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            if (!$snapTokenGet) {
                Snaptoken::create([
                    'order_id' => $order->id,
                    'snapToken' => $snapToken,
                ]);
            }else{
                $snapTokenGet->update([
                    'snapToken' => $snapToken
                ]);
            }
            return view('pelanggan.order.trackno', compact('order','orderItem','totalHarga','snapToken'));
        }else{
            $order->update([
                'modePembayaran' => 'Cash On Deal'
            ]);
            return view('pelanggan.order.trackno', compact('order','orderItem','totalHarga','snapToken'));

        }
    }

    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        $totalBerat = 0;
        $totalItem = 0;
        $pointKg = 0;
        $pointItem = 0;
        $pointOrder = 0;

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update(['statusPembayaran' => 'Terbayar']);
            }
            Snaptoken::where('order_id',$order->id)->delete();
        }
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
        }else{
            $countPoint->update([
                'pointOrder' => $countPoint->pointOrder + $pointOrder,
            ]);
        }

    }
}
