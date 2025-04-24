@extends('layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-dark-mode') {{-- O navbar-light-mode si prefieres fondo blanco --}}
    @include('layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@section('content')
    <section class="hero-section">
        <div class="hero-overlay">
            <div class="hero-text">
                <h1>La información es poder, <br><strong>¡empodérate!</strong></h1>
                <p class="mt-3">Acompañamiento jurídico y empático.</p>
                <button class="btn btn-consulta">Agenda tu asesoría</button>
                <br>
                <a href="#" class="link-consulta">Realice una consulta</a>
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

    <footer>
        &copy; 2025 Orienta Mujer. Desarrollado por [nombre pendiente].
    </footer>
@endsection
