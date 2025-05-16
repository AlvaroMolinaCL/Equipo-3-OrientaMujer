<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class FileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            $files = File::all();
        } else {
            $files = File::where('uploaded_by', $user->id)
                ->orWhereJsonContains('shared_with', (string) $user->id)
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
            $user->hasRole('Admin') ||
            $file->uploaded_by === $user->id ||
            in_array($user->id, $file->shared_with ?? [])
        ) {
            return Storage::download($file->path, $file->name);
        }

        abort(403, 'No tienes permiso para descargar este archivo.');
    }


    public function share(Request $request, File $file)
    {
        $request->validate(['user_ids' => 'nullable|array']);

        $currentlyShared = $file->shared_with ?: [];
        $selectedUserIds = $request->user_ids ?: [];
        $newSharedWith = array_filter($currentlyShared, function ($id) use ($selectedUserIds) {
            return in_array($id, $selectedUserIds);
        });
        foreach ($selectedUserIds as $id) {
            if (!in_array($id, $newSharedWith)) {
                $newSharedWith[] = $id;
            }
        }

        $file->shared_with = array_values($newSharedWith);
        $file->save();
        return back()->with('success', 'Configuración de compartido actualizada correctamente.');
    }

    public function preview(File $file)
    {
        $user = Auth::user();

        if (
            $file->uploaded_by === $user->id ||
            in_array($user->id, $file->shared_with ?? []) ||
            $user->hasRole('Admin')
        ) {
            $mimeType = Storage::mimeType($file->path);
            $contents = Storage::get($file->path);

            return response($contents)->header('Content-Type', $mimeType);
        }

        abort(403, 'No tienes permiso para ver este archivo.');
    }

    public function destroy(File $file)
    {
        $user = auth()->user();

        // Solo el Admin o el propietario del archivo pueden eliminar
        if ($user->hasRole('Admin') || $file->uploaded_by === $user->id) {
            Storage::delete($file->path);
            $file->delete();

            return redirect()->route('files.index')->with('success', 'Archivo eliminado correctamente.');
        }

        abort(403, 'No tienes permiso para eliminar este archivo.');
    }

    public function sharedFolders()
    {
        // Mostrar todos los usuarios "normales" que han subido archivos, sin depender de shared_with
        $users = User::role('Usuario')
            ->whereHas('files') // Solo los que tienen archivos subidos
            ->get();

        return view('tenants.default.shared-folders.index', compact('users'));
    }

    public function sharedByUser(User $user)
    {
        $files = File::where('uploaded_by', $user->id)->get();

        return view('tenants.default.shared-folders.user-files', compact('files', 'user'));
    }




}
