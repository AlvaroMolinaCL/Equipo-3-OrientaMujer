@extends('tenants.default.layouts.panel')

@section('title', 'Dashboard')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    @php
        $presetStyles = [
            'clásico' => [
                'label' => 'Clásico',
                'background_color_1' => '#f8f9fa',
                'background_color_2' => '#e9ecef',
                'text_color_1' => '#212529',
                'text_color_2' => '#495057',
                'navbar_color_1' => '#343a40',
                'navbar_color_2' => '#343a40',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#6c757d',
                'color_metrics' => '#495057',
                'color_tables' => '#343a40',
            ],
            'notarial' => [
                'label' => 'Notarial',
                'background_color_1' => '#fefcf9',
                'background_color_2' => '#f5f2ec',
                'text_color_1' => '#3e3e3e',
                'text_color_2' => '#5c5c5c',
                'navbar_color_1' => '#8c2d18',
                'navbar_color_2' => '#8c2d18',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#BF8A49',
                'color_metrics' => '#8C2D18',
                'color_tables' => '#5f1e10',
            ],
            'corporativo' => [
                'label' => 'Corporativo',
                'background_color_1' => '#edf2f7',
                'background_color_2' => '#e2e8f0',
                'text_color_1' => '#1a202c',
                'text_color_2' => '#2d3748',
                'navbar_color_1' => '#2c5282',
                'navbar_color_2' => '#2c5282',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#2b6cb0',
                'color_metrics' => '#2c5282',
                'color_tables' => '#1a365d',
            ],
            'jurídico azul' => [
                'label' => 'Jurídico Azul',
                'background_color_1' => '#f1f5f9',
                'background_color_2' => '#dbeafe',
                'text_color_1' => '#1e3a8a',
                'text_color_2' => '#1e40af',
                'navbar_color_1' => '#1e3a8a',
                'navbar_color_2' => '#1e3a8a',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#1e40af',
                'color_metrics' => '#1e3a8a',
                'color_tables' => '#1c2f75',
            ],
            'moderno' => [
                'label' => 'Moderno',
                'background_color_1' => '#ffffff',
                'background_color_2' => '#f0f0f0',
                'text_color_1' => '#111827',
                'text_color_2' => '#374151',
                'navbar_color_1' => '#111827',
                'navbar_color_2' => '#111827',
                'navbar_text_color_1' => '#f3f4f6',
                'navbar_text_color_2' => '#f3f4f6',
                'button_color_sidebar' => '#374151',
                'color_metrics' => '#1f2937',
                'color_tables' => '#111827',
            ],
            'elegante' => [
                'label' => 'Elegante',
                'background_color_1' => '#f6f5f3',
                'background_color_2' => '#e0dad1',
                'text_color_1' => '#2b2b2b',
                'text_color_2' => '#4b4b4b',
                'navbar_color_1' => '#5c4033',
                'navbar_color_2' => '#5c4033',
                'navbar_text_color_1' => '#ffffff',
                'navbar_text_color_2' => '#ffffff',
                'button_color_sidebar' => '#5c4033',
                'color_metrics' => '#3e2c22',
                'color_tables' => '#2b1d17',
            ],
        ];
    @endphp

    <div class="container mb-4">
        <h1>Paletas de colores</h1>

        <div class="d-flex flex-wrap gap-3 mb-4" id="palettes-container">
            @foreach($presetStyles as $key => $palette)
                <div class="palette-card border rounded p-2" style="cursor:pointer; width: 200px;" data-key="{{ $key }}"
                    data-palette='@json($palette)' title="Seleccionar paleta {{ $palette['label'] }}">
                    <strong>{{ $palette['label'] }}</strong>
                    <div class="d-flex flex-wrap mt-2 gap-1">
                        @foreach($palette as $prop => $color)
                            @if(str_contains($prop, 'color'))
                                <div style="width: 30px; height: 30px; background-color: {{ $color }}; border: 1px solid #ccc; border-radius: 4px;"
                                    title="{{ $prop }}: {{ $color }}"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <button id="savePaletteBtn" class="btn" style="background-color: {{ tenantSetting('button_color_sidebar', '#F5E8D0') }}; color: {{ tenantSetting('button_banner_text_color', 'white') }};">Guardar paleta</button>
    </div>

    <script>
        const palettesContainer = document.getElementById('palettes-container');
        const saveBtn = document.getElementById('savePaletteBtn');
        let selectedPaletteKey = null;
        let selectedPaletteData = null;

        function clearSelection() {
            document.querySelectorAll('.palette-card').forEach(card => {
                card.style.borderColor = '#ccc';
                card.style.boxShadow = 'none';
            });
        }

        palettesContainer.addEventListener('click', (e) => {
            let card = e.target;

            while (card && !card.classList.contains('palette-card')) {
                card = card.parentElement;
            }

            if (!card) return;

            clearSelection();
            card.style.borderColor = '#007bff';
            card.style.boxShadow = '0 0 10px #007bff';

            selectedPaletteKey = card.getAttribute('data-key');
            try {
                selectedPaletteData = JSON.parse(card.getAttribute('data-palette'));
                console.log('Paleta seleccionada correctamente:', selectedPaletteKey, selectedPaletteData);
            } catch (error) {
                console.error('Error al parsear JSON de la paleta', error);
                alert('Error al seleccionar la paleta. Intenta nuevamente.');
            }
        });


        function applyPalette(palette) {
            const sidebar = document.querySelector('.sidebar, #sidebar, nav.navbar, .navbar');
            if (sidebar) {
                sidebar.style.backgroundColor = palette.navbar_color_1;
                sidebar.style.color = palette.navbar_text_color_1;
            }

            document.body.style.color = palette.text_color_1;

            document.querySelectorAll('.btn-primary, .active').forEach(el => {
                el.style.backgroundColor = palette.button_color_sidebar;
                el.style.borderColor = palette.button_color_sidebar;
            });

            document.body.style.backgroundColor = palette.background_color_1;

        }

        saveBtn.addEventListener('click', () => {
            if (!selectedPaletteData) {
                alert('Por favor selecciona una paleta primero');
                return;
            }


            const paletteToSend = { ...selectedPaletteData };
            delete paletteToSend.label;

            fetch("{{ route('appearance.update') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(paletteToSend)
            })

                .then(response => response.json())
                .then(data => {
                    if (data.success || data.status === "success") {
                        applyPalette(selectedPaletteData);
                        alert('Paleta aplicada y guardada con éxito');
                        location.reload();
                    } else {
                        alert('Error al guardar la paleta');
                    }
                })
                .catch(() => alert('Error al guardar la paleta'));
        });

    </script>
@endsection