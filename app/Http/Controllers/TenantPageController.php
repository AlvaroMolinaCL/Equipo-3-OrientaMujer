<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\TenantPage;
use Illuminate\Http\Request;

class TenantPageController extends Controller
{
    public function index()
    {
        return response()->json(TenantPage::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|unique:tenant_pages',
            'title' => 'required|string',
            'is_enabled' => 'required|boolean',
        ]);

        $page = TenantPage::create($validated);
        return response()->json($page, 201);
    }

    public function update(Request $request, TenantPage $tenantPage)
    {
        $tenantPage->update($request->only(['title', 'is_enabled']));
        return response()->json($tenantPage);
    }

    public function destroy(TenantPage $tenantPage)
    {
        $tenantPage->delete();
        return response()->json(null, 204);
    }
}
