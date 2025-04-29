@extends('layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-dark-mode')
    @include('layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-4" style="font-family: 'Courier Prime', Courier">Servicios</h1>

            <div class="row g-4">
                {{-- Recuadro 1 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm fade-in-section">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Asesoría jurídica integral">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Asesoría jurídica integral</h5>
                            <p class="card-text">
                                <p style="text-align: justify;">Te ofrezco un servicio de orientación legal para identificar el escenario jurídico que enfrentas.</p>
                                <p style="text-align: justify;">Conocerás:</p>
                                <ul>
                                    <li style="text-align: justify;">La procedencia de acciones judiciales en materias de violencia contra la mujer.</li>
                                    <li style="text-align: justify;">Pasos a seguir para iniciar procedimientos judiciales.</li>
                                    <li style="text-align: justify;">Análisis de la necesidad de representación privada o derivación a organismos públicos.</li>
                                    <li style="text-align: justify;">Explicación clara de la dinámica de los procesos en derecho penal, familia y otras áreas.</li>
                                    <li style="text-align: justify;">Derivación segura a abogadas especializadas si así lo requieres.</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Recuadro 2 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm fade-in-section">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Representación judicial">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Representación judicial en causas de derecho penal, familia, u otros</h5>
                            <p class="card-text">
                                <p style="text-align: justify;">Te represento en procesos judiciales penales, de familia u otras materias, comprometiéndome a:</p>
                                <ul>
                                    <li style="text-align: justify;">Diseñar contigo la estrategia de defensa o acción.</li>
                                    <li style="text-align: justify;">Representar tus intereses bajo perspectiva de género, territorio, interculturalidad, derechos humanos, según corresponda.</li>
                                    <li style="text-align: justify;">Informarte en cada etapa, asegurando tu participación activa en la toma de decisiones.</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Recuadro 3 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm fade-in-section">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Capacitaciones y charlas">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Capacitaciones y charlas</h5>
                            <p class="card-text">
                                <p style="text-align: justify;">Realizo talleres, charlas y capacitaciones para grupos en contextos académicos, laborales o comunitarios.</p>
                                <p style="text-align: justify;">Temáticas abordadas:</p>
                                <ul>
                                    <li style="text-align: justify;">Sensibilización en género.</li>
                                    <li style="text-align: justify;">Normativa nacional e internacional sobre derechos humanos, género y otras materias.</li>
                                    <li style="text-align: justify;">Funcionamiento práctico de los procedimientos judiciales.</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection