@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        <h2>Gestor de Archivos</h2>

        <a href="{{ route('files.create') }}" class="btn btn-primary mb-3">Subir nuevo archivo</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file->name }}</td>
                        <td>
                            <a href="{{ route('files.download', $file) }}" class="btn btn-sm btn-success">Descargar</a>
                            @if(auth()->user()->hasRole('Admin') && $file->uploaded_by == auth()->id())
                                <form action="{{ route('files.share', $file) }}" method="POST" class="d-inline">
                                    @csrf
                                    <select name="user_ids[]" multiple class="form-select form-select-sm">
                                        @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-warning mt-1">Compartir</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection