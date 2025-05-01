<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TenantPage;

class TenantPageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['slug' => 'index', 'title' => 'Inicio', 'is_enabled' => true],
            ['slug' => 'services', 'title' => 'Servicios', 'is_enabled' => true],
            ['slug' => 'about', 'title' => '¿Quiénes Somos?', 'is_enabled' => true],
            ['slug' => 'login', 'title' => 'Usuari@', 'is_enabled' => true],
            ['slug' => 'tips', 'title' => 'Tips', 'is_enabled' => false],
        ];

        foreach ($pages as $page) {
            TenantPage::create($page);
        }
    }
}

