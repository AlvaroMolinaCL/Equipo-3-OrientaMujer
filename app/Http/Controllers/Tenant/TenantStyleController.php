<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\TenantStyle;
use Illuminate\Http\Request;

class TenantStyleController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'navbar_color' => 'nullable|string',
            'background_color' => 'nullable|string',
            'heading_font' => 'nullable|string',
            'body_font' => 'nullable|string',
            'link_font' => 'nullable|string',
        ]);

        $tenant = tenant();

        $tenant->update($validated);

        return response()->json($tenant);
    }
}
