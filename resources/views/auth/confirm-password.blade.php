@extends('layouts.guest')

@section('content')
    <div class="container mt-5">
        <p class="mb-4">Esta es un área segura. Por favor confirma tu contraseña antes de continuar.</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
@endsection
