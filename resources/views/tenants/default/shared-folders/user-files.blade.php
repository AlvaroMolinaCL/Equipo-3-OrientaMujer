@extends('tenants.default.layouts.panel')

@section('title', 'Archivos de ' . $user->name)

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Archivos compartidos por {{ $user->name }}</h2>
        <a href="{{ route('files.shared.folders') }}" class="btn btn-sm"
           style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                  color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    @if($files->isEmpty())
        <p>No hay archivos compartidos por este usuario.</p>
    @else
        <div class="list-group">
            @foreach($files as $file)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $file->name }}</span>
                    <div>
                        <a href="{{ route('files.preview', $file) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Ver</a>
                        <a href="{{ route('files.download', $file) }}" class="btn btn-sm btn-outline-success">Descargar</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
