@extends('layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-dark-mode')
    @include('layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@section('content')
    <section class="hero-section">
        <div class="hero-overlay">
            <div class="hero-text fade-in-section">
                <h1>La información es poder, <br><strong>¡empodérate!</strong></h1>
                <p class="mt-3">Una representación judicial con perspectiva de género, exige un acompañamiento empático e informado para alivianar las cargas del proceso.</p>
                <a href="/contacto" class="btn btn-consulta" role="button">Agenda tu asesoría</a>
                <br>
                <!-- <a href="/contacto" class="link-consulta">Realiza una consulta</a> -->
            </div>
        </div>
    </section>

    <section id="section1" class="scroll-section py-5">
        <div class="container">
            <div class="row align-items-center">
                {{-- Imagen: primer plano en móviles, segundo plano en pantallas grandes --}}
                <div class="col-md-6 text-center order-1 order-md-2 mb-4 mb-md-0 fade-in-section">
                    <img 
                        src="images/about/Omara_Munoz.jpg" 
                        alt="Omara Muñoz" 
                        class="rounded-circle img-fluid"
                        style="width: 350px; height: 350px; object-fit: cover;">
                </div>
    
                {{-- Texto: segundo plano en móviles, primer plano en pantallas grandes --}}
                <h1 class="mb-5 text-center">Sobre Orienta Mujer</h1>
                <div class="col-md-6 order-2 order-md-1 fade-in-section">
                    <p style="text-align: justify;">
                        Soy Omara Muñoz Navarro, abogada especializada en derecho penal, derecho de familia, derechos humanos y litigación con perspectiva de género.
                    </p>
                    <p style="text-align: justify;">
                        Mi propósito es acompañarte en procesos legales complejos, entregándote herramientas claras, asesoría accesible y representación comprometida.
                    </p>
                    <p style="text-align: justify;">
                        Conozco el sistema desde adentro, a lo largo de mi desarrollo académico y profesional me desempeñé en las distintas instituciones que componen nuestro sistema judicial. Saber cómo desarrollan su quehacer Tribunales de Justicia; Ministerio Público; Defensoría Penal Pública; programas de apoyo a mujeres, niños, niñas y adolescentes, entre otras, me permite orientarte de forma certera y buscar soluciones dentro de las reales posibilidades que brinda el sistema.
                    </p>
                    <div class="text-center">
                        <a href="/acerca-de" class="btn btn-consulta" style="background-color: #ffffff54; !important" role="button">Conoce más</a>
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
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Asesoría jurídica integral">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Asesoría jurídica integral</h5>
                            <p style="text-align: justify;">Te ofrezco un servicio de orientación legal para identificar el escenario jurídico que enfrentas.</p>
                        </div>
                    </div>
                </div>
    
                {{-- Recuadro 2 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 fade-in-section">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Representación judicial">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Representación judicial</h5>
                            <p style="text-align: justify;">Te represento en procesos judiciales penales, de familia u otras materias.</p>
                        </div>
                    </div>
                </div>
    
                {{-- Recuadro 3 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 fade-in-section">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Capacitaciones y charlas">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Capacitaciones y charlas</h5>
                            <p style="text-align: justify;">Realizo talleres, charlas y capacitaciones para grupos en contextos académicos, laborales o comunitarios.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="/servicios" class="btn btn-consulta fade-in-section" style="background-color: #ffffff54; !important" role="button">Revisa más detalles</a>
            </div>
        </div>
    </section>
    <!--
        <section id="section3" class="scroll-section py-5">
            <div class="container">
                <h1 class="mb-5 text-center">Contacto</h1>
            
                <div class="row">
                    {{-- Tarjeta: Correo --}}
                    <div class="col-md-4 mb-4">
                        <a href="mailto:omaramunoznavarro@gmail.com" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm fade-in-section">
                                <div class="row g-0">
                                    <div class="col-3 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-envelope fa-3x text-light"></i>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">Correo</h5>
                                            <p class="card-text mb-0"><small>omaramunoznavarro@gmail.com</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                
                    {{-- Tarjeta: Instagram --}}
                    <div class="col-md-4 mb-4">
                        <a href="https://www.instagram.com/orientamujer.cl" target="_blank" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm fade-in-section">
                                <div class="row g-0">
                                    <div class="col-3 d-flex align-items-center justify-content-center">
                                        <i class="fab fa-instagram fa-3x text-light"></i>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">Instagram</h5>
                                            <p class="card-text mb-0">@orientamujer.cl</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                
                    {{-- Tarjeta: LinkedIn --}}
                    <div class="col-md-4 mb-4">
                        <a href="https://www.linkedin.com/in/omaramuñoznavarro" target="_blank" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm fade-in-section">
                                <div class="row g-0">
                                    <div class="col-3 d-flex align-items-center justify-content-center">
                                        <i class="fab fa-linkedin fa-3x text-light"></i>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">LinkedIn</h5>
                                            <p class="card-text mb-0"><small><small>linkedin.com/in/omaramuñoznavarro</small></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>                        
            </div>
        </section>
    -->
    @include('layouts.footer')
@endsection
