<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenantText;
use Illuminate\Support\Facades\Storage;

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
        $tenant = tenant();

        // Validación incluyendo imágenes
        $request->validate([
            'slogan_text' => 'required|string',
            'slogan_body' => 'required|string',
            'about_text' => 'required|string',
            'service1_title' => 'required|string',
            'service1_body' => 'required|string',
            'service2_title' => 'required|string',
            'service2_body' => 'required|string',
            'service3_title' => 'required|string',
            'service3_body' => 'required|string',
            'services_path_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'services_path_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'services_path_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_service_1' => 'required|string',
            'title_service_2' => 'required|string',
            'title_service_3' => 'required|string',
            'body_service_1' => 'required|string',
            'body_service_2' => 'required|string',
            'body_service_3' => 'required|string',

        ]);

        // Guardar textos normales en tenant_texts
        $keys = ['slogan_text', 'slogan_body', 'about_text', 'service1_title', 'service1_body', 'service2_title', 'service2_body', 'service3_title', 'service3_body', 'title_service_1', 'title_service_2', 'title_service_3', 'body_service_1', 'body_service_2', 'body_service_3'];

        foreach ($keys as $key) {
            $value = $request->input($key, '');

            TenantText::updateOrCreate(
                ['tenant_id' => $tenant->id, 'key' => $key],
                ['value' => $value]
            );
        }

        // Manejo de imágenes - guardamos el nombre en la tabla tenants directamente
        for ($i = 1; $i <= 3; $i++) {
            $fileInputName = "services_path_{$i}";

            if ($request->hasFile($fileInputName)) {
                $file = $request->file($fileInputName);

                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('images/services');

                $file->move($destinationPath, $filename);

                // Guardar nombre del archivo en la columna correcta de la tabla tenants
                $columnName = "services_path_{$i}";
                $tenant->$columnName = $filename;
            }
        }

        // Manejo de about_path (imagen sobre nosotros)
        if ($request->hasFile('about_path')) {
            $file = $request->file('about_path');

            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/about');

            // Crear el directorio si no existe
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            // Guardar nombre del archivo en la columna about_path
            $tenant->about_path = $filename;
        }

        if ($request->hasFile('banner_path')) {
            $file = $request->file('banner_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/banner');  // puedes crear esta carpeta
            $file->move($destinationPath, $filename);

            // Guardar en columna banner_path de tenant
            $tenant->banner_path = $filename;
            $tenant->save();
        }


        // Guardar cambios en tenant
        $tenant->save();

        return redirect()->back()->with('success', 'Textos e imágenes actualizados correctamente');
    }
}

