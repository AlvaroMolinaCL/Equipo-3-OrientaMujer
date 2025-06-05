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
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('second_last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->foreignId('residence_region_id')->nullable()->constrained('regions');
            $table->foreignId('residence_commune_id')->nullable()->constrained('communes');
            $table->foreignId('incident_region_id')->nullable()->constrained('regions');
            $table->foreignId('incident_commune_id')->nullable()->constrained('communes');
            $table->foreignId('questionnaire_response_id')->nullable()->constrained('questionnaire_responses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['residence_region_id']);
            $table->dropForeign(['residence_commune_id']);
            $table->dropForeign(['incident_region_id']);
            $table->dropForeign(['incident_commune_id']);
            $table->dropForeign(['questionnaire_response_id']);
            $table->dropColumn([
                'first_name', 'last_name', 'second_last_name', 'email', 'phone_number',
                'residence_region_id', 'residence_commune_id',
                'incident_region_id', 'incident_commune_id',
                'questionnaire_response_id'
            ]);
        });
    }
};
