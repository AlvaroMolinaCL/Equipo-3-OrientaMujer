<?php

use Illuminate\Support\Facades\View;

/**
 * Devuelve el nombre de la vista del tenant actual si existe, o una vista por defecto.
 */
function tenantView(string $view): string
{
    $tenantId = tenant()?->id;

    if ($tenantId && View::exists("tenants.$tenantId.$view")) {
        return "tenants.$tenantId.$view";
    }

    return "tenants.default.$view";
}

/**
 * Recupera configuraciones de un tenant desde la base de datos
 */
function tenantSetting($key, $default = null)
{
    $tenant = tenant(); // o como sea que accedas

    return data_get($tenant->data ?? [], $key, $default);
}

/**
 * Recupera el nombre de la página de un tenant desde la base de datos
 */
function tenantPageName(string $pageKey, string $fallback = '')
    {
        return \App\Models\TenantPage::on('central')
            ->where('tenant_id', tenant()?->id)
            ->where('page_key', $pageKey)
            ->value('title') ?? $fallback;
    }