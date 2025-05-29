<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('questionnaire_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->string('q1');
            $table->string('q2');
            $table->string('q3');
            $table->string('q4')->nullable();
            $table->string('q5')->nullable();
            $table->string('q6')->nullable();
            $table->string('q7')->nullable();
            $table->string('q7_detail')->nullable();
            $table->string('q8')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questionnaire_responses');
    }
}
