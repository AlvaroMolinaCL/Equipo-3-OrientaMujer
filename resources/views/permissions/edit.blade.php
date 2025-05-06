@extends('layouts.app')

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h2 mb-0">{{ __('Editar permisos para ') }} {{ $tenant->name }}</h2>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('tenants.permissions.update', $tenant) }}">
                @csrf

                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                    @foreach ($permisos as $permiso)
                        <div class="col">
                            <div class="form-check bg-light border rounded p-3 shadow-sm h-100">
                                <input class="form-check-input" type="checkbox" name="permisos[]"
                                    value="{{ $permiso }}" id="permiso-{{ $permiso }}"
                                    {{ in_array($permiso, $tenant->run(fn() => \Spatie\Permission\Models\Permission::pluck('name')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permiso-{{ $permiso }}">
                                    {{ $permiso }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 fs-6">
                        Guardar permisos
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
