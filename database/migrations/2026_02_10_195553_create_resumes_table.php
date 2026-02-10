<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chat_id');
            $table->string('name');
            $table->integer('age');
            $table->string('phone', 50);
            $table->string('photo_filename')->nullable();
            $table->foreignId('region_id')
                ->constrained('regions')
                ->onDelete('cascade');
            $table->foreignId('city_id')
                ->constrained('cities')
                ->onDelete('cascade');
            $table->foreignId('job_id')
                ->constrained('jobs')
                ->onDelete('cascade');
            $table->string('language', 10);
            $table->timestamps();

            // Индексы для оптимизации запросов
            $table->index('chat_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};