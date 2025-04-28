@extends('layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-3" style="font-family: 'Courier Prime', Courier">Sobre Orienta Mujer</h1>

            <div class="row align-items-center">
                {{-- Imagen: primer plano en móviles, segundo plano en pantallas grandes --}}
                <div class="col-md-6 text-center order-1 order-md-2 mb-4 mb-md-0">
                    <img 
                        src="images/about/Omara_Munoz.jpg" 
                        alt="Omara Muñoz" 
                        class="rounded-circle img-fluid"
                        style="width: 350px; height: 350px; object-fit: cover;">
                </div>

                {{-- Texto: segundo plano en móviles, primero plano en pantallas grandes --}}
                <div class="col-md-6 order-2 order-md-1">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
                    <p>Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.</p>
                    <p>Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
                    <p>Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.</p>
                    <p>Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.</p>
                </div>
            </div>

            <h1 class="mb-3 mt-5" style="font-family: 'Courier Prime', Courier">Experiencia</h1>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
            <p>Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.</p>
            <p>Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
            <p>Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.</p>
            <p>Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.</p>
        </div>
    </section>

    @include('layouts.footer')
@endsection
