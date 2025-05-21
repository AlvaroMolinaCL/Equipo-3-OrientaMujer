@extends('tenants.default.layouts.panel')

@section('title', 'Gestión de Disponibilidad - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-calendar me-2"></i>{{ __('Disponibilidad') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                       color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                       border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tabla de Disponibilidad --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                               color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                <h5 class="mb-0">Listado de Bloques Horarios</h5>
                <a href="{{ route('available-slots.create') }}" class="btn btn-sm"
                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};
                                   color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-plus-circle"></i> Nueva Disponibilidad
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: {{ tenantSetting('button_banner_text_color', '#FDF5E5') }};">
                            <tr>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Fecha</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Horario</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Máx. Reservas</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($slots as $slot)
                                <tr>
                                    <td>{{ $slot->date }}</td>
                                    <td>{{ substr($slot->start_time, 0, 5) }} - {{ substr($slot->end_time, 0, 5) }}</td>
                                    <td>{{ $slot->max_bookings }}</td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                                            {{-- Ver Reservas --}}
                                            <button
                                                class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                                style="background-color: {{ tenantSetting('background_color_2', '#FDF5E5') }};
                                                   color: {{ tenantSetting('text_color_2', '#8C2D18') }};"
                                                data-bs-toggle="modal" data-bs-target="#slotModal"
                                                data-slot-id="{{ $slot->id }}" data-slot-date="{{ $slot->date }}"
                                                data-slot-start="{{ substr($slot->start_time, 0, 5) }}"
                                                data-slot-end="{{ substr($slot->end_time, 0, 5) }}">
                                                <i class="bi bi-eye"></i> Ver Reservas
                                            </button>

                                            {{-- Editar --}}
                                            <a href="{{ route('available-slots.edit', $slot) }}"
                                                class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                                style="background-color: {{ tenantSetting('background_color_2', '#FDF5E5') }};
                                                   color: {{ tenantSetting('text_color_2', '#8C2D18') }};">
                                                <i class="bi bi-pencil"></i> Editar
                                            </a>

                                            {{-- Eliminar --}}
                                            <form action="{{ route('available-slots.destroy', $slot) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar esta disponibilidad?')"
                                                class="w-100">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: #dc3545; color: white;">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No has definido horarios aún.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="slotModal" tabindex="-1" aria-labelledby="slotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                        color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                    <h5 class="modal-title" id="slotModalLabel">Detalle de Reservas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="reservations-container">
                        <p class="text-center">Cargando reservas...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('slotModal');

            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const slotId = button.getAttribute('data-slot-id');

                const container = document.getElementById('reservations-container');
                container.innerHTML = '<p class="text-center">Cargando reservas...</p>';

                fetch(`/available-slots/${slotId}/reservations`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            container.innerHTML =
                                '<p class="text-center">No hay reservas para este bloque.</p>';
                            return;
                        }

                        let content = `<div class="accordion" id="reservationsAccordion">`;

                        data.forEach((res, index) => {
                            content += `
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading${index}">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse${index}"
                                        aria-expanded="false" aria-controls="collapse${index}">
                                        ${res.user_name} - ${res.created_at}
                                    </button>
                                </h2>
                                <div id="collapse${index}" class="accordion-collapse collapse"
                                     aria-labelledby="heading${index}" data-bs-parent="#reservationsAccordion">
                                    <div class="accordion-body">
                                        <p><strong>Email:</strong> ${res.email}</p>
                                        <p><strong>Teléfono:</strong> ${res.phone || 'No registrado'}</p>
                                        <div class="d-flex gap-2 mt-3">
                                            <button class="btn btn-success btn-sm">Confirmar</button>
                                            <button class="btn btn-danger btn-sm">Anular</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        });

                        content += `</div>`;
                        container.innerHTML = content;
                    })
                    .catch(err => {
                        container.innerHTML =
                            '<p class="text-danger">Error al cargar las reservas.</p>';
                        console.error(err);
                    });
            });
        });
    </script>
@endsection
