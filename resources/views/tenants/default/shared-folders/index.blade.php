@extends('tenants.default.layouts.panel')

@section('title', 'Archivos Compartidos')

@section('content')
<div class="container">
    <h2 class="h4 mb-4" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Usuarios que compartieron archivos</h2>
    <div class="row">
        @forelse($users as $user)
            <div class="col-md-4 mb-3">
                <a href="{{ route('files.shared.byUser', $user) }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-folder-fill" style="font-size: 2rem; color: #BF8A49;"></i>
                            <h5 class="mt-2" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">{{ $user->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p>No hay archivos compartidos aún.</p>
        @endforelse
    </div>
</div>
@endsection
