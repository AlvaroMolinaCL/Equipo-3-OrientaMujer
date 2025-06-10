@extends('tenants.default.layouts.panel')

@section('title', 'Editar Disponibilidad - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mt-3 mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-calendar-event me-2"></i>{{ __('Editar Disponibilidad') }}
            </h3>
            <a href="{{ route('available-slots.index') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                  color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                  border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('available-slots.update', $slot) }}"
                    class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf
                    @method('PUT')

                    <h5 class="fw-bold mb-4"
                        style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                        <i class="bi bi-info-circle me-2"></i>Información de la Disponibilidad
                    </h5>

                    {{-- Fecha (Solo lectura) --}}
                    <div class="mb-4">
                        <label for="date" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-calendar-date me-1"></i>Fecha
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-calendar3"></i>
                            </span>
                            <input id="date" type="date" class="form-control border-start-0" disabled
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                value="{{ old('date', $slot->date) }}">
                            <input type="hidden" name="date" value="{{ old('date', $slot->date) }}">

                        </div>
                    </div>

                    <div class="row align-items-end g-2 mb-3">
                        {{-- Hora Inicio --}}
                        <div class="col-md-6">
                            <label for="start-time" class="form-label fw-medium"
                                style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-clock me-1"></i>Hora Inicio
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"
                                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    <i class="bi bi-clock-history"></i>
                                </span>
                                <input id="start-time" type="text" class="form-control border-start-0 flat-timepicker"
                                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                    name="start_time" value="{{ old('start_time', $slot->start_time) }}" required>
                            </div>
                            @error('start_time')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Hora Fin --}}
                        <div class="col-md-6">
                            <label for="end-time" class="form-label fw-medium"
                                style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-clock-fill me-1"></i>Hora Fin
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"
                                    style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    <i class="bi bi-clock-history"></i>
                                </span>
                                <input id="end-time" type="text" class="form-control border-start-0 flat-timepicker"
                                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                    name="end_time" value="{{ old('end_time', $slot->end_time) }}" required>
                            </div>
                            @error('end_time')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Mensaje de error dinámico --}}
                        <div class="col-12">
                            <div class="text-danger small mt-2" id="edit-error-message" aria-live="polite"></div>
                        </div>
                    </div>

                    {{-- Botón de Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" id="save-slot-btn" class="btn fw-medium py-1 btn-secondary" disabled
                            style="width: 250px;">
                            <i class="bi bi-save me-2"></i>Guardar Disponibilidad
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const startInput = document.getElementById('start-time');
        const endInput = document.getElementById('end-time');
        const saveBtn = document.getElementById('save-slot-btn');
        const slotId = {{ $slot->id }};
        const date = "{{ $slot->date }}";
        const errorMessage = document.getElementById('edit-error-message');

        function resetEstado() {
            errorMessage.textContent = '';
            saveBtn.disabled = true;
            saveBtn.classList.remove('btn-success');
            saveBtn.classList.add('btn-secondary');
        }

        function mostrarError(msg) {
            errorMessage.innerHTML = msg;
            saveBtn.disabled = true;
            saveBtn.classList.remove('btn-success');
            saveBtn.classList.add('btn-secondary');
        }

        function habilitarBoton() {
            errorMessage.textContent = '';
            saveBtn.disabled = false;
            saveBtn.classList.remove('btn-secondary');
            saveBtn.classList.add('btn-success');
        }

        function timeToMinutes(timeStr) {
            const [h, m] = timeStr.split(':').map(Number);
            return h * 60 + m;
        }

        function esHoraPasada(hora, ahora) {
            return hora < ahora;
        }

        function esDiaHoy(fechaSeleccionada, fechaActual) {
            return fechaSeleccionada === fechaActual;
        }

        function validar() {
            const parsedDate = new Date(date);
            const formattedDate = parsedDate.toISOString().split('T')[0];
            const start = startInput.value;
            const end = endInput.value;
            const now = new Date();
            const localDate = new Date(now.getTime() - now.getTimezoneOffset() * 60000);
            const today = localDate.toISOString().split('T')[0];
            const nowTime = now.toTimeString().slice(0, 5);

            resetEstado();

            if (!start || !end) return;

            // PRIORIDAD 1: Hora fin menor o igual a inicio
            if (start >= end) {
                mostrarError('La hora de término debe ser posterior a la hora de inicio.');
                return;
            }

            // PRIORIDAD 2: Hora pasada en el día actual
            if (esDiaHoy(formattedDate, today) && esHoraPasada(start, nowTime)) {
                mostrarError('La hora de inicio no puede ser anterior a la hora actual.');
                return;
            }

            // PRIORIDAD 3: Chequear conflictos
            fetch(`/api/slots?date=${date}`)
                .then(res => res.json())
                .then(slots => {
                    const startMin = timeToMinutes(start);
                    const endMin = timeToMinutes(end);

                    const conflictos = slots.filter(slot => {
                        if (parseInt(slot.id) === parseInt(slotId)) return false;
                        const slotStart = timeToMinutes(slot.start_time.slice(0, 5));
                        const slotEnd = timeToMinutes(slot.end_time.slice(0, 5));
                        return !(endMin < slotStart || startMin > slotEnd);
                    });

                    if (conflictos.length > 0) {
                        const mensajes = conflictos.map(slot =>
                            `Este horario disponible choca con el de ${slot.start_time.slice(0, 5)} - ${slot.end_time.slice(0, 5)}.`
                        );
                        mostrarError(mensajes.join('<br>'));
                        return;
                    }

                    // ✅ Todo válido
                    habilitarBoton();
                })
                .catch(err => {
                    console.error("Error al validar disponibilidad:", err);
                    mostrarError('Ocurrió un error al validar el horario.');
                });
        }

        startInput.addEventListener('input', () => {
            endInput.min = startInput.value;
            validar();
        });

        endInput.addEventListener('input', validar);

        validar();
    });

    flatpickr(".flat-timepicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
</script>
@endsection