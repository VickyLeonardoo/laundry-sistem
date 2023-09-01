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
        ],[
            'nama.required' => 'Nama Wajib Diisi',
            'nominal.required' => 'Nominal Wajib Diisi',
            'persyaratan.required' => 'Persayratan Wajib Diisi',
        ]);
        Discount::create([
            'nama' => $request->nama,
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
}
