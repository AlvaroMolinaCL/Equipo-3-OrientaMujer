@extends('layouts.guest')

@section('title', 'Restablecer Contraseña - ' . config('app.name', 'Laravel'))

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
                            <i class="bi bi-shield-lock-fill me-2"></i> Restablecer Contraseña
                        </h3>
                        <p class="text-muted">Ingresa tu correo y tu nueva contraseña para continuar.</p>
                    </div>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Correo -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $request->email) }}" readonly>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nueva contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva contraseña</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white" style="background-color: #4A1D0B;">
                                <i class="bi bi-arrow-repeat me-1"></i> Restablecer contraseña
                            </button>
                        </div>

                        <!-- Link a login -->
                        <div class="mt-4 text-center">
                            <small class="text-muted">¿Ya la restableciste?</small><br>
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