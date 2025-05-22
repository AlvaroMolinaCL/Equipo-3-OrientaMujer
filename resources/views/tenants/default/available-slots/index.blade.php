@extends('tenants.default.layouts.panel')

@section('title', 'Disponibilidad')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <h3 class="mb-4" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Calendario de Disponibilidad</h3>
    <div id="calendar"></div>
</div>

{{-- Modal --}}
<div class="modal fade" id="dayModal" tabindex="-1" aria-labelledby="dayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
            <div class="modal-header">
                <h5 class="modal-title" id="dayModalLabel">Horarios del día</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modal-date-input" name="date">
                <div id="slots-list-modal"></div>
            </div>

        </div>
    </div>
</div>

{{-- FullCalendar + Bootstrap Modal --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const modal = new bootstrap.Modal(document.getElementById('dayModal'));
        const modalDateInput = document.getElementById('modal-date-input');
        const modalDateTitle = document.getElementById('dayModalLabel');
        const slotsList = document.getElementById('slots-list-modal');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            height: 600,
            dayMaxEvents: true,
            selectable: true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            events: '/api/slots',   
            dateClick: function (info) {
                const date = info.dateStr;
                modalDateTitle.textContent = `Horarios para el ${date}`;
                modalDateInput.value = date;
                slotsList.innerHTML = `<p class="text-muted">Cargando horarios...</p>`;
                modal.show();

                fetch(`/api/slots?date=${date}`)
                    .then(res => res.json())
                    .then(data => {
                        slotsList.innerHTML = '';

                        if (data.length === 0) {
                            slotsList.innerHTML = '<p class="text-muted">No se registran horarios disponibles.</p>';
                        } else {
                            data.forEach(slot => {
                                slotsList.innerHTML += `
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div><strong>${slot.start_time} - ${slot.end_time}</strong></div>
                                        <div>
                                            <a href="/available-slots/${slot.id}/edit" class="btn btn-sm btn-outline-secondary me-2">Editar</a>
                                            <form method="POST" action="/available-slots/${slot.id}" style="display:inline;">
                                                <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            });
                        }

                        // Solo ahora, agrega el formulario al final
                        slotsList.innerHTML += `
                            <hr class="my-4">
                            <h6 class="mb-3"><i class="bi bi-plus-circle me-1"></i> Agregar nuevo horario</h6>
                            <form method="POST" action="/available-slots" class="row g-2 align-items-center">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                                <input type="hidden" name="mode" value="puntual">
                                <input type="hidden" name="date" value="${date}">
                                <div class="col-md-4">
                                    <input type="time" name="start_time" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="time" name="end_time" class="form-control" required>
                                </div>
                                <div class="col-md-4 d-grid">
                                    <button type="submit" class="btn fw-bold"
                                        style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                                            color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};">
                                        + Agregar Horario
                                    </button>
                                </div>
                            </form>
                        `;
                    });

            }
        });

        calendar.render();
    });
</script>
@endsection