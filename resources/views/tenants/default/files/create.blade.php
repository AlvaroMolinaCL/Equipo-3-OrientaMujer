@php
    $isUser = auth()->user()->hasRole('Usuario');
@endphp

@extends($isUser ? 'tenants.default.layouts.app' : 'tenants.default.layouts.panel')

@section('title', 'Subir Archivo - ' . tenantSetting('name', 'Tenant'))

@if ($isUser)
    @section('navbar')
    @section('navbar-class', 'navbar-light-mode')
        @include('tenants.default.layouts.navigation')
    @endsection
    
    @section('body-class', 'theme-light')
@endif

@section('content')
    <div class="container" style="padding-top: {{ $isUser ? '100px' : '0' }};">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-file-earmark-plus me-2"></i>{{ __('Nuevo Archivo') }}
            </h3>
            @php
                $redirectRoute = auth()->user()->hasRole('Admin') ? route('dashboard') : route('files.index');
            @endphp
            <a href="{{ $redirectRoute }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                       color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                       border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
            <div class="card-body p-4">
                <form id="upload-form" action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="dropzone" class="dropzone text-center p-5 border rounded mb-4"
                        style="border-style: dashed; background-color: #fdf5e5; cursor: pointer;">
                        <p class="text-muted mb-0">
                            <i class="bi bi-cloud-arrow-up fs-1 d-block mb-2 text-secondary"></i>
                            Arrastra un archivo aquí o haz clic para seleccionarlo
                        </p>
                        <p id="file-name" class="fw-bold text-secondary small mt-2"></p>
                        <button type="button" id="remove-file" class="btn btn-sm btn-outline-danger mt-2 d-none">
                            <i class="bi bi-x-circle me-1"></i> Quitar Archivo
                        </button>
                        <input type="file" name="file" class="d-none" id="fileInput" required>
                    </div>

                    <div class="text-center">
                        <button class="btn" type="submit"
                            style="background-color: {{ tenantSetting('button_color_sidebar', '#F5E8D0') }}; 
                                   color: {{ tenantSetting('button_banner_text_color', 'white') }};
                                   transition: all 0.3s ease;">
                            <i class="bi bi-upload me-2"></i>Subir Archivo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('file-name');
        const removeBtn = document.getElementById('remove-file');

        function updateFileDisplay(name) {
            fileNameDisplay.textContent = name;
            removeBtn.classList.remove('d-none');
        }

        function clearFileSelection() {
            fileInput.value = '';
            fileNameDisplay.textContent = '';
            removeBtn.classList.add('d-none');
        }

        dropzone.addEventListener('click', () => fileInput.click());

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-primary');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-primary');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-primary');
            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                updateFileDisplay(e.dataTransfer.files[0].name);
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                updateFileDisplay(fileInput.files[0].name);
            }
        });

        removeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            clearFileSelection();
        });
    </script>
@endpush
