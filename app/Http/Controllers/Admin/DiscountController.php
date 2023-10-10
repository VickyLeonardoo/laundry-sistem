<?php

namespace App\Http\Controllers\Admin;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function show(){
        return view('admin.discount.index',[
            'discounts' => Discount::all(),
        ]);
    }

    public function create(){
        return view('admin.discount.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'nominal' => 'required',
            'persyaratan' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'tipeDiscount' => 'required',
        ],[
            'nama.required' => 'Nama Wajib Diisi',
            'status.required' => 'Status Wajib Diisi',
            'tipeDiscount.required' => 'Tipe Diskon Wajib Diisi',
            'nominal.required' => 'Nominal Wajib Diisi',
            'persyaratan.required' => 'Persayratan Wajib Diisi',
            'deskripsi.required' => 'Deskripsi Wajib Diisi',
        ]);
        Discount::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tipeDiscount' => $request->tipeDiscount,
            'nominal' => $request->nominal,
            'persyaratan' => $request->persyaratan,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success',true);
    }

    public function edit($id){
        $discount = Discount::findOrFail($id);
        return view('admin.discount.edit',compact('discount'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'nominal' => 'required',
            'persyaratan' => 'required',
        ],[
            'nama.required' => 'Nama Wajib Diisi',
            'nominal.required' => 'Nominal Wajib Diisi',
            'persyaratan.required' => 'Persayratan Wajib Diisi',
        ]);

        Discount::where('id', $id)->update([
            'nama' => $request->nama,
            'tipeDiscount' => $request->tipeDiscount,
            'nominal' => $request->nominal,
            'persyaratan' => $request->persyaratan,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success',true);
    }

    public function destroy($id){
        $discount = Discount::findOrFail($id);
        $discount->delete();
        return redirect()->back()->with('success',true);
    }

    public function updateStatus(Request $request){
        $request->validate([
            'status' => 'required|in:active,inactive',
            'discounts' => 'required|array',
        ]);

        $newStatus = $request->input('status');

        $selectedDiscounts = $request->input('discounts', []);
        Discount::whereIn('id', $selectedDiscounts)->update(['status' => $newStatus]);
        return redirect()->back()->with('updated', 'Status diskon diperbarui.');
    }
}
