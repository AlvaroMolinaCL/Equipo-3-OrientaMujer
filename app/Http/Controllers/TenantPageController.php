<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\TenantPage;
use Illuminate\Http\Request;

class TenantPageController extends Controller
{
    public function edit(Tenant $tenant)
    {
        $defaultTitles = [
            'login' => 'Iniciar Sesión',
            'register' => 'Registrarse',
            'forgot-password' => 'Restablecer Contraseña',
            'services' => 'Servicios',
            'contact' => 'Contacto',
            'tips' => 'Tips',
            'about' => 'Nosotros',
            'agenda' => 'Agenda',
            'questionnaire' => 'Cuestionario Pre-Agendamiento',
        ];

        $pagesByCategory = [
            'Autenticación' => ['login', 'register', 'forgot-password'],
            'Páginas Básicas' => ['services', 'contact', 'tips', 'about'],
            'Sistema de Agendamiento' => ['agenda', 'questionnaire'],
        ];

        $pages = collect($defaultTitles)->mapWithKeys(function ($defaultTitle, $key) use ($tenant) {
            $page = $tenant->pages()->where('page_key', $key)->first();
            return [$key => $page?->title ?? $defaultTitle];
        });

        $tenantPages = TenantPage::where('tenant_id', $tenant->id)->get()->keyBy('page_key');

        return view('tenants.pages', [
            'tenant' => $tenant,
            'pages' => $pages->toArray(),
            'tenantPages' => $tenantPages,
            'pagesByCategory' => $pagesByCategory,
        ]);
    }

    public function update(Request $request, Tenant $tenant)
    {
        $defaultTitles = [
            'login' => 'Iniciar Sesión',
            'register' => 'Registrarse',
            'forgot-password' => '¿Olvidaste Tu Contraseña?',
            'services' => 'Servicios',
            'contact' => 'Contacto',
            'tips' => 'Tips',
            'about' => 'Nosotros',
            'agenda' => 'Agenda',
            'questionnaire' => 'Cuestionario Pre-Agendamiento',
        ];

        $pages = collect($defaultTitles);
        $titles = $request->input('titles', []);

        $enabled = $request->input('enabled', []);

        if (in_array('questionnaire', $enabled) && !in_array('agenda', $enabled)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'No puedes habilitar el Cuestionario Pre-Agendamiento sin habilitar primero la Agenda.');
        }

        foreach ($pages as $pageKey => $defaultTitle) {
            $isLogin = in_array($pageKey, ['login']);

            TenantPage::updateOrCreate(
                ['tenant_id' => $tenant->id, 'page_key' => $pageKey],
                [
                    'is_enabled' => $isLogin ? true : in_array($pageKey, $request->input('enabled', [])),
                    'is_visible' => in_array($pageKey, $request->input('visible', [])),
                    'title' => $titles[$pageKey] ?? $defaultTitle,
                ]
            );
        }

        return redirect()->route('tenants.index', $tenant)->with('success', 'Configuración actualizada correctamente.');
    }
}
