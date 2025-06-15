@extends('tenants.default.layouts.app')

@section('title', 'Pago Aprobado - ' . tenantSetting('name', 'Tenant'))

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
                        <div class="card-header position-relative bg-success text-white text-center py-5">
                            <div class="position-absolute w-100 overflow-hidden top-0 start-0">
                                <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                    <path fill="rgba(255,255,255,0.15)" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
                                </svg>
                            </div>
                            <div class="position-relative z-1">
                                <div class="icon-success mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                </div>
                                <h2 class="mb-2" style="font-family: {{ tenantSetting('heading_font', 'Poppins, sans-serif') }}; font-weight: 700">¡Pago Aprobado!</h2>
                                <p class="mb-0 opacity-75">Tu transacción fue completada correctamente</p>
                            </div>
                        </div>
                        
                        <div class="card-bod px-4 pt-4 pb-2">
                            <!-- Tarjeta de resumen -->
                            <div class="summary-card bg-white p-4 rounded-3 mb-4 shadow-sm border">
                                <h5 class="text-center mb-4 fw-semibold text-success">Resumen de tu compra</h5>
                                
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <span class="text-muted">N° de orden</span>
                                    <span class="fw-bold">{{ $buyOrder }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <span class="text-muted">Monto total</span>
                                    <span class="fw-bold text-dark fs-5">${{ number_format($amount, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Fecha</span>
                                    <span class="fw-bold">{{ \Carbon\Carbon::parse($transactionDate)->format('d/m/Y') }}</span>
                                </div>
                            </div>

                            <!-- Mensaje adicional -->
                            <div class="alert alert-light border text-center mb-4">
                                <div class="d-inline-block text-start">
                                    <i class="bi bi-envelope-check-fill text-success me-2"></i>
                                    <span>Hemos enviado los detalles a tu correo electrónico</span>
                                </div>
                            </div>

                            <!-- Acciones -->
                            <div class="d-grid gap-3">
                                <a href="{{ url('/') }}" class="btn btn-success rounded-pill py-2 fw-semibold">
                                    <i class="bi bi-house-door-fill me-2"></i> Volver al inicio
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white text-center rounded-bottom-4 border-0">
                            <small class="text-muted">¿Necesitas ayuda? <a href="{{ route('tenant.contact') }}" class="text-success fw-semibold">Contáctanos</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
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

    .card-header {
        position: relative;
        overflow: hidden;
    }

    .waves {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .icon-success {
        display: inline-flex;
        padding: 1rem;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
    }

    .summary-card {
        border-color: rgba(40, 167, 69, 0.2) !important;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
        transform: translateY(-2px);
    }

    .btn-outline-success:hover {
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

    @media (max-width: 576px) {
        .card-header {
            padding: 2rem 1rem;
        }
        .icon-success svg {
            width: 60px;
            height: 60px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efecto fade-in
        const fadeElements = document.querySelectorAll('.fade-in-section');
        const fadeInObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        fadeElements.forEach(element => fadeInObserver.observe(element));

        // Efecto hover mejorado para móviles
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('touchstart', function() {
                this.classList.add('hover');
            });
            
            card.addEventListener('touchend', function() {
                setTimeout(() => this.classList.remove('hover'), 300);
            });
        });
    });
</script>
@endsection