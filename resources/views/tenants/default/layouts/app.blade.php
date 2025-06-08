<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous" rel="stylesheet">
    <link href="{{ asset(tenantSetting('favicon_path', '/favicon.ico')) }}" type="image/ico" rel="shortcut icon">
    <link href="{{ asset(tenantSetting('favicon_path', '/favicon.ico')) }}" sizes="192x192" rel="shortcut icon">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $tenant = tenant();
        $bannerUrl = tenantSetting('banner_path')
            ? asset('images/banner/' . tenantSetting('banner_path'))
            : asset('images/banner/Banner_1_(Predeterminado).png');
    @endphp

    @if ($tenant->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tenant->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', '{{ $tenant->google_analytics_id }}');
        </script>
    @endif

    @if ($tenant)
        <style>
            /* Tipo de letra para la página en general */
            body {
                font-family:
                    {{ tenantSetting('body_font', 'Open Sans') }}
                    , sans-serif;
                /* Usar sans-serif como fallback */
                margin: 0;
                padding: 0;
            }

            /* Navbar */
            .navbar-light-mode {
                background-color:
                    {{ tenantSetting('navbar_color_1', '#ffffff') }}
                    !important;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            }

            .navbar-dark-mode {
                background-color:
                    {{ tenantSetting('navbar_color_2', '#000000') }}
                    !important;
                box-shadow: 0 2px 4px rgba(35, 35, 35);
            }

            .navbar-light-mode .nav-link {
                color:
                    {{ tenantSetting('navbar_text_color_1', '#000000') }}
                    !important;
            }

            .navbar-dark-mode .nav-link {
                color:
                    {{ tenantSetting('navbar_text_color_2', '#ffffff') }}
                    !important;
            }

            /* Fondo de la página en general */
            .theme-light {
                background-color:
                    {{ tenantSetting('background_color_1', '#ffffff') }}
                    !important;
                color:
                    {{ tenantSetting('text_color_1', '#000000') }}
                ;
            }

            .theme-dark {
                background-color:
                    {{ tenantSetting('background_color_2', '#000000') }}
                    !important;
                color:
                    {{ tenantSetting('text_color_2', '#ffffff') }}
                ;
            }

            /* Imagen de banner de la página de Inicio */
            .hero-section {
                background: url("{{ $bannerUrl }}") no-repeat center center;
                background-size: cover;
                height: 100vh;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 3rem 2rem;
                color: black;
                overflow: hidden;
            }

            /* Color de fondo y de texto del botón de la página de Inicio */
            .btn-consulta {
                background-color:
                    {{ tenantSetting('button_banner_color', '#222222') }}
                ;
                color:
                    {{ tenantSetting('button_banner_text_color', '#ffffff') }}
                ;
                padding: 0.75rem 2rem;
                border: none;
                font-weight: bold;
                border-radius: 30px;
                margin-bottom: 1rem;
            }

            /* Estilos del Chatbot */
            #chat-bubble {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color:
                    {{ tenantSetting('navbar_color_1', '#8C2D18') }}
                ;
                color:
                    {{ tenantSetting('navbar_text_color_1', '#ffffff') }}
                ;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                text-align: center;
                font-size: 30px;
                line-height: 60px;
                cursor: pointer;
                z-index: 9999;
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
                transition: transform 0.3s ease-in-out;
            }

            #chat-bubble:hover {
                transform: scale(1.08);
            }

            #chat-window {
                position: fixed;
                bottom: 90px;
                right: 20px;
                width: 320px;
                max-height: 400px;
                background:
                    {{ tenantSetting('background_color_1', '#ffffff') }}
                ;
                border: 1px solid
                    {{ tenantSetting('text_color_1', '#dddddd') }}
                ;
                border-radius: 16px;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
                display: none;
                flex-direction: column;
                z-index: 9998;
                overflow: hidden;
            }

            #chat-header {
                background:
                    {{ tenantSetting('navbar_color_2', '#8C2D18') }}
                ;
                color:
                    {{ tenantSetting('navbar_text_color_2', '#ffffff') }}
                ;
                padding: 15px 20px;
                border-top-left-radius: 12px;
                border-top-right-radius: 12px;
                font-weight: bold;
                font-size: 1.1em;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            #chat-input {
                display: flex;
                border-top: 1px solid
                    {{ tenantSetting('text_color_1', '#dddddd') }}
                ;
            }

            #chat-input input {
                flex: 1;
                border: none;
                padding: 12px 15px;
                border-radius: 0 0 0 16px;
                outline: none;
                color: black;
                background-color:
                    {{ tenantSetting('background_color_1', '#ffffff') }}
                ;
            }

            #chat-input button {
                background:
                    {{ tenantSetting('navbar_color_2', '#222222') }}
                ;
                color:
                    {{ tenantSetting('button_banner_text_color', '#ffffff') }}
                ;
                border: none;
                padding: 12px 20px;
                border-radius: 0 0 16px 0;
                cursor: pointer;
                transition: background-color 0.2s ease;
            }

            #chat-input button:hover {
                background: rgb(71, 71, 71);
            }


            #chat-body {
                height: 400px;
                overflow-y: auto;
                border: none;
                padding: 15px;
                background: lighten({{ tenantSetting('background_color_1', '#f7f7f7') }}, 3%);
                display: flex;
                flex-direction: column;
                color: #000000;
            }

            .user-message {
                text-align: right;
                margin: 8px 0;
                padding: 10px 15px;
                background:
                    {{ tenantSetting('navbar_color_1', '#A84D3A') }}
                ;
                color:
                    {{ tenantSetting('navbar_text_color_1', '#ffffff') }}
                ;
                border-radius: 18px 18px 2px 18px;
                max-width: 80%;
                align-self: flex-end;
                word-wrap: break-word;
            }

            .bot-message {
                text-align: left;
                margin: 8px 0;
                padding: 10px 15px;
                background: white;
                border-radius: 18px 18px 18px 2px;
                border: 1px solid
                    {{ tenantSetting('text_color_1', '#eee') }}
                ;
                max-width: 80%;
                align-self: flex-start;
                word-wrap: break-word;
            }

            .bot-message.error {
                color: #d32f2f;
                font-weight: bold;
            }

            /* Animación para el indicador de escritura */
            .typing-indicator {
                display: flex;
                align-items: center;
            }

            .typing-indicator span {
                display: inline-block;
                width: 8px;
                height: 8px;
                margin: 0 2px;
                background-color:
                    {{ tenantSetting('navbar_color_1', '#8C2D18') }}
                ;
                border-radius: 50%;
                opacity: 0.7;
                animation: typing 1s infinite ease-in-out;
            }

            .typing-indicator span:nth-child(2) {
                animation-delay: 0.2s;
            }

            .typing-indicator span:nth-child(3) {
                animation-delay: 0.4s;
            }

            @keyframes typing {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-4px);
                }
            }

            /* Media queries para responsividad */
            @media (max-width: 768px) {
                #chat-bubble {
                    bottom: 15px;
                    right: 15px;
                    width: 55px;
                    height: 55px;
                    font-size: 26px;
                    line-height: 55px;
                }

                #chat-window {
                    width: 90vw;
                    max-width: 350px;
                    bottom: 80px;
                    right: 15px;
                    max-height: 70vh;
                }

                #chat-body {
                    height: calc(70vh - 120px);
                    padding: 10px;
                }

                #chat-input input,
                #chat-input button {
                    padding: 10px 12px;
                }
            }
        </style>
    @endif
</head>

<body class="@yield('body-class', 'theme-light')">
    <div class="d-flex min-h-screen">

        <div class="flex-grow-1">
            @hasSection('navbar')
                @yield('navbar')
            @endif

            <main>
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
    @stack('styles')

    <div id="chat-bubble" onclick="toggleChat()">💬</div>

    <div id="chat-window">
        <div id="chat-header">Asistente Legal</div>
        <div id="chat-body">
            <p class="bot-message"><strong>Bot:</strong> ¡Hola! ¿En qué puedo ayudarte?</p>
        </div>
        <div id="chat-input">
            <input type="text" id="userInput" placeholder="Escribe tu pregunta..." />
            <button onclick="sendChat()">Enviar</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        function toggleChat() {
            const chatWindow = document.getElementById('chat-window');
            chatWindow.style.display = (chatWindow.style.display === 'none' || chatWindow.style.display === '') ? 'flex' : 'none';
            if (chatWindow.style.display === 'flex') {
                document.getElementById('userInput').focus();
                const chatBody = document.getElementById('chat-body');
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        }

        function sendChat() {
            const input = document.getElementById('userInput');
            const message = input.value.trim();
            if (!message) return;

            const chatBody = document.getElementById('chat-body');
            const sendButton = document.querySelector('#chat-input button');

            input.disabled = true;
            sendButton.disabled = true;

            chatBody.innerHTML += `<div class="user-message"><strong>Tú:</strong> ${message}</div>`;
            input.value = '';

            const loadingId = 'loading-' + Date.now();
            chatBody.innerHTML += `<div id="${loadingId}" class="bot-message typing-indicator">
                                        <strong>Bot:</strong> <span></span><span></span><span></span>
                                    </div>`;
            chatBody.scrollTop = chatBody.scrollHeight;

            fetch('/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message
                })
            })
                .then(res => {
                    if (!res.ok) throw new Error(res.statusText);
                    return res.json();
                })
                .then(data => {
                    const loadingElement = document.getElementById(loadingId);
                    if (loadingElement) {
                        loadingElement.outerHTML = `<div class="bot-message">${marked.parse("<strong>Bot:</strong> " + data.message)}</div>`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching chatbot response:', error);
                    const loadingElement = document.getElementById(loadingId);
                    if (loadingElement) {
                        loadingElement.outerHTML =
                            `<div class="bot-message error"><strong>Bot:</strong> Lo siento, hubo un error al procesar tu mensaje. Por favor, inténtalo de nuevo más tarde.</div>`;
                    }
                })
                .finally(() => {
                    input.disabled = false;
                    sendButton.disabled = false;
                    input.focus();
                    chatBody.scrollTop = chatBody.scrollHeight;
                });
        }

        document.getElementById('userInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter' && !this.disabled) {
                sendChat();
            }
        });
    </script>

</body>

</html>