@extends('tenants.default.layouts.app')

@section('title', tenantPageName('questionnaire', 'Cuestionario Pre-Agendamiento') . ' - ' . tenantSetting('name',
    'Tenant'))

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-3" style="font-family: {{ tenantSetting('heading_font', '') }}">¡Muchas gracias por tu tiempo!</h1>
                <p class="lead" style="font-family: {{ tenantSetting('body_font', '') }}">Este cuestionario es fundamental para prepararnos y acompañarte de forma clara, cercana y
                efectiva. Una vez recibido, nos pondremos en contacto contigo para coordinar la asesoría jurídica más
                adecuada a tus necesidades</p>
                <a href="/" class="btn mt-3" style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">Volver al inicio</a>
            </div>
        </div>
    </section>
@endsection
