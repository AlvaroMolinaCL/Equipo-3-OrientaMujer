<?php

namespace App\Http\Controllers;

use App\Models\SuperAdminRequest;
use Illuminate\Http\Request;

class PublicSuperAdminRequestController extends Controller
{
    public function form()
    {
        return view('solicitar-superadmin');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:super_admin_requests,email|unique:users,email',
            'reason' => 'nullable|string|max:1000',
        ]);

        SuperAdminRequest::create($request->only('name', 'email', 'reason'));

        return redirect()->back()->with('success', 'Tu solicitud fue enviada. Un administrador la revisará.');
    }
}
