@extends('tenants.default.layouts.panel')

@section('title', 'Gestión de Disponibilidad - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<style>
    .disabled-btn {
        background-color: #ccc !important;
        color: #666 !important;
        cursor: not-allowed !important;
        pointer-events: none;
    }
</style>

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
            dayCellDidMount: function(info) {
                const cellDate = new Date(info.date);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (cellDate < today) {
                    info.el.style.backgroundColor = '#eeeeee'; // gris claro
                    info.el.style.opacity = '0.5';
                    info.el.style.cursor = 'not-allowed';
                    info.el.classList.add('fc-disabled-day'); // opcional para CSS
                }
            },

            dateClick: function (info) {
                const selectedDate = new Date(info.date);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                selectedDate.setHours(0, 0, 0, 0);

                if (selectedDate < today) return;

                const date = info.dateStr;
                const todayStr = today.toISOString().split('T')[0];

                modalDateTitle.textContent = `Horarios para el ${date}`;
                modalDateInput.value = date;
                slotsList.innerHTML = `<p class="text-muted">Cargando horarios...</p>`;
                modal.show();

                fetch(`/api/slots?date=${date}`)
                    .then(res => res.json())
                    .then(data => {
                        slotsList.innerHTML = '';

                        const isToday = date === todayStr;
                        const nowTime = new Date().toTimeString().slice(0, 5);

                        if (data.length === 0) {
                            slotsList.innerHTML = '<p class="text-muted">No se registran horarios disponibles.</p>';
                        } else {
                            data.forEach(slot => {
                                const isExpiredToday = isToday && slot.end_time <= nowTime;
                                slotsList.innerHTML += `
                                        <div class="d-flex justify-content-between align-items-center border-bottom py-2 ${isExpiredToday ? 'bg-light text-muted border border-secondary-subtle rounded-2 opacity-75' : ''}">
                                        <div><strong>${slot.start_time} - ${slot.end_time}</strong></div>
                                        <div>
                                            ${isExpiredToday ? '' : `<a href="/available-slots/${slot.id}/edit" class="btn btn-sm btn-outline-secondary me-2">Editar</a>`}
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

                        slotsList.innerHTML += `
                            <hr class="my-4">
                            <h6 class="mb-3"><i class="bi bi-plus-circle me-1"></i> Agregar nuevo horario</h6>
                            <form method="POST" action="/available-slots" class="row g-2 align-items-center">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                                <input type="hidden" name="mode" value="puntual">
                                <input type="hidden" name="date" value="${date}">
                                <div class="col-md-4">
                                    <input type="time" name="start_time" class="form-control" id="start_time_input"
                                        ${isToday ? `min="${nowTime}"` : ''} required>
                                </div>
                                <div class="col-md-4">
                                    <input type="time" name="end_time" class="form-control" id="end_time_input" required>
                                </div>
                                <div class="col-md-4 d-grid">
                                    <button id="submit-slot-btn" type="submit" class="btn fw-bold disabled-btn btn-secondary" disabled>
                                        + Agregar Horario
                                    </button>
                                </div>
                            </form>
                        `;

                        // Agregar validación interactiva
                        const startInput = document.querySelector('#start_time_input');
                        const endInput = document.querySelector('#end_time_input');

                        if (startInput && endInput) {
                            startInput.addEventListener('input', () => {
                                endInput.min = startInput.value;
                                endInput.setCustomValidity('');
                                validar();
                            });
                            endInput.addEventListener('input', () => {
                                if (endInput.value <= startInput.value) {
                                    endInput.setCustomValidity('La hora de fin debe ser posterior a la de inicio');
                                } else {
                                    endInput.setCustomValidity('');
                                }
                                validar();
                            });
                        }
                        validar();
                    });
            },

        });

        function validar() {
            const startInput = document.querySelector('input[name="start_time"]');
            const endInput = document.querySelector('input[name="end_time"]');
            const submitBtn = document.querySelector('#submit-slot-btn');

            if (!startInput || !endInput || !submitBtn) return;

            const isStartValid = startInput.checkValidity();
            const isEndValid = endInput.checkValidity();

            if (isStartValid && isEndValid) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('disabled-btn');
                submitBtn.classList.remove('btn-secondary');
                submitBtn.classList.add('btn-success');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled-btn');
                submitBtn.classList.remove('btn-success');
                submitBtn.classList.add('btn-secondary');
            }
        }
        calendar.render();
    });
</script>
@endsection