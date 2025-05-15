<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->timestamps();

            // Campos personalizados
            $table->string('name')->nullable();
            $table->string('default_locale', 10)->default('es');
            $table->string('logo_path_1')->nullable();
            $table->string('logo_path_2')->nullable();
            $table->string('favicon_path')->nullable();
            $table->string('banner_path')->nullable();
            $table->string('services_path_1')->nullable();
            $table->string('services_path_2')->nullable();
            $table->string('services_path_3')->nullable();
            $table->string('about_path')->nullable();

            // Colores generales
            $table->string('button_banner_color')->nullable();
            $table->string('button_banner_text_color')->nullable();
            $table->string('navbar_color_1')->nullable();
            $table->string('navbar_color_2')->nullable();
            $table->string('navbar_text_color_1')->nullable();
            $table->string('navbar_text_color_2')->nullable();
            $table->string('background_color_1')->nullable();
            $table->string('background_color_2')->nullable();
            $table->string('text_color_1')->nullable();
            $table->string('text_color_2')->nullable();
            $table->string('button_color_sidebar')->nullable();
            $table->string('color_metrics')->nullable();
            $table->string('color_tables')->nullable();

            // Tipografías por defecto
            $table->string('heading_font')->nullable();
            $table->string('body_font')->nullable();
            $table->string('navbar_font')->nullable();

            // Configuraciones específicas
            $table->string('contact_email')->nullable();
            $table->string('contact_instagram')->nullable();
            $table->string('contact_linkedin')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
