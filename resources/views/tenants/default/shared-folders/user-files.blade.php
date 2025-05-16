@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-folder-symlink me-2"></i>
                Archivos compartidos por {{ $user->name }}
            </h2>
            <a href="{{ route('files.shared.folders') }}" class="btn btn-sm" style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                      color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                      border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        @if($files->isEmpty())
            <div class="alert alert-info">
                No hay archivos compartidos por este usuario.
            </div>
        @else
            {{-- Tabla de archivos --}}
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                                                   color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                    <h5 class="mb-0">Listado de Archivos Compartidos</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background-color: {{ tenantSetting('button_banner_text_color', '#FDF5E5') }};">
                                <tr>
                                    <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                        Nombre</th>
                                    <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                        Fecha</th>
                                    <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($files as $file)
                                    <tr>
                                        <td>{{ $file->name }}</td>
                                        <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                                <a href="{{ route('files.preview', $file) }}" target="_blank"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }}; color: white; width: 120px;">
                                                    <i class="bi bi-eye"></i> Ver
                                                </a>
                                                <a href="{{ route('files.download', $file) }}"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }}; color: white; width: 120px;">
                                                    <i class="bi bi-download"></i> Descargar
                                                </a>

                                                @if(auth()->user()->hasRole('Admin') || $file->uploaded_by == auth()->id())
                                                    <form action="{{ route('files.destroy', $file) }}" method="POST" class="d-flex"
                                                        style="width: 120px;"
                                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este archivo?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="btn btn-sm d-flex align-items-center justify-content-center gap-1 w-100"
                                                            style="background-color: #dc3545; color: white;">
                                                            <i class="bi bi-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .user-list-container {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 8px;
        }

        .user-item:hover {
            background-color: #f8f9fa;
        }

        .user-list-container::-webkit-scrollbar {
            width: 6px;
        }

        .user-list-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .user-list-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .user-list-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0.5rem auto;
            }
        }
    </style>
@endsection