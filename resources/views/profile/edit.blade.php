@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: #8C2D18;">
                <i class="bi bi-person me-2"></i>{{ __('Perfil') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        <div class="card shadow border-0 mb-4" style="background-color: #FDF5E5;">
            <div class="card-body p-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card shadow border-0 mb-4" style="background-color: #FDF5E5;">
            <div class="card-body p-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card shadow border-0" style="background-color: #FDF5E5;">
            <div class="card-body p-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
