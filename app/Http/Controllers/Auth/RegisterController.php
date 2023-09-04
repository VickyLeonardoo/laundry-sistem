<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Mail\VerifikasiMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function store(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'password' => 'required|min:5',
            'noHp' => 'required|min:10|max:13',
            'password_confirmation' => 'required|same:password'
        ],[
            'name.required' => 'Nama wajib Diisi',
            'name.string' => 'Nama tidak boleh ada karakter khusus',
            'email.required' => 'Email wajib diisi',
            'noHp.required' => 'No HP Wajib Diisi',
            'noHp.min' => 'No Hp Minimal 10 Karakter',
            'noHp.max' => 'No Hp Maksimal 13 Karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password Minimal 5 Karakter',
            'password_confirmation.required' => 'Password konfirmasi wajib diisi',
            'password_confirmation.same' => 'Password tidak sama',
        ]);

        // return $request->all();

        $email = $request->email;
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'noHp' => $request->noHp,
            'role' => '1',
            'is_active' => '0'
        ];
        $time = Carbon::now();
        $otp = rand(100000,999999);
        $user = User::create($data);
        Otp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'validTime' =>$time
        ]);
        Mail::to($email)->send(new VerifikasiMail($data,$otp));

        $kredensil = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if (Auth::guard('user')->attempt($kredensil)) {
            $user = Auth::guard('user')->user();
            if ($user->role == '1') {
                if ($user->is_active == '0') {
                    return redirect()->route('otp.show');
                }else{
                    return 'pelanggan';
                }
            }
        }


        return redirect('/home')->with('message','Kamu behrasil Mendaftar, silahkan Periksa Email Kamu untuk Verifikasi OTP  ');
    }
}
