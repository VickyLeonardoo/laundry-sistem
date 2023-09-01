<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifikasiMail extends Mailable
{
    public $data;
    public $otp;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($data,$otp)
    {
        $this->data = $data;
        $this->otp = $otp;
    }

    public function build(){
        return $this->from('no-reply@gmail.com')
                    ->subject('Verifikasi OTP E-Laundry')
                    ->view('mail.viewOtp');
    }
}
