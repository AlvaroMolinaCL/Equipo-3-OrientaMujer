@extends('layouts.guest')

@section('title', 'Iniciar Sesión - ' . config('app.name', 'Laravel'))

@section('content')
    <div class="container py-5 min-vh-100 d-flex flex-column justify-content-center">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex flex-column flex-md-row shadow-lg rounded-4 overflow-hidden"
                    style="min-height: 500px; border-left: 10px solid #6B3A2C;">

                    <!-- Columna con imagen (pantallas grandes) -->
                    <div class="col-md-6 d-none d-md-block p-0" style="background-color: #fdf5e5;">
                        <div class="h-100 w-100 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/abogasense1.png') }}" alt="Despacho de abogados"
                                class="img-fluid logo-img">
                        </div>
                    </div>

                    <!-- Columna con formulario -->
                    <div class="col-md-6 d-flex align-items-center bg-white py-4 px-3">
                        <div class="w-100">

                            <!-- Logo para pantallas pequeñas -->
                            <div class="d-block d-md-none" style="border-radius: 12px;">
                                <div class="text-center" style="background-color: #fdf5e5; border-radius: 12px;">
                                    <img class="py-3" src="{{ asset('images/abogasense2.png') }}" alt="Despacho de abogados"
                                        style="max-width: 150px;" class="img-fluid mb-2">
                                </div>
                                <div class="p-3 text-center">
                                    <h3 style="color: #4A1D0B;">
                                        <i class="bi bi-shield-lock-fill me-2"></i> Panel Administrativo
                                    </h3>
                                    <p class="text-muted">Acceso Exclusivo para Super Administradores</p>
                                </div>
                            </div>

                            <!-- Título para pantallas grandes -->
                            <div class="text-center mb-4 d-none d-md-block">
                                <h3 style="color: #4A1D0B;">
                                    <i class="bi bi-shield-lock-fill me-2"></i> Panel Administrativo
                                </h3>
                                <p class="text-muted">Acceso Exclusivo para Super Administradores</p>
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Por ejemplo: miemail@gmail.com" name="email"
                                        value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Ingrese su contraseña" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Recordarme</label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn text-white" style="background-color: #4A1D0B;">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
                                    </button>

                                </div>

                                @if (Route::has('password.request'))
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none"
                                            style="color: #4A1D0B;">¿Olvidaste tu contraseña?</a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .logo-img {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            width: auto;
        }

        @media (max-width: 768px) {
            .logo-img {
                max-width: 100%;
                max-height: 200px;
            }
        }
    </style>
@endsection
