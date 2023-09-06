<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Orderitem;
use App\Models\Snaptoken;
use Midtrans\Snap;

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
            return 'false';
        }
    }

    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update(['statusPembayaran' => 'Terbayar']);
            }
            Snaptoken::where('order_id',$order->id)->delete();
        }
    }
}
