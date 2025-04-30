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
