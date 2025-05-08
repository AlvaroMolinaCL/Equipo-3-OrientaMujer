@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-4">403 - Acceso denegado</h1>
    <p class="lead">No tienes permisos para acceder a esta sección del sistema.</p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Volver al panel</a>
</div>
@endsection
