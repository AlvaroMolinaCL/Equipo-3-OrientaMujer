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
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('button_banner_text')->nullable();
            $table->string('header_about_section_text')->nullable();
            $table->string('button_about_section_text')->nullable();
            $table->string('header_services_section_text')->nullable();
            $table->string('button_services_section_text')->nullable();
            $table->string('header_about_experience_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('button_banner_text');
            $table->dropColumn('header_about_section_text');
            $table->dropColumn('button_about_section_text');
            $table->dropColumn('header_services_section_text');
            $table->dropColumn('button_services_section_text');
            $table->dropColumn('header_about_experience_text');
        });
    }
};
