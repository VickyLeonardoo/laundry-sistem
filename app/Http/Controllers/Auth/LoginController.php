<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        return view('auth.login');
    }

    public function prosesLogin(Request $request){
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        $kredensil = $request->only('email','password');
        if (Auth::guard('user')->attempt($kredensil)) {
            $user = Auth::guard('user')->user();
            if ($user->role == '0') {
                return redirect()->route('admin.dashboard')->with('message','Selamat Datang, Admin');
                // return redirect()->route('admin.home')->withToastSuccess('Kamu Berhasil Masuk!')->with('message','Berhasil');
            }else if($user->role == '1'){
                if ($user->is_active == '0') {
                    return redirect()->route('otp.show');
                }else{
                    return redirect()->route('pelanggan.dashboard')->with('message','Selamat Datang, Ingin Mengorder Laundry Hari ini?');
                }
            }
        }

        return redirect()->back()->with('message','Login Gagal, Email atau Password Kamu Salah!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/login')->with('success','Berhasil Logout');
    }

}
