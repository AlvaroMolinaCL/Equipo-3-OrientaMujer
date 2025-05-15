<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenant_1 = Tenant::firstOrCreate(
            ['id' => 'abogado1'],
            [
                'name' => 'Abogado 1',
                'email' => 'abogado1@gmail.com',
                'default_locale' => 'es',
                'logo_path_1' => null,
                'logo_path_2' => null,
                'favicon_path' => null,
                'banner_path' => null,
                'services_path_1' => null,
                'services_path_2' => null,
                'services_path_3' => null,
                'about_path' => null,
                'button_banner_color' => null,
                'button_banner_text_color' => null,
                'navbar_color_1' => null,
                'navbar_color_2' => null,
                'navbar_text_color_1' => null,
                'navbar_text_color_2' => null,
                'background_color_1' => null,
                'background_color_2' => null,
                'text_color_1' => null,
                'text_color_2' => null,
                'button_color_sidebar' => null,
                'color_metrics' => null,
                'color_tables' => null,
                'heading_font' => 'Montserrat',
                'body_font' => 'Arial',
                'navbar_font' => 'Verdana',
                'contact_email' => null,
                'contact_instagram' => null,
                'contact_linkedin' => null,
                'google_analytics_id' => null,
                'data' => null,
            ]
        );

        $tenant_1->domains()->create([
            'domain' => $tenant_1->id . '.' . config('app.domain')
        ]);

        $tenant_2 = Tenant::firstOrCreate(
            ['id' => 'orientamujer'],
            [
                'name' => 'Orienta Mujer',
                'email' => 'orientamujer@gmail.com',
                'default_locale' => 'es',
                'logo_path_1' => '/images/logo/Logo_OrientaMujer_(Letras_Negras).png',
                'logo_path_2' => '/images/logo/Logo_OrientaMujer_(Letras_Blancas).png',
                'favicon_path' => null,
                'banner_path' => '/images/banner/Banner_Principal_OrientaMujer.png',
                'services_path_1' => '/images/services/Servicio_1_OrientaMujer.png',
                'services_path_2' => '/images/services/Servicio_2_OrientaMujer.png',
                'services_path_3' => '/images/services/Servicio_3_OrientaMujer.png',
                'about_path' => '/images/about/Omara_Munoz.png',
                'button_banner_color' => '#222222',
                'button_banner_text_color' => '#ffffff',
                'navbar_color_1' => '#ffffff',
                'navbar_color_2' => '#000000',
                'navbar_text_color_1' => '#000000',
                'navbar_text_color_2' => '#ffffff',
                'background_color_1' => '#ffffff',
                'background_color_2' => '#000000',
                'text_color_1' => '#000000',
                'text_color_2' => '#ffffff',
                'button_color_sidebar' => null,
                'color_metrics' => null,
                'color_tables' => null,
                'heading_font' => 'Courier Prime',
                'body_font' => 'Montserrat',
                'navbar_font' => 'Montserrat',
                'contact_email' => 'omaramunoznavarro@gmail.com',
                'contact_instagram' => 'orientamujer.cl',
                'contact_linkedin' => 'omaramunoznavarro',
                'google_analytics_id' => null,
            ]
        );

        $tenant_2->domains()->create([
            'domain' => $tenant_2->id . '.' . config('app.domain')
        ]);
    }
}
