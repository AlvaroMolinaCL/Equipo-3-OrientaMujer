<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuperAdminInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;

    public function __construct($token)
    {
        $this->link = url("/registro-superadmin/{$token}");
    }

    public function build()
    {
        return $this->subject('Invitación para registrarte como Super Admin')
            ->view('emails.superadmin-invitation')
            ->with([
                'link' => $this->link,
            ]);
    }
}
