<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\User;
use App\Models\Voucher;
use App\Models\Discount;
use App\Models\OrderCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromoController extends Controller
{
    public function show(){
        $poin = 0;
        $poinCount = OrderCount::where('user_id',auth()->user()->id)->first();
        if ($poinCount) {
            $poin = $poinCount->pointOrder;
        }
        $promos = Discount::where('status','active')->paginate(12);
        return view('pelanggan.promo.index', compact('promos','poin'));
    }

    public function voucher(){
        return view('pelanggan.promo.voucher');
    }

    public function claimVoucher($id){
        $userId = auth()->user()->id;
        $user = User::findOrFail(auth()->user()->id);
        $discount = Discount::findOrFail($id);
        $orderCount = OrderCount::where('user_id',$userId)->first();
        $voucher = Voucher::where('user_id',$userId)->where('discount_id',$id)->first();
        $poinUser = $orderCount->pointOrder;
        $poinDisc = $discount->persyaratan;
        if ($poinUser >= $poinDisc) {
            $orderCount->update([
                'pointOrder' => $poinUser - $poinDisc
            ]);
            if ($voucher) {
                $voucher->update([
                    'jumlah' => $voucher->jumlah + 1,
                ]);
            }else{
                Voucher::create([
                    'user_id' => $userId,
                    'discount_id' => $id,
                    'jumlah' => 1,
                ]);
            }
            return redirect()->back()->with('success',true);
        }else{
            return 'Error';
        }
    }
}
