<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use App\Mail\VerifikasiMail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function view(){
        return view('auth.otp');
    }

    public function reSend(){
        date_default_timezone_set('Asia/Jakarta');
        $time = Carbon::now();
        $userId = Auth::guard('user')->user()->id;
        $email = User::where('id',$userId)->first();
        $otp = Otp::where('user_id',$userId)->first();
        $otpNumber = rand(100000,999999);
        if (!$otp){
            Otp::create([
                'user_id' => $userId,
                'otp' => $otpNumber,
                'validTime' => $time,
            ]);
            Mail::to($email)->send(new VerifikasiMail($email,$otp['otp']));

            return redirect()->back()->with('message','OTP Berhasil Dikirim Silahkan Periksa Email Kamu');
        }else{
            $otp->update([
                'otp' => $otpNumber,
                'validTime' => $time,
            ]);
            Mail::to($email)->send(new VerifikasiMail($email,$otp['otp']));
            return redirect()->back()->with('message','OTP Berhasil Dikirim Silahkan Periksa Email Kamu');
        }

    }

    public function verifyOtp(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        $data = $request->all();
        $combinedNumber = (int) (
            $data['input1'] .
            $data['input2'] .
            $data['input3'] .
            $data['input4'] .
            $data['input5'] .
            $data['input6']
        );
        $userId = Auth::guard('user')->user()->id;
        $otp = Otp::where('user_id',$userId)->first();
        if (!$otp) {
            return redirect()->back()->with('message', 'Kode OTP tidak ditemukan.');
        }
        $activeOtp = $otp->otp;
        $validTime = $otp->validTime;
        $currentTime = now();
        $timeDifference = $currentTime->diffInMinutes($validTime);

        if ($combinedNumber == $activeOtp && $timeDifference <= 5) {
            $user = User::where('id',$userId)->update([
                'is_active' => '1',
            ]);
            $otp->delete();
            return 'Ini Halaman Login';
        }elseif ($timeDifference > 5) {
            return redirect()->back()->with('message', 'Kode OTP sudah tidak berlaku. Silakan kirim ulang OTP.');

        }else{
            return redirect()->back()->with('message','Kode OTP Salah, silahkan periksa kembali Email Kamu');
        }
    }
}
