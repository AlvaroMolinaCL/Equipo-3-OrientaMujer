@component('mail::message')
# ¡Hola {{ $superAdminRequest->name }}!

Has sido invitado/a a registrarte como Super Administrador/a en nuestra plataforma.

@component('mail::button', ['url' => $link])
Completar registro
@endcomponent

Si no solicitaste esta invitación, puedes ignorar este mensaje.

Gracias,<br>
El equipo de administración
@endcomponent
