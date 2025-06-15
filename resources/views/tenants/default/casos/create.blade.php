{{-- resources/views/cases/create.blade.php o edit.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <form method="POST" action="{{ isset($case) ? route('cases.update', [$tenantId, $case]) : route('cases.store', $tenantId) }}">
        @csrf
        @if(isset($case)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input name="title" value="{{ old('title', $case->title ?? '') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control">{{ old('description', $case->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="status" class="form-select">
                <option value="pendiente" {{ (old('status', $case->status ?? '') == 'pendiente') ? 'selected' : '' }}>Pendiente</option>
                <option value="en progreso" {{ (old('status', $case->status ?? '') == 'en progreso') ? 'selected' : '' }}>En progreso</option>
                <option value="resuelto" {{ (old('status', $case->status ?? '') == 'resuelto') ? 'selected' : '' }}>Resuelto</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Asignar a usuario</label>
            <select name="user_id" class="form-select">
                <option value="">Sin asignar</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ (old('user_id', $case->user_id ?? '') == $user->id) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">{{ isset($case) ? 'Actualizar' : 'Crear' }}</button>
    </form>
</div>
@endsection
