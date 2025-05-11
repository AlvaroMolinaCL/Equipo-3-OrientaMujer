<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\TenantPage;
use Illuminate\Http\Request;

class TenantPageController extends Controller
{
    public function edit(Tenant $tenant)
    {
        $pages = config('tenant.pages');
        $tenantPages = TenantPage::where('tenant_id', $tenant->id)->get()->keyBy('page_key');

        return view('tenants.pages', compact('tenant', 'pages', 'tenantPages'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $pages = config('tenant.pages');

        foreach ($pages as $pageKey => $label) {
            TenantPage::updateOrCreate(
                ['tenant_id' => $tenant->id, 'page_key' => $pageKey],
                [
                    'is_enabled' => in_array($pageKey, $request->input('enabled', [])),
                    'is_visible' => in_array($pageKey, $request->input('visible', [])),
                ]
            );
        }

        return redirect()->route('tenants.pages.edit', $tenant)->with('success', 'Configuración actualizada correctamente.');
    }
}
