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
        Schema::create('tenant_pages', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('page_key');
            $table->string('title');
            $table->boolean('is_enabled')->default(true);
            $table->boolean('is_visible')->default(true);
            $table->json('settings')->nullable();
            $table->timestamps();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->unique(['tenant_id', 'page_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_pages');
    }
};
