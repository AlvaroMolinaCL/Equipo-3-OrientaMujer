@extends('layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-4" style="font-family: 'Courier Prime', Courier">Contacto</h1>
            <p class="mb-5">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
            </p>

            <div class="row">
                {{-- Recuadro 1 --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0">
                            <div class="col-4 d-flex align-items-center justify-content-center">
                                <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="img-fluid rounded-circle" alt="Imagen 2">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">Instagram</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac tempor dui sagittis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recuadro 2 --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0">
                            <div class="col-4 d-flex align-items-center justify-content-center">
                                <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="img-fluid rounded-circle" alt="Imagen 2">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">Correo</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac tempor dui sagittis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recuadro 3 --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0">
                            <div class="col-4 d-flex align-items-center justify-content-center">
                                <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="img-fluid rounded-circle" alt="Imagen 3">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">LinkedIn</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac tempor dui sagittis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--
                {{-- Recuadro 4 --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0">
                            <div class="col-4 d-flex align-items-center justify-content-center">
                                <img src="/images/banner/Banner_Principal_OrientaMujer.png" class="img-fluid rounded-circle" alt="Imagen 4">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">Chat</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac tempor dui sagittis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            -->
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection
