@extends('layouts.guest')

@section('title', 'Registrarse - ' . config('app.name', 'Laravel'))

@section('content')
    <div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-md-8 col-lg-6">
            <div class="shadow-lg rounded-4 overflow-hidden"
                style="background-color: #fdf5e5; border-left: 10px solid #6B3A2C;">

                <!-- Logo arriba del formulario -->
                <div class="text-center py-2" style="background-color: #fdf5e5;">
                    <img src="{{ asset('images/abogasense2.png') }}" alt="Logo del despacho" style="max-width: 250px;"
                        class="img-fluid mb-2">
                </div>

                <div class="p-5 bg-white">

                    <!-- Encabezado -->
                    <div class="text-center mb-4">
                        <h3 style="color: #4A1D0B;">
                            <i class="bi bi-person-plus-fill me-2"></i> Crear Nueva Cuenta
                        </h3>
                        <p class="text-muted">Registro Exclusivo para Super Administradores</p>
                    </div>

                    @php
                        $hayUsuarios = \App\Models\User::count() > 0;
                    @endphp

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Por ejemplo: Juan Pérez" id="name" name="name"
                                value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Por ejemplo: miemail@gmail.com" id="email" name="email"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Ingrese una contraseña segura" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control"
                                placeholder="Confirme la contraseña ingresada anteriormente" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>

                        @if ($hayUsuarios)
                            <div class="mb-3">
                                <label for="access_token" class="form-label">Token de Acceso</label>
                                <input type="text" class="form-control @error('access_token') is-invalid @enderror"
                                    placeholder="Por ejemplo: ABGR-XXXX-XXXX-XXXX" id="access_token" name="access_token"
                                    required>
                                @if ($errors->has('access_token'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('access_token') }}
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white" style="background-color: #4A1D0B;">
                                <i class="bi bi-check2-circle me-1"></i> Registrarse
                            </button>
                        </div>

                        <!-- Link a login -->
                        <div class="mt-4 text-center">
                            <small class="text-muted">¿Ya tienes una cuenta?</small><br>
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
