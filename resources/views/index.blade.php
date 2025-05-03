@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Tenants</h2>
            <a href="{{ route('tenants.create') }}" class="btn btn-primary">Agregar Tenant</a>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Dominio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant)
                                <tr>
                                    <td>{{ $tenant->name }}</td>
                                    <td>{{ $tenant->email }}</td>
                                    <td>
                                        @foreach ($tenant->domains as $domain)
                                            {{ $domain->domain }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1 flex-wrap">

                                            {{-- Ver --}}
                                            <a href="http://{{ $tenant->domains->first()->domain }}"
                                                class="btn btn-sm btn-primary">
                                                Ver sitio
                                            </a>

                                            {{-- Editar --}}
                                            <a href="{{ route('tenants.edit', $tenant) }}"
                                                class="btn btn-sm btn-warning text-white">
                                                Editar
                                            </a>

                                            {{-- Eliminar --}}
                                            <form action="{{ route('tenants.destroy', $tenant) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este tenant?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
