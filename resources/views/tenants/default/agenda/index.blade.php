@extends('tenants.default.layouts.app')

@section('title', tenantPageName('agenda', 'Agenda') . ' - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
    @section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-4" style="font-family: {{ tenantSetting('heading_font', '') }}">
                {{ tenantPageName('agenda', 'Agenda') }}
            </h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Paso 1: Seleccionar fecha y hora --}}
            <div id="step1">
                <div class="mb-3">
                    <label for="appointment_date" class="form-label">Fecha:</label>
                    <input type="date" id="appointment_date" class="form-control" required
                        min="{{ now()->toDateString() }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Hora:</label>
                    <div id="available_slots" class="d-flex flex-wrap gap-2"></div>
                </div>
            </div>

            {{-- Paso 2: Formulario con datos del usuario --}}
            <form id="appointmentForm" style="display: none;">
                @csrf
                <input type="hidden" name="available_slot_id" id="selected_slot_id">

                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Apellido Paterno:</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->last_name }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Apellido Materno:</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->second_last_name }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->phone_number }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción del Problema:</label>
                    <textarea name="description" class="form-control" maxlength="500" required></textarea>
                </div>

                <button type="button" id="showConfirmation" class="btn text-white"
                    style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Continuar
                </button>
            </form>
        </div>
    </section>

    {{-- Modal de confirmación --}}
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Fecha:</strong> <span id="confirm_date"></span></p>
                    <p><strong>Hora:</strong> <span id="confirm_time"></span></p>
                    <p><strong>Abogado:</strong> <span id="confirm_lawyer"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="appointmentForm" class="btn btn-success">Confirmar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    @include('tenants.default.layouts.footer')

    <script>
        document.getElementById('appointment_date').addEventListener('change', function() {
            const date = this.value;
            const slotsContainer = document.getElementById('available_slots');
            document.getElementById('appointmentForm').style.display = 'none';
            slotsContainer.innerHTML = '<span class="text-muted">Cargando horarios...</span>';

            fetch(`/api/available-hours?date=${date}`)
                .then(res => res.json())
                .then(data => {
                    slotsContainer.innerHTML = '';
                    if (!data.length) {
                        slotsContainer.innerHTML =
                            '<span class="text-danger">No hay horarios disponibles.</span>';
                        return;
                    }

                    data.forEach(slot => {
                        const label = document.createElement('label');
                        label.className = 'btn btn-outline-dark';
                        label.innerHTML = `
                        <input type="radio" name="slot_option" value="${slot.slot_id}" data-time="${slot.start_time}" data-lawyer="${slot.lawyer_name}">
                        ${slot.start_time.slice(0,5)} - ${slot.end_time.slice(0,5)}
                    `;

                        if (!slot.available) {
                            label.classList.add('disabled');
                            label.innerHTML += ' <small class="text-danger">(Reservada)</small>';
                            label.querySelector('input').disabled = true;
                        } else {
                            label.querySelector('input').addEventListener('change', () => {
                                document.getElementById('selected_slot_id').value = slot
                                .slot_id;
                                document.getElementById('appointmentForm').style.display =
                                    'block';
                                document.getElementById('confirm_date').textContent = date;
                                document.getElementById('confirm_time').textContent = slot
                                    .start_time.slice(0, 5);
                                document.getElementById('confirm_lawyer').textContent = slot
                                    .lawyer_name;
                            });
                        }

                        slotsContainer.appendChild(label);
                    });
                });
        });

        document.getElementById('showConfirmation').addEventListener('click', function() {
            new bootstrap.Modal(document.getElementById('confirmationModal')).show();
        });
    </script>
@endsection
