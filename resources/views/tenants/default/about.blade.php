@extends('tenants.default.layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-3" style="font-family: {{ tenantSetting('heading_font', '') }}">{{ tenantPageName('about', '¿Quiénes somos?') }}</h1>

            <div class="row align-items-center fade-in-section">
                {{-- Imagen: primer plano en móviles, segundo plano en pantallas grandes --}}
                <div class="col-md-6 text-center order-1 order-md-2 mb-4 mb-md-0">
                    <img 
                        src="{{ tenantSetting('about_path', 'images/about/About_(Predeterminado).png') }}" 
                        alt="{{ tenantSetting('name', 'Tenant') }}" 
                        class="rounded-circle img-fluid"
                        style="width: 350px; height: 350px; object-fit: cover;">
                </div>

                {{-- Texto: segundo plano en móviles, primero plano en pantallas grandes --}}
                <div class="col-md-6 order-2 order-md-1">
                    <p style="text-align: justify;">Soy Omara Muñoz Navarro, abogada especializada en derecho penal, derecho de familia, derechos humanos y litigación con perspectiva de género.</p>
                    <p style="text-align: justify;">Mi propósito es acompañarte en procesos legales complejos, entregándote herramientas claras, asesoría accesible y representación comprometida.</p>
                    <p style="text-align: justify;">Conozco el sistema desde adentro, a lo largo de mi desarrollo académico y profesional me desempeñe en las distintas instituciones que componen nuestro sistema judicial. Saber cómo desarrollan su quehacer Tribunales de Justicia; Ministerio Público; Defensoría Penal Pública; programas de apoyo a mujeres, niños, niñas y adolescentes, entre otras,  me permite orientarte de forma certera y buscar soluciones dentro de las reales posibilidades que brinda el sistema.</p>
                    <p style="text-align: justify;"><strong>"La información es poder, empodérate"</strong></p>
                </div>
            </div>

            <h1 class="mb-3 mt-5" style="font-family: 'Courier Prime', Courier">Experiencia</h1>

            <p style="text-align: justify;">
                <ul class="fade-in-section">
                    <li>Abogada títulada por la Universidad de Concepción.</li>
                    <li>Magíster en Derecho Penal y Derecho Procesal Penal, Universidad Católica del Norte (en curso).</li>
                    <li>Diplomada en Derechos Humanos y Función Pública, Universidad de Los Lagos e Instituto Nacional de Derechos Humanos.</li>
                </ul>
            </p>
        </div>
    </section>

    @include('tenants.default.layouts.footer')
@endsection
