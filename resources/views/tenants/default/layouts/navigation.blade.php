@php
    $enabledPages = \App\Models\TenantPage::where('tenant_id', tenant()->id)->where('is_enabled', true)->get();
    $cartCount = Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->where('status', 'active')->first()?->items->count() ?? 0 : 0;
@endphp

<nav class="navbar navbar-expand-lg fixed-top @yield('navbar-class', 'navbar-dark-mode')">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand ms-auto" href="/">
            <img src="{{ tenantSetting('logo_path_1', 'images/logo/Logo_1_(Predeterminado).png') }}"
                class="logo logo-1 d-none" alt="Logo 1 {{ tenantSetting('name', 'Tenant') }}" width="300" height="50">
            <img src="{{ tenantSetting('logo_path_2', 'images/logo/Logo_2_(Predeterminado).png') }}"
                class="logo logo-2 d-none" alt="Logo 2 {{ tenantSetting('name', 'Tenant') }}" width="300" height="50">
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>

                @foreach ($enabledPages as $page)
                    @if ($page->is_visible)
                        {{-- No mostrar login ni register si el usuario está logueado --}}
                        @if (in_array($page->page_key, ['login', 'register']) && Auth::check())
                            @continue
                        @endif

                        {{-- Redirección especial para la agenda --}}
                        @if ($page->page_key === 'agenda')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tenant.agenda.questionnaire') }}">
                                    {{ $page->title ?? 'Agenda' }}
                                </a>
                            </li>
                            @continue
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url($page->page_key) }}">
                                {{ $page->title ?? ucfirst($page->page_key) }}
                            </a>
                        </li>
                    @endif
                @endforeach

                @auth
                    {{-- Ícono del carrito --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            Carrito
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                    <span class="visually-hidden">productos en el carrito</span>
                                </span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->hasRole('Admin'))
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Panel de administración</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mi perfil</a></li>
                            @if(Auth::user()->hasRole('Usuario'))
                                <li><a class="dropdown-item" href="{{ route('files.index') }}">Mis archivos</a></li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@push('styles')
<style>
    .navbar .badge {
        font-size: 0.6rem;
        padding: 0.25em 0.4em;
    }
    .fa-shopping-cart {
        font-size: 1.2rem;
    }
</style>
@endpush