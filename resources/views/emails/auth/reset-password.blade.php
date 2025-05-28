@component('mail::message')
# ¡Hola!

Recibimos una solicitud para restablecer la contraseña de tu cuenta.

@component('mail::button', ['url' => $url])
Restablecer contraseña
@endcomponent

Este enlace para restablecer la contraseña expirará en {{ $count }} minutos.

Si no solicitaste este cambio, puedes ignorar este mensaje.

Gracias,<br>
AbogaSense
@endcomponent
