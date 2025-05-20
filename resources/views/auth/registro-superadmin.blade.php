@extends('layouts.guest')

@section('content')
    <div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-md-8 col-lg-6">
            <div class="shadow-lg rounded-4 overflow-hidden"
                style="background-color: #fdf5e5; border-left: 10px solid #6B3A2C;">

                <!-- Logo arriba del formulario -->
                <div class="text-center py-2" style="background-color: #fdf5e5;">
                    <img src="{{ asset('images/abogared2.png') }}" alt="Logo del despacho" style="max-width: 250px;"
                        class="img-fluid mb-2">
                </div>

                <div class="p-5 bg-white">
                    <!-- Encabezado -->
                    <div class="text-center mb-4">
                        <h3 style="color: #4A1D0B;">
                            <i class="bi bi-person-check-fill me-2"></i> Activar Cuenta de Super Admin
                        </h3>
                        <p class="text-muted">Completa tus datos para finalizar el registro</p>
                    </div>

                    <form method="POST" action="{{ url('/registro-superadmin/' . $token) }}">
                        @csrf

                        <!-- Email (solo visual) -->
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" value="{{ $email }}" disabled>
                            <input type="hidden" name="email" value="{{ $email }}">
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Por ejemplo: Ana Gómez" id="name" name="name"
                                value="{{ old('name') }}" required autofocus>
                            @error('name')
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
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control"
                                placeholder="Confirme la contraseña ingresada anteriormente"
                                id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white" style="background-color: #4A1D0B;">
                                <i class="bi bi-check2-circle me-1"></i> Crear Cuenta
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
