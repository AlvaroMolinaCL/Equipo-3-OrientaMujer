<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\TenantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantImageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image_type' => 'required|string',
            'path' => 'required|file|image|max:2048',
        ]);

        $file = $request->file('path');
        $path = $file->store('tenant_images', 'public');

        $image = TenantImage::create([
            'image_type' => $validated['image_type'],
            'path' => $path,
        ]);

        return response()->json($image, 201);
    }
}
