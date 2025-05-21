@php
    $isUser = auth()->user()->hasRole('Usuario');
    $isAdmin = auth()->user()->hasRole('Admin');
@endphp

@extends($isUser ? 'tenants.default.layouts.app' : 'tenants.default.layouts.panel')

@if ($isUser)
    @section('title', 'Mis Archivos - ' . tenantSetting('name', 'Tenant'))

    @section('navbar')
    @section('navbar-class', 'navbar-dark-mode')
        @include('tenants.default.layouts.navigation')
    @endsection
    
    @section('body-class', 'theme-dark')
@endif

@if ($isAdmin)
    @section('title', 'Gestión de Archivos - ' . tenantSetting('name', 'Tenant'))
@endif

@section('content')
    <div class="container" style="padding-top: {{ $isUser ? '100px' : '0' }};">
        {{-- Encabezado --}}
        @if ($isUser)
            <div class="d-flex justify-content-between mb-4" style="gap: 30px;">
                <a href="{{ route('files.create') }}" 
                class="cube-block flex-fill d-flex flex-column align-items-center justify-content-center text-decoration-none"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                        color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-plus-circle mb-3" style="font-size: 3.5rem;"></i>
                    <span style="font-size: 1.5rem; font-weight: 600;">Agregar archivos</span>
                </a>

                <a href="{{ route('files.shared.files') }}" 
                class="cube-block flex-fill d-flex flex-column align-items-center justify-content-center text-decoration-none"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                        color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-share-fill mb-3" style="font-size: 3.5rem;"></i>
                    <span style="font-size: 1.5rem; font-weight: 600;">Compartidos conmigo</span>
                </a>
            </div>

            <style>
                .cube-block {
                    height: 150px;
                    border-radius: 20px;
                    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                    cursor: pointer;
                    user-select: none;
                }

                .cube-block:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 16px 32px rgba(0,0,0,0.25);
                    text-decoration: none;
                }

                .cube-block i {
                    pointer-events: none; 
                }

                @media (max-width: 768px) {
                    .d-flex {
                        flex-direction: column !important;
                    }

                    .cube-block {
                        width: 100% !important;
                        margin-bottom: 20px;
                    }
                }
            </style>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-file-text me-2"></i>{{ __('Mis Archivos') }}
            </h3>
            @php
                $redirectRoute = auth()->user()->hasRole('Admin') ? route('dashboard') : route('tenants.default.index');
            @endphp
            <a href="{{ $redirectRoute }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                       color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                       border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tabla de Archivos --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                       color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                <h5 class="mb-0">Listado de Archivos</h5>
            @role('Admin')
                <a href="{{ route('files.create') }}" class="btn btn-sm"
                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};
                        color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-plus-circle"></i> Nuevo Archivo
                </a>
            @endrole

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: {{ tenantSetting('button_banner_text_color', '#FDF5E5') }};">
                            <tr>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Nombre</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Fecha</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($files as $file)
                                <tr>
                                    <td>{{ $file->name }}</td>
                                    <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                                            <a href="{{ route('files.preview', $file) }}" target="_blank"
                                                class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                                                       color: white; width: 120px;">
                                                <i class="bi bi-eye"></i> Ver
                                            </a>

                                            <a href="{{ route('files.download', $file) }}"
                                                class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }};
                                                       color: white; width: 120px;">
                                                <i class="bi bi-download"></i> Descargar
                                            </a>

                                            @if (auth()->user()->hasRole('Admin') && $file->uploaded_by == auth()->id())
                                                {{-- Botón para abrir el modal --}}
                                                <button type="button"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: #ffc107; color: black; width: 120px;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#shareModal-{{ $file->id }}">
                                                    <i class="bi bi-share"></i> Compartir
                                                </button>

                                                {{-- Modal de compartir --}}
                                                <div class="modal fade" id="shareModal-{{ $file->id }}" tabindex="-1"
                                                    aria-labelledby="shareModalLabel-{{ $file->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <form action="{{ route('files.share', $file) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                                                                           color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                                                                    <h5 class="modal-title" id="shareModalLabel-{{ $file->id }}">
                                                                        Compartir: {{ $file->name }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="mb-3">Selecciona los usuarios con los que deseas compartir este archivo:</p>
                                                                    <div class="user-list-container">
                                                                        @foreach (\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                                                                            <div class="user-item mb-2 p-2 border-bottom">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox"
                                                                                        name="user_ids[]" value="{{ $user->id }}"
                                                                                        id="userCheck-{{ $file->id }}-{{ $user->id }}"
                                                                                        {{ in_array($user->id, $file->shared_with ?? []) ? 'checked' : '' }}>
                                                                                    <label class="form-check-label d-flex justify-content-between align-items-center"
                                                                                        for="userCheck-{{ $file->id }}-{{ $user->id }}">
                                                                                        <span>{{ $user->name }}</span>
                                                                                        @if (in_array($user->id, $file->shared_with ?? []))
                                                                                            <span class="badge bg-success">Compartido</span>
                                                                                        @endif
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn"
                                                                        style="background-color: {{ tenantSetting('button_color_sidebar', '#F5E8D0') }}; color: white;">
                                                                        Guardar cambios
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (auth()->user()->hasRole('Admin') || $file->uploaded_by == auth()->id())
                                                <form action="{{ route('files.destroy', $file) }}" method="POST" class="d-flex"
                                                    style="width: 120px;"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este archivo?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm d-flex align-items-center justify-content-center gap-1 w-100"
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
