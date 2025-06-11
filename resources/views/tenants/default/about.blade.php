@extends('tenants.default.layouts.app')

@section('title', tenantPageName('about', 'Quiénes Somos') . ' - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-3" style="font-family: {{ tenantSetting('heading_font', '') }}">
                {{ tenantPageName('about', '¿Quiénes somos?') }}
            </h1>

            <div class="row align-items-center fade-in-section">
                {{-- Imagen: primer plano en móviles, segundo plano en pantallas grandes --}}
                <div class="col-md-6 text-center order-1 order-md-2 mb-4 mb-md-0">
                    <img src="{{ asset('images/about/' . tenantSetting('about_path', 'About_(Predeterminado).png')) }}"
                        alt="{{ tenantSetting('name', 'Tenant') }}" class="rounded-circle img-fluid"
                        style="width: 350px; height: 350px; object-fit: cover;">

                </div>

                {{-- Texto: segundo plano en móviles, primero plano en pantallas grandes --}}
                <div class="col-md-6 order-2 order-md-1">
                    {!! tenantText(
                        'about_us',
                        '
                            <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a odio purus. Nullam nec commodo urna, vel dignissim enim. Aenean ac quam sit amet libero volutpat ornare.</p>
                            <p style="text-align: justify;">Nunc at odio ac magna sagittis varius. Maecenas ut orci vel felis maximus condimentum.</p>
                            <p style="text-align: justify;">Aliquam erat volutpat. Mauris pretium aliquam neque vitae efficitur. Sed massa neque, malesuada ut blandit in, maximus non lorem. Sed nec eleifend odio. Vivamus faucibus maximus pellentesque. Duis posuere placerat vestibulum. Sed tincidunt ligula odio, sit amet tempor leo elementum et. Quisque bibendum hendrerit libero.</p>
                            <p style="text-align: justify;"><strong>"Duis rhoncus, ipsum at vehicula aliquet"</strong></p>
                        ',
                    ) !!}
                </div>

            </div>

            <h1 class="mb-3 mt-5" style="font-family: 'Arial'">Experiencia</h1>

            <div>
                {!! tenantText(
                    'experience',
                    '
                        <ul class="fade-in-section">
                            <li>Orci varius natoque penatibus et magnis dis parturient montes.</li>
                            <li>Morbi arcu felis, tristique in neque vitae, imperdiet finibus elit.</li>
                            <li>Aliquam pulvinar ligula a mi lobortis efficitur.</li>
                        </ul>
                    ',
                ) !!}
            </div>

        </div>
    </section>
@endsection
