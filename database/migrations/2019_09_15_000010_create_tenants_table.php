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
            $table->string('id')->primary(); // ID del tenant, usado también por Tenancy
            $table->timestamps();

            // Campos personalizados
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('favicon_path')->nullable();
            $table->string('default_locale', 10)->default('es');

            // Colores generales
            $table->string('navbar_color')->nullable();
            $table->string('background_color')->nullable();

            // Tipografías por defecto
            $table->string('heading_font')->nullable();
            $table->string('body_font')->nullable();
            $table->string('link_font')->nullable();

            $table->json('data')->nullable(); // Puedes seguir usándolo para configuraciones varias
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
