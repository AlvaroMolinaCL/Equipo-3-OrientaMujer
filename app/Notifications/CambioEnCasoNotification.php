<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CambioEnCasoNotification extends Notification
{
    use Queueable;

    protected $titulo;
    protected $mensaje;
    protected $link;

    public function __construct($titulo, $mensaje, $link = null)
    {
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->link = $link ?? url('/');
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Actualización en un caso')
            ->greeting('Hola!')
            ->line('Ha habido una actualización en el caso: ' . $this->titulo)
            ->line($this->mensaje)
            ->action('Ver más', $this->link)
            ->line('Gracias por usar AbogaSense.');
    }
}
