<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenantText;

class TenantTextController extends Controller
{
    public function edit()
    {
        $tenantId = tenant()->id;

        $texts = TenantText::where('tenant_id', $tenantId)
            ->pluck('value', 'key')
            ->toArray();

        return view('tenant.texts.edit', compact('texts'));
    }

    public function update(Request $request)
    {
        $tenantId = tenant()->id;

        $keys = ['slogan_text', 'slogan_body', 'about_text']; // Claves que vas a manejar

        foreach ($keys as $key) {
            $value = $request->input($key, '');

            TenantText::updateOrCreate(
                ['tenant_id' => $tenantId, 'key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Textos actualizados correctamente');
    }
}
