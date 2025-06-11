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
            display: block;
        }

        .fc .fc-daygrid-event {
            font-size: 0.875rem;
            padding: 2px 4px;
            border: none;
            border-radius: 4px;
            background-color:
                {{ tenantSetting('navbar_color_2', '#8C2D18') }}
            ;
            color:
                {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}
            ;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        .fc .fc-col-header-cell-cushion {
            display: block;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-align: center;
            text-transform: capitalize;
            font-weight: bold;
            font-size: 0.95rem;
            color:
                {{ tenantSetting('text_color_1', '#8C2D18') }}
            ;
        }

        .fc .fc-daygrid-day-number {
            color:
                {{ tenantSetting('text_color_1', '#8C2D18') }}
            ;
            font-weight: normal;
        }

        .fc .fc-toolbar-title {
            text-transform: capitalize;
            color:
                {{ tenantSetting('text_color_1', '#8C2D18') }}
            ;
            display: inline-block;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-weight: bold;
        }

        .fc .fc-daygrid-event-harness {
            display: flex;
            justify-content: center;
            max-width: 100%;
            width: 100%;
            flex: 1 1 100%;
            overflow: hidden;
            box-sizing: border-box;
        }

        .fc .fc-event-main {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
            box-sizing: border-box;
        }

        .fc .fc-event-title {
            display: block;
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fc .fc-daygrid-more-link {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 2px;
            padding: 2px 6px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
            background-color:
                {{ tenantSetting('navbar_color_2', '#8C2D18') }}
            ;
            color:
                {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}
            ;
            border-radius: 4px;
            text-decoration: none !important;
            pointer-events: auto;
        }

        .fc .fc-daygrid-more-link:hover,
        .fc .fc-daygrid-more-link:focus {
            background-color:
                {{ tenantSetting('navbar_color_2', '#8C2D18') }}
                !important;
            color:
                {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}
                !important;
            box-shadow: none !important;
            text-decoration: none !important;
        }

        .fc-daygrid-event-harness+.fc-daygrid-more-link {
            align-self: center;
        }

        .fc-event-title .icon-in-progress {
            display: inline-block;
            vertical-align: middle;
            font-size: 0.85rem;
            color: #ffc107;
            margin-left: 5px;
            line-height: 1;
        }
    </style>

    <div class="container">
        <h3 class="fw-bold mt-3 mb-4" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            <i class="bi bi-calendar-event me-2"></i>{{ __('Calendario de Disponibilidad') }}
        </h3>
        <div id="calendar"></div>
        <div class="text-center mt-5 mb-3">
            <a href="{{ route('schedule-batches.create') }}"
            class="btn fw-bold"
            style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                    color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};
                    padding: 10px 20px;
                    border-radius: 8px;">
                <i class="bi bi-calendar-plus me-2"></i>Crear Carga de Horarios
            </a>
        </div>

        {{-- Listado de Cargas Guardadas --}}
        <div class="mt-5">
            <h4 class="fw-bold mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-layers me-2"></i>Cargas de horarios guardadas
            </h4>

            @if($scheduleBatches->isEmpty())
                <p class="text-muted">Aún no has guardado ninguna carga de horarios.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha creación</th>
                                <th scope="col">Días programados</th>
                                <th scope="col">Total horarios</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scheduleBatches as $batch)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ \Carbon\Carbon::parse($batch->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($batch->start_date)->diffInDays($batch->end_date) + 1 }}</td>
                                    <td>{{ $batch->slots_count }}</td>
                                    <td>
                                        <form method="GET" action="{{ route('available-slots.index') }}">
                                            <input type="hidden" name="batch_id" value="{{ $batch->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                Aplicar carga
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="dayModal" tabindex="-1" aria-labelledby="dayModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="dayModalLabel">Horarios del día</h5>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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
                buttonText: {
                    today: 'Hoy'
                },
                
                height: 600,
                eventOrder: "start,-duration,allDay,title",
                dayMaxEvents: 1,
                eventDisplay: 'block',
                moreLinkContent: function (args) {
                    return {
                        html: `<span class="more-badge">+${args.num} más</span>`
                    };
                },

                eventDidMount: function(info) {
                    if (info.event.extendedProps.in_progress) {
                        const titleEl = info.el.querySelector('.fc-event-title');
                        if (titleEl) {
                            const icon = document.createElement('i');
                            icon.className = 'bi bi-clock-fill icon-in-progress';
                            titleEl.appendChild(icon);
                        }
                    }
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
                    if (batchPreviewMode && batchPreviewSlots.length > 0) {
                        const startDate = new Date(info.dateStr);
                        const confirmApply = confirm("¿Deseas aplicar esta carga comenzando desde el " + startDate.toLocaleDateString('es-CL') + "?");

                        if (!confirmApply) return;

                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                        fetch('/api/apply-batch', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                batch_id: batchId,
                                start_date: info.dateStr
                            })
                        }).then(res => res.json())
                        .then(response => {
                            if (response.success) {
                                window.location.href = '{{ route('available-slots.index') }}';
                            } else {
                                alert('Ocurrió un error al aplicar la carga.');
                            }
                        });

                        return;
                    }

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
                                data.sort((a, b) => a.start_time.localeCompare(b.start_time));
                                data.forEach((slot, index) => {
                                    const startFormatted = slot.start_time.slice(0, 5);
                                    const endFormatted = slot.end_time.slice(0, 5);
                                    const isExpiredToday = isToday && slot.end_time <= nowTime;
                                    const isOngoing = isToday && slot.start_time <= nowTime && slot.end_time > nowTime;
                                    const isLast = index === data.length - 1;

                                    slotsList.innerHTML += `
                                        <div class="d-flex justify-content-between align-items-center py-2 ${!isLast ? 'border-bottom' : ''} ${isExpiredToday ? 'bg-light text-muted border border-secondary-subtle rounded-2 opacity-75' : ''}">
                                            <div class="d-flex align-items-center gap-2">
                                                <strong class="m-0">${startFormatted} - ${endFormatted}</strong>
                                                ${isOngoing ? '<span class="badge text-bg-warning">En curso</span>' : ''}
                                            </div>
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
                                <div class="border-bottom pb-2 mb-3"></div>
                                <p class="fw-bold mb-3" style="font-size: 0.95rem; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    <i class="bi bi-plus-circle me-1"></i> Añadir nuevo horario disponible
                                </p>
                                <form method="POST" action="/available-slots" class="row g-2 align-items-center">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                                    <input type="hidden" name="mode" value="puntual">
                                    <input type="hidden" name="date" value="${date}">
                                    <div class="col-md-4">
                                        <label for="start_time_input" class="form-label">Hora de Inicio</label>
                                        <input type="text" name="start_time" id="start_time_input" class="form-control flat-time" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="end_time_input" class="form-label">Hora de Término</label>
                                        <input type="text" name="end_time" id="end_time_input" class="form-control flat-time" required>
                                    </div>
                                    <div class="col-md-4 d-grid align-self-end">
                                        <button id="submit-slot-btn" type="submit" class="btn fw-bold disabled-btn btn-secondary" disabled>
                                            + Agregar Horario
                                        </button>
                                    </div>
                                </form>
                                <div class="col-12">
                                    <div id="error-message" class="text-danger small mt-2" aria-live="polite">
                                        <!-- Mensaje dinámico aquí -->
                                    </div>
                                </div>
                            `;

                            const startInput = document.querySelector('#start_time_input');
                            const endInput = document.querySelector('#end_time_input');

                            if (startInput && endInput) {
                                startInput.addEventListener('input', () => {
                                    endInput.min = startInput.value;
                                    validarHorario(date);
                                });
                                endInput.addEventListener('input', () => {
                                    validarHorario(date);
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

            function validarHorario(date) {
                const start = document.querySelector('#start_time_input').value;
                const end = document.querySelector('#end_time_input').value;
                const submitBtn = document.querySelector('#submit-slot-btn');
                const errorMessage = document.querySelector('#error-message');
                const now = new Date();
                const localDate = new Date(now.getTime() - now.getTimezoneOffset() * 60000);
                const today = localDate.toISOString().split('T')[0];
                const nowTime = now.toTimeString().slice(0, 5);

                resetEstado();

                if (!start || !end) return;

                // PRIORIDAD 1: Hora de término inválida
                if (!esRangoValido(start, end)) {
                    mostrarError('La hora de término debe ser posterior a la hora de inicio.');
                    return;
                }

                // PRIORIDAD 2: Hora anterior a la actual (solo si es hoy)
                if (esDiaHoy(date, today) && esHoraPasada(start, nowTime)) {
                    mostrarError('La hora de inicio no puede ser anterior a la hora actual.');
                    return;
                }

                // PRIORIDAD 3: Conflictos con horarios existentes
                fetch(`/api/slots?date=${date}`)
                    .then(res => res.json())
                    .then(slots => {
                        const conflictos = detectarTodosLosConflictos(start, end, slots);
                        if (conflictos.length > 0) {
                            const mensajes = conflictos.map(slot =>
                                `Este horario disponible choca con el de ${slot.start_time.slice(0,5)} - ${slot.end_time.slice(0,5)}.`
                            );
                            mostrarError(mensajes.join('<br>'));
                            return;
                        }

                        habilitarBoton();
                    });

                function resetEstado() {
                    errorMessage.textContent = '';
                    submitBtn.disabled = true;
                    setBtnDeshabilitado();
                }

                function mostrarError(msg) {
                    errorMessage.innerHTML = msg;
                }

                function habilitarBoton() {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('disabled-btn', 'btn-secondary');
                    submitBtn.classList.add('btn-success');
                }

                function esRangoValido(inicio, termino) {
                    return inicio < termino;
                }

                function esDiaHoy(fechaSeleccionada, fechaActual) {
                    return fechaSeleccionada === fechaActual;
                }

                function esHoraPasada(hora, ahora) {
                    return hora < ahora;
                }

                function timeToMinutes(timeStr) {
                    const [h, m] = timeStr.split(':').map(Number);
                    return h * 60 + m;
                }

                function detectarTodosLosConflictos(start, end, slots) {
                    const startMin = timeToMinutes(start);
                    const endMin = timeToMinutes(end);

                    return slots.filter(slot => {
                        const slotStartMin = timeToMinutes(slot.start_time.slice(0, 5));
                        const slotEndMin = timeToMinutes(slot.end_time.slice(0, 5));
                        return !(endMin < slotStartMin || startMin > slotEndMin);
                    });
                }
            }

            function setBtnDeshabilitado() {
                const btn = document.querySelector('#submit-slot-btn');
                btn.classList.add('disabled-btn');
                btn.classList.remove('btn-success');
                btn.classList.add('btn-secondary');
            }

            const batchId = new URLSearchParams(window.location.search).get('batch_id');
            let batchPreviewSlots = [];
            let batchPreviewMode = false;

            if (batchId) {
                batchPreviewMode = true;

                const alert = document.createElement('div');
                alert.className = 'alert alert-info text-center mt-4 fw-bold';
                alert.innerHTML = `
                    <i class="bi bi-mouse me-1"></i>Selecciona el día en el calendario donde deseas comenzar a aplicar la carga de horarios.
                    <a href="{{ route('available-slots.index') }}" class="btn btn-sm btn-outline-secondary ms-3">Cancelar</a>
                `;
                document.querySelector('.container').appendChild(alert);

                fetch(`/api/batch-preview?id=${batchId}`)
                    .then(res => res.json())
                    .then(data => {
                        batchPreviewSlots = data;
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