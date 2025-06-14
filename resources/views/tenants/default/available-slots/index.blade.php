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

        /* Estilos para la tabla de cargas */
        .table-custom {
            background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};
            color: #000; /* Color negro para el texto */
            border: 1px solid #dee2e6;
            border-radius: 12px;
            overflow: hidden;
        }

        .table-custom th {
            background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
            color: #fff;
            border-color: #dee2e6;
        }

        .table-custom td {
            border-color: #dee2e6 !important;
            color: #000;
        }

        .table-custom tbody tr {
            border-bottom: 1px solid #dee2e6;
        }

        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }

        .container {
            position: relative;
        }

        #batch-apply-message {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3000;
            padding: 12px 24px;
            border-radius: 8px;
            background-color: #cfe2ff;
            color: #084298;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.15);
            font-weight: bold;
            width: fit-content;
            font-size: 0.95rem;
            margin-top: 12px; /* opcional para separación */
        }

        #batch-confirmation-card {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5000;
            background-color: #fff;
            padding: 24px 32px;
            border-radius: 12px;
            border: 2px solid #dee2e6;
            box-shadow: 0 0 16px rgba(0, 0, 0, 0.15);
            text-align: center;
            max-width: 90%;
            width: 400px;
            font-size: 1rem;
            font-weight: 500;
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
                    <table class="table align-middle table-custom">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Días programados</th>
                                <th>Total horarios</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scheduleBatches as $batch)
                                <tr>
                                    <td class="fw-bold text-dark" title="Creada el {{ $batch->created_at->format('d/m/Y H:i') }}">
                                        {{ $batch->name ?? 'Carga de horarios de ' . $batch->days . ' días' }}
                                    </td>

                                    <td>{{ $batch->days }}</td>
                                    <td>{{ $batch->slots_count }}</td>
                                    <td class="text-center">
                                        {{-- Botones con íconos --}}
                                        <button type="button"
                                            class="btn btn-sm btn-outline-info me-1 preview-batch-btn"
                                            data-batch-id="{{ $batch->id }}"
                                            title="Previsualizar">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                        <form method="GET" action="{{ route('available-slots.index') }}" class="d-inline form-apply-batch">
                                            <input type="hidden" name="batch_id" value="{{ $batch->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-success me-1" title="Aplicar">
                                                <i class="bi bi-check2-circle"></i>
                                            </button>
                                        </form>

                                        <a href="{{ route('schedule-batches.edit', $batch->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <form method="POST" action="{{ route('schedule-batches.destroy', $batch->id) }}" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar esta carga?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="preview-popup" class="card shadow-sm d-none"
                        style="z-index: 2000;
                                position: fixed;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                max-width: 600px;
                                width: 90%;
                                background: #fff;
                                border-radius: 12px;
                                border: 1px solid #ccc;
                                padding: 24px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold m-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Previsualización</h5>
                            <button type="button" class="btn-close" aria-label="Cerrar" onclick="document.getElementById('preview-popup').classList.add('d-none');"></button>
                        </div>
                        <div id="preview-popup-content" style="overflow-x: auto; max-height: 400px;"></div>
                    </div>
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
        const calendarColor = "{{ tenantSetting('navbar_color_2', '#8C2D18') }}";
        const calendarTextColor = "{{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}";
        
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
                    const [year, month, day] = info.dateStr.split('-');
                    const startDate = new Date(parseInt(year), parseInt(month) - 1, parseInt(day));

                    if (batchPreviewMode && document.getElementById('batch-apply-message') && batchPreviewSlots.length > 0) {
                        // Eliminar tarjeta anterior si ya existe
                        const existingCard = document.getElementById('batch-confirmation-card');
                        if (existingCard) existingCard.remove();

                        // Crear tarjeta
                        const card = document.createElement('div');
                        card.id = 'batch-confirmation-card';
                        card.innerHTML = `
                            <p class="mb-3">¿Estás seguro de aplicar esta carga comenzando desde el <strong>${startDate.toLocaleDateString('es-CL')}</strong>?</p>
                            <div class="d-flex justify-content-center gap-3 mt-3">
                                <button class="btn btn-success" id="confirm-apply-yes">Sí</button>
                                <button class="btn btn-outline-secondary" id="confirm-apply-no">No</button>
                            </div>
                        `;
                        document.body.appendChild(card);

                        document.getElementById('confirm-apply-yes').addEventListener('click', () => {
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
                                card.remove();
                                if (response.success) {
                                    window.location.href = '{{ route('available-slots.index') }}';
                                } else {
                                    alert('Hubo un choque de horarios al intentar realizar la carga.');
                                }
                            });
                        });

                        document.getElementById('confirm-apply-no').addEventListener('click', () => {
                            card.remove();
                        });

                        return; // Detiene la ejecución para que no se abra el modal
                    }

                    // Si no está en modo batch, se ejecuta flujo normal
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
                fetch(`/api/batch-preview?id=${batchId}`)
                .then(res => res.json())
                .then(data => {
                    batchPreviewSlots = data;
                });

                const calendarBox = document.getElementById('calendar');
                const msg = document.createElement('div');
                msg.id = 'batch-apply-message';
                msg.className = 'alert alert-primary text-center fw-bold shadow';
                msg.innerHTML = `
                    <i class="bi bi-mouse me-1"></i>
                    Selecciona el día en el calendario donde deseas comenzar a aplicar la carga de horarios.
                    <a href="{{ route('available-slots.index') }}" class="btn btn-sm btn-outline-secondary ms-3">Cancelar</a>
                `;
                calendarBox.insertAdjacentElement('afterend', msg);
            }

            // Aplicar colores personalizados desde tenantSetting
            document.documentElement.style.setProperty('--fc-border-color', '{{ tenantSetting('color_tables', '#8C2D18') }}');
            document.documentElement.style.setProperty('--fc-event-bg-color', '{{ tenantSetting('navbar_color_2', '#8C2D18') }}');
            document.documentElement.style.setProperty('--fc-event-text-color', '{{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}');

            document.querySelectorAll('.preview-batch-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    const batchId = this.dataset.batchId;
                    const popup = document.getElementById('preview-popup');
                    const popupContent = document.getElementById('preview-popup-content');

                    fetch(`/api/batch-preview?id=${batchId}`)
                        .then(res => res.json())
                        .then(data => {
                            const days = {};

                            // Agrupar por day_index
                            data.forEach(slot => {
                                if (!days[slot.day_index]) {
                                    days[slot.day_index] = [];
                                }
                                days[slot.day_index].push(slot);
                            });

                            // Ordenar por hora de inicio
                            for (let day in days) {
                                days[day].sort((a, b) => a.start_time.localeCompare(b.start_time));
                            }

                            // Construir tabla
                            let html = `
                                <div style="overflow-x: auto; max-width: 100%;">
                                    <table class="table table-sm mb-0" style="min-width: 900px;">
                                        <thead><tr>`;
                            Object.keys(days).forEach(day => {
                                html += `<th>Día ${parseInt(day) + 1}</th>`;
                            });

                            const maxRows = Math.max(...Object.values(days).map(arr => arr.length));
                            for (let i = 0; i < maxRows; i++) {
                                html += '<tr>';
                                Object.values(days).forEach(slots => {
                                    const slot = slots[i];
                                    if (slot) {
                                        html += `<td><span class="badge rounded-pill d-block text-truncate px-2 py-1"
                                            style="background-color: ${calendarColor}; color: ${calendarTextColor}; font-size: 0.875rem; text-align: center;">
                                            ${slot.start_time.slice(0, 5)} - ${slot.end_time.slice(0, 5)}
                                        </span></td>`;
                                    } else {
                                        html += `<td></td>`;
                                    }
                                });
                                html += '</tr>';
                            }

                            html += `</tbody></table></div>`;
                            popupContent.innerHTML = html;
                            popup.classList.remove('d-none');
                        });
                });
            });

            // Cerrar el popup al hacer clic fuera
            document.addEventListener('click', function (e) {
                const popup = document.getElementById('preview-popup');
                const isInside = popup.contains(e.target);
                const isButton = e.target.closest('.preview-batch-btn');

                if (!isInside && !isButton) {
                    popup.classList.add('d-none');
                }
            });

            document.querySelectorAll('.form-apply-batch').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const batchIdInput = this.querySelector('input[name="batch_id"]');
                    if (!batchIdInput) return;

                    const batchId = batchIdInput.value;

                    // Redirigir con el batch_id en la URL
                    const url = new URL(window.location.href);
                    url.searchParams.set('batch_id', batchId);
                    window.location.href = url.toString();
                });
            });

            calendar.render();
        });
    </script>
@endsection