@extends('layouts.guest')

@section('content')
    <div class="container mt-5">
        <div class="alert alert-info">
            Gracias por registrarte. Por favor verifica tu correo electrónico haciendo clic en el enlace que te enviamos.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Reenviar correo de verificación</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link">Cerrar sesión</button>
            </form>
        </div>
    </div>
@endsection
