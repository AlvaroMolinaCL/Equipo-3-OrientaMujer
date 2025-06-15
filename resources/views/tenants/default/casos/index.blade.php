@extends('tenants.default.layouts.panel')

@section('title', 'Editar Rol - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
    @include('tenants.default.layouts.sidebar')
@endsection
@section('content')
<div class="container">
    <a href="{{ route('cases.create', $tenantId) }}" class="btn btn-primary mb-3">Crear nuevo caso</a>
    <table class="table">
        <thead><tr><th>Título</th><th>Estado</th><th>Asignado a</th><th>Acciones</th></tr></thead>
        <tbody>
            @foreach($cases as $case)
            <tr>
                <td>{{ $case->title }}</td>
                <td>{{ $case->status }}</td>
                <td>{{ $case->user->name ?? 'No asignado' }}</td>
                <td><a href="{{ route('cases.edit', [$tenantId, $case]) }}" class="btn btn-sm btn-warning">Editar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
