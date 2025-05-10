<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::where('domain', 'NOT LIKE', '%.' . config('app.domain'))->get();
        return view('domains.index', ['domains' => $domains]);
    }

    public function create()
    {
        $tenants = Tenant::get();
        return view('domains.create', ['tenants' => $tenants]);
    }

    public function store(Request $request)
    {
        $validationData = $request->validate([
            'domain' => 'required|string|max:255|unique:domains,domain',
            'tenant' => 'required|string|max:255',
        ]);

        Domain::create([
            'domain' => $validationData['domain'],
            'tenant_id' => $request->input('tenant'),
        ]);

        return redirect()->route('domains.index');
    }

    public function destroy(Domain $domain)
    {
        $domain->delete();

        return redirect()->route('domains.index')->with('success', 'Dominio eliminado con éxito');
    }

    public function edit(Domain $domain)
    {
        $tenants = Tenant::get();
        return view('domains.edit', compact('domain'), ['tenants' => $tenants]);
    }

    public function update(Request $request, Domain $domain)
    {
        $validationData = $request->validate([
            'domain' => 'required|string|max:255',
            'tenant' => 'required|string|max:255',
        ]);

        $domain->update([
            'domain' => $validationData['domain'],
            'tenant_id' => $request->input('tenant'),
        ]);

        return redirect()->route('domains.index');
    }
}
