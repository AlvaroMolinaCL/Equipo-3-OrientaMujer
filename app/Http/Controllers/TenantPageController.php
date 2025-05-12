<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\TenantPage;
use Illuminate\Http\Request;

class TenantPageController extends Controller
{
    public function edit(Tenant $tenant)
    {
        $pageKeys = ['login', 'services', 'contact', 'tips', 'about', 'agenda'];

        $pages = collect($pageKeys)->mapWithKeys(function ($key) use ($tenant) {
            $page = $tenant->pages()->where('page_key', $key)->first();
            return [$key => $page?->title ?? ucfirst($key)];
        });

        $tenantPages = TenantPage::where('tenant_id', $tenant->id)->get()->keyBy('page_key');

        return view('tenants.pages', [
            'tenant' => $tenant,
            'pages' => $pages->toArray(),
            'tenantPages' => $tenantPages,
        ]);
    }

    public function update(Request $request, Tenant $tenant)
    {
        $pageKeys = ['login', 'services', 'contact', 'tips', 'about', 'agenda'];

        $pages = collect($pageKeys)->mapWithKeys(function ($key) use ($tenant) {
            $page = $tenant->pages()->where('page_key', $key)->first();
            return [$key => $page?->title ?? ucfirst($key)];
        });

        $titles = $request->input('titles', []);

        foreach ($pages as $pageKey => $label) {
            TenantPage::updateOrCreate(
                ['tenant_id' => $tenant->id, 'page_key' => $pageKey],
                [
                    'is_enabled' => in_array($pageKey, $request->input('enabled', [])),
                    'is_visible' => in_array($pageKey, $request->input('visible', [])),
                    'title' => $titles[$pageKey] ?? $label,
                ]
            );
        }

        return redirect()->route('tenants.index', $tenant)->with('success', 'Configuración actualizada correctamente.');
    }
}
