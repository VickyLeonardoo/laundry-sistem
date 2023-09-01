<?php

namespace App\Http\Controllers\Admin;

use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class OutletController extends Controller
{
    public function show(){
        return view('admin.outlet.index',[
            'outlets' => Outlet::all(),
        ]);
    }

    public function create(){
        return view('admin.outlet.create');
    }

    public function store(Request $request){
        $request->validate([
            'alamat' => 'required',
            'foto' => 'mimes:jpeg,png,jpg'
        ],[
            'alamat.required' => 'Alamat Wajib Diisi',
            'foto.mimes' => 'Tipe File Harus .JPG, .PNG, .JPEG',
        ]);

        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->getClientOriginalExtension();
            $imagePath = 'outlet/' . $imageName;
            $request->foto->storeAs('public/outlet', $imageName);
        }
        $outlet = Outlet::create([
            'alamat' => $request->alamat,
            'foto' => $imagePath
        ]);

        return redirect()->back()->with('success',true);
    }

    public function edit($id){
        $outlet = Outlet::findOrFail($id);
        return view('admin.outlet.edit',[
            'outlet' => $outlet
        ]);
    }

    public function update(Request $request, $id){
        $outlet = Outlet::findOrFail($id);
        $request->validate([
            'alamat' => 'required',
            'foto' => 'mimes:jpeg,png,jpg'
        ],[
            'alamat.required' => 'Alamat Wajib Diisi',
            'foto.mimes' => 'Tipe File Harus .JPG, .PNG, .JPEG',
        ]);

        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->getClientOriginalExtension();
            $imagePath = 'outlet/' . $imageName;
            $request->foto->storeAs('public/outlet', $imageName);

            if ($outlet->foto) {
                Storage::delete('public/' . $outlet->foto);
            }

            $outlet->update([
                'alamat' => $request->alamat,
                'foto' => $imagePath
            ]);
        }else{
            $outlet->update([
                'alamat' => $request->alamat,
            ]);
        }
        return redirect()->back()->with('success',true);
    }

    public function destroy($id){
        $outlet = Outlet::findOrFail($id);
        if ($outlet->foto) {
            Storage::delete('public/' . $outlet->foto);
        }
        $outlet->delete();
        return redirect()->back()->with('success',true);
    }
}
