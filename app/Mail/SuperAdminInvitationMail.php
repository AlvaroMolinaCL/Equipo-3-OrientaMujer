<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SuperAdminRequest;

class SuperAdminInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;

    public $superAdminRequest;

    public function __construct($token, SuperAdminRequest $superAdminRequest)
    {
        $this->link = url("/registro-superadmin/{$token}");
        $this->superAdminRequest = $superAdminRequest;
    }

    public function build()
    {
        return $this->subject('Invitación para registrarte como Super Administrador/a')
            ->markdown('emails.superadmin-invitation')
            ->with([
                'link' => $this->link,
                'superAdminRequest' => $this->superAdminRequest,
            ]);
    }

}
