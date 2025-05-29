@extends('tenants.default.layouts.panel')

@section('title', 'Gestión de Disponibilidad - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <style>
        .fc-theme-standard .fc-scrollgrid {
            border: 1px solid #ccc !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .fc-theme-standard td,
        .fc-theme-standard th {
            border: 1px solid #dee2e6;
        }

        .fc .fc-daygrid-day-frame {
            padding: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .fc .fc-daygrid-event {
            font-size: 0.875rem;
            padding: 2px 4px;
            border: none;
            border-radius: 4px;
            background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
            color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            max-width: 100%;
        }

        .fc .fc-col-header-cell-cushion {
            text-transform: capitalize;
            font-weight: bold;
            font-size: 0.95rem;
            color: {{ tenantSetting('text_color_1', '#8C2D18') }};
        }

        .fc .fc-daygrid-day-number {
            color: {{ tenantSetting('text_color_1', '#8C2D18') }};
            font-weight: normal;
        }

        .fc .fc-toolbar-title {
            text-transform: capitalize;
            color: {{ tenantSetting('text_color_1', '#8C2D18') }};
        }

        .fc .fc-daygrid-event-harness {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .fc .fc-event-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fc .fc-daygrid-more-link {
            display: inline-block;
            margin-top: 5px;
            padding: 2px 6px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
            background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
            color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};
            border-radius: 4px;
            text-decoration: none !important;
            pointer-events: auto;
        }

        .fc .fc-daygrid-more-link:hover, .fc .fc-daygrid-more-link:focus {
            background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }} !important;
            color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }} !important;
            box-shadow: none !important;
            text-decoration: none !important;
        }

        .fc-daygrid-event-harness + .fc-daygrid-more-link {
            align-self: center;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
            initialDate: new Date(),
            locale: 'es',
            height: 600,
            eventOrder: "start,-duration,allDay,title",
            dayMaxEvents: 1,
            eventDisplay: 'block',

            moreLinkContent: function(args) {
                return {
                    html: `<span class="more-badge">+${args.num} más</span>`
                };
            },

            selectable: true,
            dayHeaders: true,
            dayHeaderFormat: { weekday: 'long' },
            titleFormat: {
                year: 'numeric',
                month: 'long'
            },

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            events: '/api/slots',

            dayCellDidMount: function (info) {
                const cellDate = new Date(info.date);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (cellDate < today) {
                    info.el.style.backgroundColor = '#eeeeee';
                    info.el.style.opacity = '0.5';
                    info.el.style.cursor = 'not-allowed';
                    info.el.classList.add('fc-disabled-day');
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
                const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const fechaFormateada = selectedDate.toLocaleDateString('es-CL', opcionesFecha);

                modalDateTitle.textContent = `Horarios para el ${fechaFormateada.charAt(0).toUpperCase() + fechaFormateada.slice(1)}`;
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
                            // Ordenar los horarios por hora de inicio (formato 24h)
                            data.sort((a, b) => a.start_time.localeCompare(b.start_time));
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
                                    <input type="text" name="start_time" id="start_time_input" class="form-control flat-time" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="end_time" id="end_time_input" class="form-control flat-time" required>
                                </div>
                                <div class="col-md-4 d-grid">
                                    <button id="submit-slot-btn" type="submit" class="btn fw-bold disabled-btn btn-secondary" disabled>
                                        + Agregar Horario
                                    </button>
                                </div>
                            </form>
                        `;

                        const startInput = document.querySelector('#start_time_input');
                        const endInput = document.querySelector('#end_time_input');

                        if (startInput && endInput) {
                            startInput.addEventListener('input', () => {
                                endInput.min = startInput.value;
                                validarSolapamiento(date);
                            });
                            endInput.addEventListener('input', () => {
                                validarSolapamiento(date);
                            });
                        }

                        flatpickr(".flat-time", {
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                            time_24hr: true
                        });
                    });
            }
        });

        function validarSolapamiento(date) {
            const start = document.querySelector('#start_time_input').value;
            const end = document.querySelector('#end_time_input').value;
            const submitBtn = document.querySelector('#submit-slot-btn');

            if (!start || !end || end <= start) {
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled-btn');
                submitBtn.classList.remove('btn-success');
                submitBtn.classList.add('btn-secondary');
                return;
            }

            fetch(`/api/slots?date=${date}`)
                .then(res => res.json())
                .then(slots => {
                    const solapado = slots.some(slot => {
                        return (start < slot.end_time && end > slot.start_time);
                    });

                    if (solapado) {
                        submitBtn.disabled = true;
                        submitBtn.classList.add('disabled-btn');
                        submitBtn.classList.remove('btn-success');
                        submitBtn.classList.add('btn-secondary');
                    } else {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('disabled-btn');
                        submitBtn.classList.remove('btn-secondary');
                        submitBtn.classList.add('btn-success');
                    }
                });
            }
            calendar.render();

            // Aplicar colores personalizados desde tenantSetting
            document.documentElement.style.setProperty('--fc-border-color', '{{ tenantSetting('color_tables', '#8C2D18') }}');
            document.documentElement.style.setProperty('--fc-event-bg-color', '{{ tenantSetting('navbar_color_2', '#8C2D18') }}');
            document.documentElement.style.setProperty('--fc-event-text-color', '{{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}');
        });
    </script>
@endsection