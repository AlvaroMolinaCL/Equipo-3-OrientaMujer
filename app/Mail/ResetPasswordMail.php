<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        $url = url(route('password.reset', ['token' => $this->token, 'email' => $this->email], false));

        return $this->subject('Restablece tu contraseña')
                    ->markdown('emails.auth.reset-password')
                    ->with([
                        'url' => $url,
                        'count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
                    ]);
    }
}
