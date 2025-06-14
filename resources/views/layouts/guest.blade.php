<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous" rel="stylesheet">

    <!-- Styles and Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #6B3A2C;
            /* Color principal (marrón) */
            --primary-light: #F1E8E5;
            /* Versión clara para fondos */
            --primary-dark: #5A3024;
            /* Versión oscura para hover */
            --text-dark: #333333;
            /* Texto principal */
            --text-light: #6C757D;
            /* Texto secundario */
            --bg-light: #F9F5F3;
            /* Fondo de sección */
            --white: #FFFFFF;
            /* Blanco puro */
        }

        /* Estructura principal */
        .features-carousel {
            padding: 80px 0;
            background-color: var(--bg-light);
            position: relative;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Encabezado */
        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title {
            color: var(--primary-color);
            font-size: 2.2rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .section-subtitle {
            color: var(--text-light);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Contenedor del carrusel */
        .carousel-container {
            position: relative;
            padding: 0 60px;
        }

        /* Track (contiene las cards) */
        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
            gap: 25px;
            padding: 10px 0;
        }

        /* Cards individuales */
        .feature-card {
            flex: 0 0 calc(33.333% - 17px);
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(107, 58, 44, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border-top: 4px solid var(--primary-color);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(107, 58, 44, 0.15);
        }

        /* Encabezado de card */
        .feature-card-header {
            padding: 22px;
            background-color: var(--primary-light);
            border-bottom: 1px solid rgba(107, 58, 44, 0.08);
        }

        .feature-card-title {
            margin: 0;
            color: var(--primary-color);
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Cuerpo de card */
        .feature-card-body {
            padding: 22px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            padding: 10px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-dark);
            border-bottom: 1px solid rgba(107, 58, 44, 0.05);
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-list i {
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        /* Botones de navegación */
        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            background: var(--primary-color);
            border: none;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(107, 58, 44, 0.2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .carousel-nav.prev {
            left: 0;
        }

        .carousel-nav.next {
            right: 0;
        }

        .carousel-nav i {
            font-size: 1.4rem;
            color: var(--white);
        }

        .carousel-nav:hover:not(:disabled) {
            background: var(--primary-dark);
            transform: translateY(-50%) scale(1.05);
        }

        .carousel-nav:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* Indicadores */
        .carousel-indicators {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            gap: 12px;
        }

        .carousel-indicators .indicator {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: rgba(107, 58, 44, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-indicators .indicator.active {
            background: var(--primary-color);
            transform: scale(1.2);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .feature-card {
                flex: 0 0 calc(50% - 13px);
            }

            .section-title {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 768px) {
            .features-carousel {
                padding: 60px 0;
            }

            .carousel-container {
                padding: 0 40px;
            }

            .feature-card {
                flex: 0 0 100%;
            }

            .carousel-nav {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 576px) {
            .carousel-container {
                padding: 0 30px;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .section-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body class="@yield('body-class', 'theme-light')">
    <div class="min-h-screen">

        {{-- Aquí insertamos la navbar si la vista desea incluirla --}}
        @hasSection('navbar')
            @yield('navbar')
        @endif

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const track = document.getElementById('carouselTrack');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const indicatorsContainer = document.getElementById('indicators');

            const cards = document.querySelectorAll('.feature-card');
            const cardCount = cards.length;
            const cardsPerView = 3;
            const groupCount = Math.ceil(cardCount / cardsPerView);

            let currentGroup = 0;

            // Crear indicadores
            for (let i = 0; i < groupCount; i++) {
                const indicator = document.createElement('div');
                indicator.classList.add('indicator');
                if (i === 0) indicator.classList.add('active');
                indicator.addEventListener('click', () => goToGroup(i));
                indicatorsContainer.appendChild(indicator);
            }

            // Actualizar carrusel
            function updateCarousel() {
                const cardWidth = cards[0].offsetWidth + 20; // Incluye el gap
                const offset = -currentGroup * cardsPerView * cardWidth;
                track.style.transform = `translateX(${offset}px)`;

                // Actualizar indicadores
                document.querySelectorAll('.indicator').forEach((ind, index) => {
                    ind.classList.toggle('active', index === currentGroup);
                });

                // Manejar estado de los botones
                prevBtn.disabled = currentGroup === 0;
                nextBtn.disabled = currentGroup === groupCount - 1;
            }

            function goToGroup(groupIndex) {
                currentGroup = groupIndex;
                updateCarousel();
            }

            // Event listeners para botones
            prevBtn.addEventListener('click', () => {
                if (currentGroup > 0) {
                    currentGroup--;
                    updateCarousel();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentGroup < groupCount - 1) {
                    currentGroup++;
                    updateCarousel();
                }
            });

            // Manejar redimensionamiento
            window.addEventListener('resize', updateCarousel);

            // Inicializar
            updateCarousel();
        });
    </script>
</body>

</html>