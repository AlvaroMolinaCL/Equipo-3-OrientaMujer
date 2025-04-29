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
                <a href="/agenda" class="btn btn-consulta" role="button">Agenda tu asesoría</a>
                <br>
                <a href="/contacto" class="link-consulta">Realice una consulta</a>
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
                </div>
            </div>
        </div>
    </section>
    
    <section id="section2" class="scroll-section py-5">
        <div class="container">
            <div class="row g-4">
                {{-- Recuadro 1 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 fade-in-section">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Asesoría jurídica integral">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Asesoría jurídica integral</h5>
                            <p style="text-align: justify;">Te ofrezco un servicio de orientación legal para identificar el escenario jurídico que enfrentas.</p>
                            <p style="text-align: justify;">Conocerás:</p>
                            <ul>
                                <li style="text-align: justify;">La procedencia de acciones judiciales en materias de violencia contra la mujer.</li>
                                <li style="text-align: justify;">Pasos a seguir para iniciar procedimientos judiciales.</li>
                                <li style="text-align: justify;">Análisis de la necesidad de representación privada o derivación a organismos públicos.</li>
                                <li style="text-align: justify;">Explicación clara de la dinámica de los procesos en derecho penal, familia y otras áreas.</li>
                                <li style="text-align: justify;">Derivación segura a abogadas especializadas si así lo requieres.</li>
                            </ul>
                        </div>
                    </div>
                </div>
    
                {{-- Recuadro 2 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 fade-in-section">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Representación judicial">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Representación judicial</h5>
                            <p style="text-align: justify;">Te represento en procesos judiciales penales, de familia u otras materias, comprometiéndome a:</p>
                            <ul>
                                <li style="text-align: justify;">Diseñar contigo la estrategia de defensa o acción.</li>
                                <li style="text-align: justify;">Representar tus intereses bajo perspectiva de género, territorio, interculturalidad, derechos humanos, según corresponda.</li>
                                <li style="text-align: justify;">Informarte en cada etapa, asegurando tu participación activa en la toma de decisiones.</li>
                            </ul>
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
                            <p style="text-align: justify;">Temáticas abordadas:</p>
                            <ul>
                                <li style="text-align: justify;">Sensibilización en género.</li>
                                <li style="text-align: justify;">Normativa nacional e internacional sobre derechos humanos, género y otras materias.</li>
                                <li style="text-align: justify;">Funcionamiento práctico de los procedimientos judiciales.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--
        <section id="section3" class="scroll-section">
            Sección adicional 3
        </section>
    -->
    @include('layouts.footer')
@endsection
