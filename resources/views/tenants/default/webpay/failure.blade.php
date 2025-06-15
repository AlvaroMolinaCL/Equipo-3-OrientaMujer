@extends('tenants.default.layouts.app')

@section('title', 'Pago Rechazado - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">
                    <div class="card shadow border-0 rounded-4 fade-in-section overflow-hidden">
                        <!-- Header con efecto de onda -->
                        <div class="card-header position-relative bg-danger text-white text-center py-5 rounded-top-4">
                            <div class="position-absolute w-100 overflow-hidden top-0 start-0">
                                <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                    <path fill="rgba(255,255,255,0.15)" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
                                </svg>
                            </div>
                            <div class="position-relative z-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                                    class="bi bi-x-circle-fill mb-3" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                </svg>
                                <h2 class="mb-0"
                                    style="font-family: {{ tenantSetting('heading_font', 'Poppins, sans-serif') }}">¡Pago
                                    Rechazado!</h2>
                                <p class="mt-2 mb-0 small">No se pudo completar tu transacción</p>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="payment-details p-4 rounded bg-light mb-4 shadow-sm">
                                <h5 class="text-center mb-4">Detalles del error</h5>

                                <div class="mb-3">
                                    <span class="text-muted small">Orden de compra</span>
                                    <p class="fw-bold mb-0">{{ $buyOrder ?? 'No disponible' }}</p>
                                </div>

                                @isset($responseCode)
                                <div class="mb-3">
                                    <span class="text-muted small">Código de error</span>
                                    <p class="fw-bold text-dark mb-0">{{ $responseCode }}</p>
                                </div>
                                @endisset

                                @isset($errorMessage)
                                <div class="mb-0">
                                    <span class="text-muted small">Motivo</span>
                                    <p class="fw-bold mb-0">{{ $errorMessage }}</p>
                                </div>
                                @endisset
                            </div>

                            <div class="alert alert-warning border mb-4">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <span>No se ha realizado ningún cargo a tu tarjeta</span>
                                </div>
                            </div>

                            <div class="text-center">
                                <a href="{{ url('/') }}" class="btn btn-outline-danger btn rounded-pill px-3 py-2 me-2">
                                    <i class="bi bi-house-door-fill me-2"></i> Volver al inicio
                                </a>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-center rounded-bottom-4 py-3">
                            <small class="text-muted">¿Necesitas ayuda? <a
                                    href="{{ route('tenant.contact') }}">Contáctanos</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .fade-in-section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .payment-details {
            border-left: 4px solid #dc3545;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
        }

        .btn-outline-danger:hover {
            background-color: #f8f9fa;
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }

        .rounded-top-4 {
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
        }

        .rounded-bottom-4 {
            border-bottom-left-radius: 1rem !important;
            border-bottom-right-radius: 1rem !important;
        }

        .waves {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fadeElements = document.querySelectorAll('.fade-in-section');
            const fadeInObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });

            fadeElements.forEach(element => fadeInObserver.observe(element));
        });
    </script>
@endsection