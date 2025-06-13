<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('schedule_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable(); // Ej: "Semana 1 julio"
            $table->integer('days'); // Cantidad de días programados
            $table->timestamp('used_at')->nullable(); // Fecha en que se aplicó la carga
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_batches');
    }
};