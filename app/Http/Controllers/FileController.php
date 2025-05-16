<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Admin ve todos los archivos de su tenantP
        if ($user->hasRole('Admin')) {
            $files = File::all();
        } else {
            // Usuarios ven archivos propios o compartidos con ellos
            $files = File::where('uploaded_by', $user->id)
                ->orWhereJsonContains('shared_with', $user->id)
                ->get();
        }
        return view('tenants.default.file-index', compact('files'));
    }

    public function create()
    {
        return view('tenants.default.file-create');
    }

    public function store(Request $request)
    {
        $request->validate(['file' => 'required|file']);
        $user = Auth::user();
        $path = $request->file('file')->store("tenants/{$user->tenant_id}/uploads");

        File::create([
            'name' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
            'uploaded_by' => $user->id,
        ]);

        return redirect()->route('files.index')->with('success', 'Archivo subido con éxito.');
    }

    public function download(File $file)
    {
        $user = Auth::user();
        if (
            $file->uploaded_by === $user->id ||
            in_array($user->id, $file->shared_with ?? [])
        ) {
            return Storage::download($file->path, $file->name);
        }

        abort(403, 'No tienes permiso para descargar este archivo.');
    }

    public function share(Request $request, File $file)
    {
        $request->validate(['user_ids' => 'array']);
        $file->shared_with = $request->user_ids;
        $file->save();

        return back()->with('success', 'Archivo compartido correctamente.');
    }
}
