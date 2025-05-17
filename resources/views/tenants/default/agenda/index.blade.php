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
                    <label for="date" class="form-label">Fecha:</label>
                    <input type="date" id="date" name="date" class="form-control" required min="{{ now()->toDateString() }}">
                    @error('date') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            
                <div class="mb-3">
                    <label for="time" class="form-label">Hora:</label>
                    <input type="time" id="time" name="time" class="form-control" required>
                    @error('time') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            
                <button type="submit" class="btn text-white"
                    style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Agendar Cita
                </button>
            </form>
        </div>
    </section>

    @include('tenants.default.layouts.footer')
@endsection
