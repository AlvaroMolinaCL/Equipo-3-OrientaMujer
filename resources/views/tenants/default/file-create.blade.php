@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <h2>Subir nuevo archivo</h2>

    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Archivo</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button class="btn btn-primary">Subir</button>
    </form>
</div>
@endsection
