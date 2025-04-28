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
                    <div class="card h-100 shadow-sm">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Asesoría jurídica integral">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Asesoría jurídica integral</h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Recuadro 2 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Representación judicial">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Representación judicial en causas de derecho penal, familia, u otros</h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisi. Nulla quis sem at nibh elementum imperdiet.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Recuadro 3 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="card-img-top" alt="Capacitaciones y charlas">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">Capacitaciones y charlas</h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection