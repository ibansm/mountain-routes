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
        Schema::create('video_incidencia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incidencia_id');
            $table->string('data');
            $table->string('nombre');
            $table->timestamps();
            $table->foreign('incidencia_id')->references('id')->on('incidencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_incidencia');
    }
};
