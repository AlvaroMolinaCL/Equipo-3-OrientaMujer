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
    return tenant()?->{$key} ?? $default;
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

/**
 * Recupera el texto de un tenant desde la base de datos
 */
function tenantText($key, $default = '')
{
    $tenantId = tenant()->id;

    $text = \App\Models\TenantText::where('tenant_id', $tenantId)
        ->where('key', $key)
        ->value('value');

    return $text ?: $default;
}

