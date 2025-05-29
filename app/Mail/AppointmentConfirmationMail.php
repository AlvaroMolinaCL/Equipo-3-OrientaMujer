<?php

namespace App\Mail;

use App\Models\AvailableSlot;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $slot;
    public $description;
    public $productNames;

    public function __construct($userName, AvailableSlot $slot, $description, $productNames)
    {
        $this->userName = $userName;
        $this->slot = $slot;
        $this->description = $description;
        $this->productNames = $productNames;
    }

    public function build()
    {
        return $this->subject('Confirmación de tu cita agendada')
            ->view('emails.appointment_confirmation');
    }
}
