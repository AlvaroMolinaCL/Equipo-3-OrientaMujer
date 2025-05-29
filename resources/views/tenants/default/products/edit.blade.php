@extends('tenants.default.layouts.panel')

@section('title', 'Editar Plan - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-pencil-square me-2"></i>{{ __('Editar Plan') }}
            </h3>
            <a href="{{ route('products.index') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                           color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                           border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
            <div class="card-body p-4">
                <form action="{{ route('products.update', $product) }}" method="POST"
                    class="bg-white p-4 rounded-3 shadow-sm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h5 class="fw-medium mb-3"
                        style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                        <i class="bi bi-info-circle me-2"></i>Información del Plan
                    </h5>

                    {{-- Título del Plan --}}
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-person me-1"></i>Título del Plan
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-fonts"></i>
                            </span>
                            <input id="name" type="text" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                placeholder="Por ejemplo: Sesión Virtual Fin de Semana AM" name="name"
                                value="{{ old('name', $product->name) }}" required autofocus>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tipo de Ayuda Legal --}}
                    <div class="mb-4">
                        <label for="category" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-person-gear me-1"></i>Tipo de Ayuda Legal
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-shield-check"></i>
                            </span>
                            <select name="category" id="category" class="form-select border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                                <option value="category_default" selected disabled>
                                    Seleccione una categoría
                                </option>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat }}"
                                        {{ old('category', $product->category) === $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('category')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <label for="description" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-person me-1"></i>Descripción
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-card-text"></i>
                            </span>
                            <textarea id="description" type="text" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                placeholder="Por ejemplo: Estas sesiones se realizarán entre 11:00 y 13:00 horas" name="description" rows="4"
                                required>{{ old('description', $product->description) }}</textarea>
                        </div>
                        @error('description')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Precio --}}
                    <div class="mb-4">
                        <label for="price" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-cash me-1"></i>Precio
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-currency-dollar"></i>
                            </span>
                            <input id="price" type="number" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                placeholder="Por ejemplo: 10000" name="price"
                                value="{{ old('price', number_format($product->price, 0, '', '')) }}" required
                                step="0.01" required>
                        </div>
                        @error('price')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Imagen del Plan --}}
                    <div class="mb-4">
                        <label for="image" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-image me-1"></i>Imagen del Plan
                        </label>
                        @if ($product->image)
                            <div class="mb-2">
                                <img src="{{ asset($product->image) }}" alt="Imagen actual" class="img-fluid rounded"
                                    style="max-height: 150px;">
                            </div>
                        @endif
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-file-earmark-image"></i>
                            </span>
                            <input id="image" type="file" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                name="image" accept="image/*">
                        </div>
                        @error('image')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Botón de Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }}; color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }}; width: 200px;">
                            <i class="bi bi-save me-2"></i>Actualizar Plan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
