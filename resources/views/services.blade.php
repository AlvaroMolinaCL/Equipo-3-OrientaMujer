@extends('layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-dark-mode')
    @include('layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@section('content')
    <section class="py-5" style="margin-top: 80px;"> {{-- margen por navbar fija --}}
        <div class="container">
            <h1 class="mb-4">Servicios</h1>
        </div>
    </section>
@endsection
