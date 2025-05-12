@php
    $enabledPages = \App\Models\TenantPage::where('tenant_id', tenant()->id)->where('is_enabled', true)->get();
@endphp

<nav class="navbar navbar-expand-lg fixed-top @yield('navbar-class', 'navbar-dark-mode')">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand ms-auto" href="/">
            <img src="{{ tenantSetting('logo_path_1', 'images/logo/Logo_1_(Predeterminado).png') }}" class="logo logo-1 d-none"
                alt="Logo 1 {{ tenantSetting('name', 'Tenant') }}" width="300" height="50">
            <img src="{{ tenantSetting('logo_path_2', 'images/logo/Logo_2_(Predeterminado).png') }}" class="logo logo-2 d-none"
                alt="Logo 2 {{ tenantSetting('name', 'Tenant') }}" width="300" height="50">
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                @foreach ($enabledPages as $page)
                    @if ($page->is_visible)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url($page->page_key) }}">
                                {{ $page->title ?? ucfirst($page->page_key) }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>
