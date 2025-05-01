<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        Tenant::create([
            'id' => 'abogado1',
            'app_name' => 'Estudio Abogado 1',
            'logo_path' => null,
            'favicon_path' => null,
            'default_locale' => 'es',
            'navbar_color' => '#007bff',
            'background_color' => '#ffffff',
            'heading_font' => 'Montserrat',
            'body_font' => 'Arial',
            'link_font' => 'Verdana',
        ]);
    }
}