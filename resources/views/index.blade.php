@extends('layouts.guest')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="background-color: #fdf5e5; border-bottom: 10px solid #6B3A2C;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4" style="color: #4A1D0B;">Sistema de Gestión para Despachos Legales
                    </h1>
                    <p class="lead mb-4" style="color: #6B3A2C;">Plataforma exclusiva para administradores autorizados con
                        tokens de acceso</p>

                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-lg text-white" style="background-color: #4A1D0B;">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Acceso Administradores
                        </a>
                        <a href="#request-access" class="btn btn-lg btn-outline-dark">
                            <i class="bi bi-key me-1"></i> Solicitar Token
                        </a>
                    </div>

                    <div class="mt-4 p-3 rounded"
                        style="background-color: rgba(106, 58, 44, 0.1); border-left: 4px solid #6B3A2C;">
                        <p class="mb-0 small" style="color: #6B3A2C;">
                            <i class="bi bi-info-circle-fill me-2"></i> El registro requiere un token de acceso
                            proporcionado por un Super Administrador existente.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/abogared1.png') }}" alt="Acceso seguro con token" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Access Process Section -->
    <section id="access-process" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #4A1D0B;">Proceso de Acceso Seguro</h2>
                <p class="lead" style="color: #6B3A2C;">Sistema de autenticación por tokens</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mx-auto mb-4"
                                style="background-color: #fdf5e5; color: #4A1D0B; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <h4 style="color: #4A1D0B;">1. Solicitud</h4>
                            <p class="text-muted">Contacta a un Super Administrador existente para solicitar tu token de
                                acceso.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mx-auto mb-4"
                                style="background-color: #fdf5e5; color: #4A1D0B; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <h4 style="color: #4A1D0B;">2. Validación</h4>
                            <p class="text-muted">El Super Admin verifica tu identidad y genera un token único.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mx-auto mb-4"
                                style="background-color: #fdf5e5; color: #4A1D0B; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                                <i class="bi bi-key-fill"></i>
                            </div>
                            <h4 style="color: #4A1D0B;">3. Registro</h4>
                            <p class="text-muted">Usa el token recibido para completar tu registro como nuevo Super Admin.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="super-admin-summary" class="py-5" style="background-color: #fdf5e5;">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" style="color: #4A1D0B;">Funciones Exclusivas para Super Administradores
            </h2>

            <div class="row justify-content-center gx-4">
                <div class="col-md-4 d-flex mb-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm text-center flex-fill"
                        style="background-color: white; border: 2px solid #6B3A2C;">
                        <div class="icon mb-3" style="color: #6B3A2C; font-size: 2.5rem;">
                            <i class="bi bi-key-fill"></i>
                        </div>
                        <h5 class="fw-semibold mb-2" style="color: #4A1D0B;">Generación de Tokens</h5>
                        <p class="text-muted">Crea y administra tokens de acceso para nuevos Super Administradores con
                            facilidad y seguridad.</p>
                    </div>
                </div>

                <div class="col-md-4 d-flex mb-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm text-center flex-fill"
                        style="background-color: white; border: 2px solid #6B3A2C;">
                        <div class="icon mb-3" style="color: #6B3A2C; font-size: 2.5rem;">
                            <i class="bi bi-building"></i>
                        </div>
                        <h5 class="fw-semibold mb-2" style="color: #4A1D0B;">Gestión de Tenants</h5>
                        <p class="text-muted">Controla múltiples despachos legales, configurando y organizando cada tenant
                            de manera eficiente.</p>
                    </div>
                </div>

                <div class="col-md-4 d-flex mb-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm text-center flex-fill"
                        style="background-color: white; border: 2px solid #6B3A2C;">
                        <div class="icon mb-3" style="color: #6B3A2C; font-size: 2.5rem;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="fw-semibold mb-2" style="color: #4A1D0B;">Control de Accesos</h5>
                        <p class="text-muted">Asigna y supervisa los administradores responsables de cada tenant con total
                            control y transparencia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Request Access Section -->
    <section id="request-access" class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="p-4 text-center" style="background-color: #fdf5e5;">
                                <h3 style="color: #4A1D0B;"><i class="bi bi-key me-2"></i> Solicitar Token de Acceso</h3>
                                <p class="mb-0" style="color: #6B3A2C;">Completa el formulario para solicitar tu token a un
                                    Super Administrador</p>
                            </div>
                            <div id="form-container" class="p-4">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Cerrar"></button>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Cerrar"></button>
                                    </div>
                                @endif

                                <form action="{{ url('/solicitar-superadmin') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label" style="color: #4A1D0B;">Nombre Completo</label>
                                        <input type="text" name="name" class="form-control" id="name" required
                                            placeholder="Por ejemplo: Juan Pérez Gómez González">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label" style="color: #4A1D0B;">Correo
                                            Electrónico</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Por ejemplo: miemail@gmail.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reason" class="form-label" style="color: #4A1D0B;">Mensaje</label>
                                        <textarea name="reason" class="form-control" id="reason" rows="3"
                                            placeholder="Explica por qué necesitas acceso como Super Admin"></textarea>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn text-white" style="background-color: #4A1D0B;">
                                            <i class="bi bi-send-fill me-1"></i> Enviar Solicitud
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Existing Admin Login CTA -->
    <section class="py-5" style="background-color: #4A1D0B;">
        <div class="container text-center">
            <h3 class="text-white mb-3">¿Ya eres Super Administrador?</h3>
            <p class="text-white-50 mb-4">Accede a tu panel de control para gestionar tenants y generar tokens.</p>
            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5">
                <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
            </a>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .hero-section {
            padding: 5rem 0;
        }

        .icon-box {
            transition: all 0.3s ease;
        }

        .icon-box:hover {
            transform: rotate(5deg) scale(1.1);
        }

        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .input-group-text {
            background-color: #6B3A2C;
            color: white;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0;
            }

            .display-4 {
                font-size: 2.5rem;
            }
        }
    </style>
@endsection