@extends('layouts.guest')

@section('title', 'Recuperar Contraseña - ' . config('app.name', 'Laravel'))

@section('content')
    <div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-md-8 col-lg-6">
            <div class="shadow-lg rounded-4 overflow-hidden"
                style="background-color: #fdf5e5; border-left: 10px solid #6B3A2C;">

                <!-- Logo -->
                <div class="text-center py-2" style="background-color: #fdf5e5;">
                    <img src="{{ asset('images/abogasense2.png') }}" alt="Logo del despacho" style="max-width: 250px;"
                        class="img-fluid mb-2">
                </div>

                <div class="p-5 bg-white">

                    <!-- Encabezado -->
                    <div class="text-center mb-4">
                        <h3 style="color: #4A1D0B;">
                            <i class="bi bi-envelope-check-fill me-2"></i> ¿Olvidaste tu contraseña?
                        </h3>
                        <p class="text-muted">Ingresa tu correo y te enviaremos un enlace para restablecerla.</p>
                    </div>

                    <!-- Mensaje de estado -->
                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Correo -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Por ejemplo: miemail@gmail.com" id="email" name="email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white" style="background-color: #4A1D0B;">
                                <i class="bi bi-send-check me-1"></i> Enviar enlace
                            </button>
                        </div>

                        <!-- Link de regreso al login -->
                        <div class="mt-4 text-center">
                            <small class="text-muted">¿Recordaste tu contraseña?</small><br>
                            <a href="{{ route('login') }}" class="text-decoration-none" style="color: #4A1D0B;">
                                Iniciar sesión
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
