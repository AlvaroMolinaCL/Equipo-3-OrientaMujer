@extends('tenants.default.layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
<pre>{{ print_r(tenantSetting('about_text', []), true) }}</pre>

    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-3" style="font-family: {{ tenantSetting('heading_font', '') }}">{{ tenantPageName('about', '¿Quiénes somos?') }}</h1>

            <div class="row align-items-center fade-in-section">
                {{-- Imagen: primer plano en móviles, segundo plano en pantallas grandes --}}
                <div class="col-md-6 text-center order-1 order-md-2 mb-4 mb-md-0">
                    <img 
                        src="{{ tenantSetting('about_path', 'images/about/Omara_Munoz.png') }}" 
                        alt="Omara Muñoz" 
                        class="rounded-circle img-fluid"
                        style="width: 350px; height: 350px; object-fit: cover;">
                </div>

                {{-- Texto: segundo plano en móviles, primero plano en pantallas grandes --}}
                {{-- Sección ¿Quiénes somos? --}}
                <div class="col-md-6 order-2 order-md-1">
                    {{-- ¿Quiénes somos? --}}
                    @foreach(tenantSetting('about_text', []) as $paragraph)
                        <p style="text-align: justify;">{!! $paragraph !!}</p>
                    @endforeach
                </div>
            </div>

            <h1 class="mb-3 mt-5" style="font-family: 'Courier Prime', Courier">Experiencia</h1>

            <p style="text-align: justify;">
                <h1 class="mb-3 mt-5" style="font-family: 'Courier Prime', Courier">Experiencia</h1>
                <ul class="fade-in-section" style="text-align: justify;">
                    @foreach(tenantSetting('experience_list', []) as $item)
                        <li>{!! $item !!}</li>
                    @endforeach
                </ul>
            </p>
        </div>
    </section>

    @include('tenants.default.layouts.footer')
@endsection
