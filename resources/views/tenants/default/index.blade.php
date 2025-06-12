@extends('tenants.default.layouts.app')

@section('title', tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-dark-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@section('content')
    <section class="hero-section">
        <div class="hero-overlay">
            <div class="hero-text fade-in-section">
                <h1>{!! tenantText('slogan_text', '<strong>¡Bienvenidos!</strong>') !!}</h1>
                <p class="mt-3">
                    {!! tenantText('slogan_body', 'Esta es nuestra página, <strong>¡conócenos!</strong>') !!}
                </p>
                @if (tenantAgendaFlow() === 'completo')
                    <a href="/plans" class="btn btn-consulta" role="button">{{ tenantSetting('button_banner_text', 'Agenda aquí') }}</a>
                @if (tenantAgendaFlow() === 'parcial')
                    <a href="/agenda/questionnaire" class="btn btn-consulta" role="button">{{ tenantSetting('button_banner_text', 'Agenda aquí') }}</a>
                @else
                    <a href="/contact" class="btn btn-consulta" role="button">{{ tenantSetting('button_banner_text', 'Agenda aquí') }}</a>
                @endif
                <br>
            </div>
        </div>
    </section>

    <section id="section1" class="scroll-section py-5">
        <div class="container">
            <div class="row align-items-center">
                {{-- Imagen: primer plano en móviles, segundo plano en pantallas grandes --}}
                <div class="col-md-6 text-center order-1 order-md-2 mb-4 mb-md-0 fade-in-section">
                    <img src="{{ asset('images/about/' . tenantSetting('about_path', 'About_(Predeterminado).png')) }}"
                        alt="{{ tenantSetting('name', 'Tenant') }}" class="rounded-circle img-fluid"
                        style="width: 350px; height: 350px; object-fit: cover;">
                </div>

                {{-- Texto: segundo plano en móviles, primer plano en pantallas grandes --}}
                <h1 class="mb-5 text-center">{{ tenantSetting('header_about_section_text', 'Sobre nosotros') }}</h1>
                <div class="col-md-6 order-2 order-md-1 fade-in-section">
                    {!! tenantText(
                        'about_text',
                        '
                            <p style="text-align: justify;">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a odio purus. Nullam nec commodo urna, vel dignissim enim. Aenean ac quam sit amet libero volutpat ornare.
                            </p>
                            <p style="text-align: justify;">
                                Nunc at odio ac magna sagittis varius. Maecenas ut orci vel felis maximus condimentum.
                            </p>
                            <p style="text-align: justify;">
                                Quisque vel quam tortor. Etiam iaculis tincidunt purus, eget congue urna volutpat sed.
                            </p>
                        ',
                    ) !!}
                    <div class="text-center">
                        <a href="/about" class="btn btn-consulta"
                            style="background-color: {{ tenantSetting('button_color_sidebar', '#ffffff54') }};"
                            role="button">{{ tenantSetting('button_about_section_text', 'Conoce más') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section2" class="scroll-section py-5">
        <div class="container">
            <h1 class="mb-5 text-center">{{ tenantSetting('header_services_section_text', 'Nuestros servicios') }}</h1>
            <div class="row g-4">
                {{-- Recuadro 1 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 fade-in-section">
                        <img src="{{ asset('images/services/' . (tenant()->services_path_1 ?? 'Servicio_(Predeterminado).png')) }}"
                            class="card-img-top" alt="Asesoría jurídica integral">

                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold;">
                                {!! tenantText('service1_title', 'Servicio 1') !!}
                            </h5>
                            {!! tenantText(
                                'service1_body',
                                '<p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a odio purus.</p>',
                            ) !!}
                        </div>
                    </div>
                </div>

                {{-- Recuadro 2 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 fade-in-section">
                        <img src="{{ asset('images/services/' . tenantSetting('services_path_2', 'Servicio_(Predeterminado).png')) }}"
                            class="card-img-top" alt="Representación judicial">

                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold;">
                                {!! tenantText('service2_title', 'Servicio 2') !!}
                            </h5>
                            {!! tenantText(
                                'service2_body',
                                '<p style="text-align: justify;">Nullam nec commodo urna, vel dignissim enim. Aenean ac quam sit amet libero volutpat ornare.</p>',
                            ) !!}

                        </div>
                    </div>
                </div>

                {{-- Recuadro 3 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 fade-in-section">
                        <img src="{{ asset('images/services/' . tenantSetting('services_path_3', 'Servicio_(Predeterminado).png')) }}"
                            class="card-img-top" alt="Capacitaciones y charlas">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold;">
                                {!! tenantText('service3_title', 'Servicio 3') !!}
                            </h5>
                            {!! tenantText(
                                'service3_body',
                                '<p style="text-align: justify;">Praesent tempus accumsan urna. Sed vel tempor nulla, et sodales enim. Vivamus a dictum urna, ut cursus leo.</p>',
                            ) !!}

                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="/services" class="btn btn-consulta fade-in-section"
                    style="background-color: {{ tenantSetting('button_color_sidebar', '#ffffff54') }};"
                    role="button">{{ tenantSetting('button_services_section_text', 'Conoce más') }}</a>
            </div>
        </div>
    </section>
@endsection
