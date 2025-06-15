@extends('tenants.default.layouts.app')

@section('title', 'Confirmar Cita - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-light-mode')
@include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
<section class="py-5" style="margin-top: 80px;">
    <div class="container">
        <h1 class="mb-4"
            style="font-family: {{ tenantSetting('heading_font', '') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            Confirmar Cita
        </h1>

        <div class="mb-4">
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($slot->date)->format('d/m/Y') }}</p>
            <p><strong>Hora:</strong> {{ substr($slot->start_time, 0, 5) }} - {{ substr($slot->end_time, 0, 5) }}</p>
        </div>

        <form action="{{ route('tenant.agenda.store') }}" method="POST">
            @csrf
            <input type="hidden" name="available_slot_id" value="{{ $slot->id }}">
<input type="hidden" name="questionnaire_response_id" value="{{ $questionnaireResponseId }}">
    
            <div class="mb-3">
                <label for="first_name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                    placeholder="Por ejemplo: Alejandra Andrea" value="{{ old('first_name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                    placeholder="Por ejemplo: Pérez" value="{{ old('last_name', $user->last_name) }}" required>
            </div>
            <div class="mb-3">
                <label for="second_last_name" class="form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="second_last_name" name="second_last_name"
                    placeholder="Por ejemplo: Pérez" value="{{ old('second_last_name', $user->second_last_name) }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Por ejemplo: miemail@gmail.com" value="{{ old('email', $user->email) }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                    placeholder="Por ejemplo: 987654321" value="{{ old('phone_number', $user->phone_number) }}" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="residence_region_id" class="form-label">Región de Residencia:</label>
                    <select name="residence_region_id" id="residence_region_id" class="form-select" required>
                        <option value="">Selecciona una región</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}"
                                {{ old('residence_region_id', optional($user->commune)->region_id) == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="residence_commune_id" class="form-label">Comuna de Residencia:</label>
                    <select name="residence_commune_id" id="residence_commune_id" class="form-select" required>
                        <option value="">Selecciona una comuna</option>
                        @foreach ($communes as $commune)
                            <option value="{{ $commune->id }}" data-region="{{ $commune->region_id }}"
                                {{ old('residence_commune_id', $user->address_commune) == $commune->id ? 'selected' : '' }}>
                                {{ $commune->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="incident_region_id" class="form-label">Región donde ocurrieron los hechos:</label>
                    <select name="incident_region_id" id="incident_region_id" class="form-select" required>
                        <option value="">Selecciona una región</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}"
                                {{ old('incident_region_id') == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="incident_commune_id" class="form-label">Comuna donde ocurrieron los hechos:</label>
                    <select name="incident_commune_id" id="incident_commune_id" class="form-select" required>
                        <option value="">Selecciona una comuna</option>
                        @foreach ($communes as $commune)
                            <option value="{{ $commune->id }}" data-region="{{ $commune->region_id }}"
                                {{ old('incident_commune_id') == $commune->id ? 'selected' : '' }}>
                                {{ $commune->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn text-white mt-4"
                style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                <i class="bi bi-credit-card me-1"></i> Continuar
            </button>
        </form>
    </div>
</section>

<script>
    function filterCommunes(regionSelectId, communeSelectId) {
        const regionId = document.getElementById(regionSelectId).value;
        const communeSelect = document.getElementById(communeSelectId);
        Array.from(communeSelect.options).forEach(option => {
            if (!option.value) return;
            option.style.display = option.getAttribute('data-region') == regionId ? '' : 'none';
        });
        communeSelect.value = '';
    }

    document.getElementById('residence_region_id').addEventListener('change', function() {
        filterCommunes('residence_region_id', 'residence_commune_id');
    });
    document.getElementById('incident_region_id').addEventListener('change', function() {
        filterCommunes('incident_region_id', 'incident_commune_id');
    });

    filterCommunes('residence_region_id', 'residence_commune_id');
    filterCommunes('incident_region_id', 'incident_commune_id');
</script>
@endsection
