@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h2 mb-0">{{ __('Agregar Tenant') }}</h2>
        </div>

        <div class="card shadow">
            <div class="card-body">
            <form method="POST" action="{{ route('tenants.store') }}" enctype="multipart/form-data">
            @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                            required autofocus>
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                            required>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="domain_name" class="form-label">Dominio</label>
                        <input id="domain_name" type="text" class="form-control" name="domain_name"
                            value="{{ old('domain_name') }}" required>
                        @error('domain_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                            required>
                        @error('password_confirmation')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo 1</label>
                        <input id="logo" type="file" class="form-control" name="logo" accept="image/*">
                        @error('logo')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="logo1" class="form-label">Logo 2</label>
                        <input id="logo1" type="file" class="form-control" name="logo1" accept="image/*">
                        @error('logo1')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="background_color" class="form-label">Color de fondo</label>
                        <input id="background_color" type="color" class="form-control form-control-color" name="background_color"
                            value="{{ old('background_color', '#ffffff') }}">
                        @error('background_color')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="navbar_color" class="form-label">Color de la barra de navegación</label>
                        <input id="navbar_color" type="color" class="form-control form-control-color" name="navbar_color"
                            value="{{ old('navbar_color', '#343a40') }}">
                        @error('navbar_color')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="body_font" class="form-label">Tipografía del cuerpo</label>
                        <select id="body_font" class="form-select" name="body_font">
                            <option value="Arial" {{ old('body_font') == 'Arial' ? 'selected' : '' }}>Arial</option>
                            <option value="Roboto" {{ old('body_font') == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                            <option value="Open Sans" {{ old('body_font') == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                            <option value="Montserrat" {{ old('body_font') == 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                        </select>
                        @error('body_font')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Crear Tenant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
