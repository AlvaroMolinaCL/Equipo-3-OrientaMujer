@extends('tenants.default.layouts.app')

@section('title', tenantPageName('agenda', 'Agenda') . ' - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

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
        }

        .fc .fc-col-header-cell-cushion,
        .fc .fc-toolbar-title,
        .fc .fc-daygrid-day-number {
            color:
                {{ tenantSetting('text_color_1', '#8C2D18') }}
            ;
        }

        .fc .fc-daygrid-more-link {
            margin-top: 5px;
            padding: 2px 6px;
            font-size: 0.8rem;
            font-weight: 500;
            background-color:
                {{ tenantSetting('navbar_color_2', '#8C2D18') }}
            ;
            color:
                {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}
            ;
            border-radius: 4px;
            text-decoration: none !important;
        }

        .fc .fc-daygrid-more-link:hover {
            background-color:
                {{ tenantSetting('navbar_color_2', '#8C2D18') }}
            ;
            color:
                {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}
            ;
        }

        .fc-daygrid-event-harness+.fc-daygrid-more-link {
            align-self: center;
        }

        .fc .fc-col-header-cell-cushion {
            text-transform: capitalize;
            font-weight: bold;
            font-size: 0.95rem;
            color:
                {{ tenantSetting('text_color_1', '#8C2D18') }}
            ;
        }

        .fc .fc-toolbar-title {
            text-transform: capitalize;
            color:
                {{ tenantSetting('text_color_1', '#8C2D18') }}
            ;
        }
    </style>

    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h3 class="mb-4" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Selecciona un horario disponible
            </h3>
            <a href="{{ route('tenants.default.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Volver al Inicio
            </a>
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
    </section>

    @include('tenants.default.layouts.footer')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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

                moreLinkContent: function (args) {
                    return { html: `<span class="more-badge">+${args.num} más</span>` };
                },

                selectable: true,
                dayHeaders: true,
                dayHeaderFormat: { weekday: 'long' },
                titleFormat: { year: 'numeric', month: 'long' },

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false,
                    hour12: false
                },

                events: '/api/client-slots',

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
                    const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    const fechaFormateada = selectedDate.toLocaleDateString('es-CL', opcionesFecha);
                    modalDateTitle.textContent = `Horarios para el ${fechaFormateada.charAt(0).toUpperCase() + fechaFormateada.slice(1)}`;
                    modalDateInput.value = date;
                    slotsList.innerHTML = `<p class="text-muted">Cargando horarios...</p>`;
                    modal.show();


                    const formatTime = timeStr => timeStr.slice(0, 5);

                    fetch(`/api/client-slots?date=${date}`)
                        .then(res => res.json())
                        .then(data => {
                            slotsList.innerHTML = '';
                            if (data.length === 0) {
                                slotsList.innerHTML = '<p class="text-muted">No se registran horarios disponibles.</p>';
                            } else {
                                data.sort((a, b) => a.start_time.localeCompare(b.start_time));
                                data.forEach(slot => {
                                    const start = formatTime(slot.start_time);
                                    const end = formatTime(slot.end_time);
                                    slotsList.innerHTML += `
                                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                            <div><strong>${start} - ${end}</strong></div>
                                            <a href="/agenda/confirmar?slot_id=${slot.id}" class="btn btn-sm btn-primary" title="Agendar este horario">Agendar</a>
                                        </div>
                                    `;
                                });
                            }
                        });
                }
            });

            calendar.render();
        });
    </script>

@endsection