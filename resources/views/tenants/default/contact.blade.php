@extends('tenants.default.layouts.app')

@section('title', tenantPageName('contact', 'Contacto') . ' - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-4" style="font-family: {{ tenantSetting('heading_font', '') }}">{{ tenantPageName('contact', 'Contacto') }}</h1>
            <p class="mb-4">
                {!! tenantText(
                    'body_contact',
                    '
                        <p style="text-align: justify;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel dapibus nunc.
                    ',
                ) !!}
            </p>

            <div class="row">
                {{-- Tarjeta: Correo --}}
                <div class="col-md-4 mb-4">
                    <a href="mailto:{{ tenantSetting('contact_email', 'mibuffet@abogados.cl') }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm fade-in-section">
                            <div class="row g-0">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-envelope fa-3x text-dark"></i>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Correo</h5>
                                        <p class="card-text mb-0"><small>{{ tenantSetting('contact_email', 'mibuffet@abogados.cl') }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            
                {{-- Tarjeta: Instagram --}}
                <div class="col-md-4 mb-4">
                    <a href="https://www.instagram.com/{{ tenantSetting('contact_instagram', 'mibuffetdeabogados') }}" target="_blank" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm fade-in-section">
                            <div class="row g-0">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <i class="fab fa-instagram fa-3x text-dark"></i>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Instagram</h5>
                                        <p class="card-text mb-0">{{ '@' . tenantSetting('contact_instagram', 'mibuffetdeabogados') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            
                {{-- Tarjeta: LinkedIn --}}
                <div class="col-md-4 mb-4">
                    <a href="https://www.linkedin.com/in/{{ tenantSetting('contact_linkedin', 'mibuffetdeabogados') }}" target="_blank" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm fade-in-section">
                            <div class="row g-0">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <i class="fab fa-linkedin fa-3x text-dark"></i>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">LinkedIn</h5>
                                        <p class="card-text mb-0"><small><small>linkedin.com/in/{{ tenantSetting('contact_linkedin', 'mibuffetdeabogados') }}</small></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>                        
        </div>
    </section>
@endsection
