<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppearanceController extends Controller
{

    public function index()
    {
        $tenant = tenant();
        return view('tenants.default.appearance', compact('tenant'));
    }



    public function edit()
    {
        $tenant = tenant();

        return view('tenants.default.appearance.index', compact('tenant'));
    }

    public function update(Request $request)
    {
        $tenant = tenant();

        $request->validate([
            'background_color_1' => 'nullable|string|max:7',
            'text_color_1' => 'nullable|string|max:7',
            'background_color_2' => 'nullable|string|max:7',
            'text_color_2' => 'nullable|string|max:7',
            'navbar_color_1' => 'nullable|string|max:7',
            'navbar_text_color_1' => 'nullable|string|max:7',
            'navbar_color_2' => 'nullable|string|max:7',
            'navbar_text_color_2' => 'nullable|string|max:7',
            'navbar_font' => 'nullable|string|max:255',
            'heading_font' => 'nullable|string|max:255',
            'body_font' => 'nullable|string|max:255',
            'button_color_sidebar' => 'nullable|string|max:7',
            'color_metrics' => 'nullable|string|max:7',
            'color_tables' => 'nullable|string|max:7',
        ]);

        $tenant->update($request->only([
            'background_color_1',
            'text_color_1',
            'background_color_2',
            'text_color_2',
            'navbar_color_1',
            'navbar_text_color_1',
            'navbar_color_2',
            'navbar_text_color_2',
            'navbar_font',
            'heading_font',
            'body_font',
            'button_color_sidebar',
            'color_metrics',
            'color_tables',
        ]));

        return response()->json(['success' => true]);
    }
}