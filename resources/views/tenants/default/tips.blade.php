@extends('tenants.default.layouts.app')

@section('title', tenantPageName('tips', 'Tips') . ' - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-dark-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-4" style="font-family: {{ tenantSetting('heading_font', '') }}">
                {{ tenantPageName('tips', 'Tips') }}</h1>
            <p class="mb-5">
                {!! tenantText(
                    'body_tips',
                    '
                        <p style="text-align: justify;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel dapibus nunc.
                    ',
                ) !!}
            </p>
        </div>
    </section>
@endsection
