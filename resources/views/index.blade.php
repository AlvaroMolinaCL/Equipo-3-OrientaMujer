@extends('layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-dark-mode')
    @include('layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@section('content')
    <section class="hero-section">
        <div class="hero-overlay">
            <div class="hero-text">
                <h1>La información es poder, <br><strong>¡empodérate!</strong></h1>
                <p class="mt-3">Acompañamiento jurídico y empático.</p>
                <a href="/agenda" class="btn btn-consulta" role="button">Agenda tu asesoría</a>
                <br>
                <a href="/contacto" class="link-consulta">Realice una consulta</a>
            </div>
        </div>
    </section>

    <section id="section1" class="scroll-section">
        Sección adicional 1
    </section>
    <section id="section2" class="scroll-section">
        Sección adicional 2
    </section>
    <section id="section3" class="scroll-section">
        Sección adicional 3
    </section>

    @include('layouts.footer')
@endsection
