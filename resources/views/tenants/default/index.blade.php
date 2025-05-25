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
                <h1>{!! tenantText('slogan_text', 'La información es poder, <strong>¡empodérate!</strong>') !!}</h1>
                <p class="mt-3">
                    {!! tenantText('slogan_body', 'Una representación judicial con perspectiva de género, exige un acompañamiento empático e
                                                                            informado para alivianar las cargas del proceso.') !!}
                </p>
                <a href="/contact" class="btn btn-consulta" role="button">Agenda tu asesoría</a>
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
                <h1 class="mb-5 text-center">Sobre {{ tenantSetting('id', 'Orienta Mujer') }}</h1>
                <div class="col-md-6 order-2 order-md-1 fade-in-section">
                    {!! tenantText('about_text', '
                                                        <p style="text-align: justify;">
                                                            Soy Omara Muñoz Navarro, abogada especializada en derecho penal, derecho de familia, derechos
                                                            humanos y litigación con perspectiva de género.
                                                        </p>
                                                        <p style="text-align: justify;">
                                                            Mi propósito es acompañarte en procesos legales complejos, entregándote herramientas claras,
                                                            asesoría accesible y representación comprometida.
                                                        </p>
                                                        <p style="text-align: justify;">
                                                            Conozco el sistema desde adentro, a lo largo de mi desarrollo académico y profesional me desempeñé
                                                            en las distintas instituciones que componen nuestro sistema judicial. Saber cómo desarrollan su
                                                            quehacer Tribunales de Justicia; Ministerio Público; Defensoría Penal Pública; programas de apoyo a
                                                            mujeres, niños, niñas y adolescentes, entre otras, me permite orientarte de forma certera y buscar
                                                            soluciones dentro de las reales posibilidades que brinda el sistema.
                                                        </p>
                                                    ') !!}
                    <div class="text-center">
                        <a href="/about" class="btn btn-consulta" style="background-color: #ffffff54; !important"
                            role="button">Conoce más</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section2" class="scroll-section py-5">
        <div class="container">
            <h1 class="mb-5 text-center">¿Qué servicios te ofrezco?</h1>
            <div class="row g-4">
                {{-- Recuadro 1 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 fade-in-section">
                        <img src="{{ asset('images/services/' . (tenant()->services_path_1 ?? 'Servicio_(Predeterminado).png')) }}"
                            class="card-img-top" alt="Asesoría jurídica integral">

                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold;">
                                {!! tenantText('service1_title', 'Asesoría jurídica integral') !!}
                            </h5>
                            {!! tenantText('service1_body', '<p style="text-align: justify;">Te ofrezco un servicio de orientación legal para identificar el escenario jurídico que enfrentas.</p>') !!}
                        </div>
                    </div>
                </div>

                {{-- Recuadro 2 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 fade-in-section">
                        <img src="{{ asset('images/services/' . (tenantSetting('services_path_2', 'Servicio_(Predeterminado).png'))) }}"
                            class="card-img-top" alt="Representación judicial">

                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold;">
                                {!! tenantText('service2_title', 'Asesoría jurídica integral') !!}
                            </h5>
                            {!! tenantText('service2_body', '<p style="text-align: justify;">Te represento en procesos judiciales penales, de familia u otras materias.</p>') !!}

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
                                {!!tenantText('service3_title', 'Asesoría jurídica integral') !!}
                            </h5>
                            {!! tenantText('service3_body', '<p style="text-align: justify;">Realizo talleres, charlas y capacitaciones para grupos en contextos académicos, laborales o comunitarios.</p>') !!}

                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="/services" class="btn btn-consulta fade-in-section" style="background-color: #ffffff54; !important"
                    role="button">Revisa más detalles</a>
            </div>
        </div>
    </section>
    @include('tenants.default.layouts.footer')
@endsection