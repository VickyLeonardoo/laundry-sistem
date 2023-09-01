<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisbarangController extends Controller
{
    public function show(){
        $jenisbarang = JenisBarang::all();
        return view('admin.jenis.index',compact('jenisbarang'));
    }

    public function create(){
        return view('admin.jenis.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|min:4',
        ],[
            'nama.required' => 'Nama wajib diisi',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.min' => 'Harga minimal 1000',
        ]);

        JenisBarang::create([
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'harga' => $request->harga
        ]);
        return redirect()->back()->with('success',true);
    }

    public function edit($id){
        $jenisbarang = JenisBarang::findOrFail($id);
        return view('admin.jenis.edit',compact('jenisbarang'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|min:4',
        ],[
            'nama.required' => 'Nama wajib diisi',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.min' => 'Harga minimal 1000',
        ]);

        $jenisbarang = JenisBarang::findOrFail($id);

        $jenisbarang->update([
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
        ]);
        return redirect()->back()->with('success',true);
    }

    public function destroy($id){
        $jenisbarang = JenisBarang::findOrFail($id);
        $jenisbarang->delete();
        return redirect()->back()->with('success',true);

    }
}
