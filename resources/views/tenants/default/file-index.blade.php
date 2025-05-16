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
                    <th>Subido por</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file->name }}</td>
                        <td>{{ $file->uploader->name ?? 'Desconocido' }}</td>
                        <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('files.download', $file) }}" class="btn btn-sm btn-success">Descargar</a>
                            <a href="{{ route('files.preview', $file) }}" target="_blank" class="btn btn-sm btn-info">Ver</a>

                            @if(auth()->user()->hasRole('Admin') && $file->uploaded_by == auth()->id())
                                {{-- Compartir solo si es Admin y es el dueño --}}
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

                            {{-- Eliminar: si es Admin o dueño del archivo --}}
                            @if(auth()->user()->hasRole('Admin') || $file->uploaded_by == auth()->id())
                                <form action="{{ route('files.destroy', $file) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este archivo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection