@extends('tenants.default.layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-4" style="font-family: 'Courier Prime', Courier">Usuari@</h1>
        </div>
        
        <div class="container">
            <p class="mb-5">
                En construcción.
            </p>
        </div>
    </section>

    @include('tenants.default.layouts.footer')
@endsection
