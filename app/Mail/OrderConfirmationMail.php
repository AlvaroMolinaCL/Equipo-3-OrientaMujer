<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $items;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->items = $order->items;
    }

    public function build()
    {
        return $this->subject('Confirmación de tu pedido #'.$this->order->id)
                    ->view('emails.order_confirmation')
                    ->with([
                        'order' => $this->order,
                        'items' => $this->items
                    ]);
    }
}