@extends('layouts.guest')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">¿Olvidaste tu contraseña?</h2>

        <p class="text-muted mb-4">
            No hay problema. Solo proporciona tu dirección de correo electrónico y te enviaremos un enlace para
            restablecerla.
        </p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    Enviar enlace de restablecimiento
                </button>
            </div>
        </form>
    </div>
@endsection
