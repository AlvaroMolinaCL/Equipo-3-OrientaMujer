@extends('tenants.default.layouts.app')

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
        
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        
            <form method="POST" action="{{ route('tenant.agenda.store') }}" class="mb-5">
                @csrf
            
                <div class="mb-3">
                    <label for="appointment_date" class="form-label">Fecha:</label>
                    <input type="date" id="appointment_date" name="date" class="form-control" required min="{{ now()->toDateString() }}">
                    @error('date') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Hora:</label>
                    <div id="available_slots" class="d-flex flex-wrap gap-2"></div>
                    @error('available_slot_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            
                <button type="submit" class="btn text-white"
                    style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Agendar Cita
                </button>
            </form>
        </div>
    </section>

    @include('tenants.default.layouts.footer')

    <script>
        document.getElementById('appointment_date').addEventListener('change', function () {
            const date = this.value;
            const slotsContainer = document.getElementById('available_slots');
        
            slotsContainer.innerHTML = '<span class="text-muted">Cargando horarios...</span>';
        
            if (!date) return;
        
            fetch(`/api/available-hours?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    slotsContainer.innerHTML = '';
                
                    if (data.length === 0) {
                        slotsContainer.innerHTML = '<span class="text-danger">No hay horarios disponibles para esta fecha.</span>';
                        return;
                    }
                
                    data.forEach(slot => {
                        const start = slot.start_time.slice(0,5); // "HH:MM"
                        const end = slot.end_time.slice(0,5);
                    
                        const label = document.createElement('label');
                        label.className = 'btn text-black border-dark';
                        label.style.backgroundColor = '{{ tenantSetting('navbar_color_1', '#4A1D0B') }}';
                        label.style.borderRadius = '10px';
                        label.innerHTML = `
                            <input type="radio" name="available_slot_id" value="${slot.slot_id}" autocomplete="off" required>
                            ${start} - ${end}
                        `;
                    
                        if (!slot.available) {
                            label.classList.add('disabled');
                            label.innerHTML += ' <small class="text-danger">(Reservada)</small>';
                            label.querySelector('input').disabled = true;
                        }
                    
                        slotsContainer.appendChild(label);
                    });
                })
                .catch(error => {
                    console.error(error);
                    slotsContainer.innerHTML = '<span class="text-danger">Error al cargar horarios.</span>';
                });
        });
    </script>

@endsection
