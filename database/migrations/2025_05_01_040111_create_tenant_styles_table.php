<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenant_styles', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('page_key'); // Ej: 'index', 'services'

            // Tipografías
            $table->string('heading_font')->nullable();
            $table->string('body_font')->nullable();
            $table->string('link_font')->nullable();

            // Colores
            $table->string('heading_color')->nullable();
            $table->string('link_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('navbar_color')->nullable();
            $table->string('background_color')->nullable();

            $table->timestamps();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_styles');
    }
};
