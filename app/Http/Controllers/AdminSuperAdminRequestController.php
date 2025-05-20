<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdminRequest;
use App\Models\SuperAdminInvitation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuperAdminInvitationMail;


class AdminSuperAdminRequestController extends Controller
{
    public function index()
    {
        $solicitudes = SuperAdminRequest::where('approved', false)->get();
        return view('admin.solicitudes-superadmin', compact('solicitudes'));
    }

    public function approve($id)
    {
        $solicitud = SuperAdminRequest::findOrFail($id);

        $solicitud->update(['approved' => true]);

        return back()->with('success', 'Solicitud aprobada sin enviar email.');
    }

}

