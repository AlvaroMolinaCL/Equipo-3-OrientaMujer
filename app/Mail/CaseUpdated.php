<?php

namespace App\Mail;

use App\Models\LegalCase;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CaseUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $case;

    public function __construct(LegalCase $case)
    {
        $this->case = $case;
    }

    public function build()
    {
        return $this->subject('Tu caso ha sido actualizado')
            ->view('emails.case_updated');
    }
}
