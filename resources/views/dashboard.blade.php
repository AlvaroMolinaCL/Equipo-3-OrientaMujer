@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container py-5">
        <div class="alert alert-success text-center" role="alert">
            Bienvenido al panel de control, {{ Auth::user()->name ?? 'Usuario' }}.
        </div>
    </div>
@endsection
