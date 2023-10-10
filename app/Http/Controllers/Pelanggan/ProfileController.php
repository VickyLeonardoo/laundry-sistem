<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(){
        return view('pelanggan.profile.index');
    }

    public function update(Request $request){
    $idProfile = Auth()->user()->id;
        if ($request->has('name') or $request->has('email') or $request->has('noHp')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'noHp' => 'required'
            ]);

            User::where('id',$idProfile)->update([
                'name' => $request->name,
                'email' => $request->email,
                'noHp' => $request->noHp
            ]);
            return redirect()->back()->with('sukses','Update Profile Berhasil');

        }else{
            $request->validate([
                'oldPassword' => 'required',
                'newPassword' => 'required',
                'confirmNewPassword' => 'required|same:newPassword'
            ]);
            $data = $request->all();
            $user = User::find(auth()->user()->id);
            if (!Hash::check($data['oldPassword'], $user->password)) {
                return redirect()->back()->with('error','Kamu Gagal');
            } else {
                User::where('id', $idProfile)->update([
                    'password' => bcrypt(Request()->newPassword)
                ]);
                return redirect()->back()->with('sukses','Ganti Password Berhasil.');
            }
        }
    }
}
