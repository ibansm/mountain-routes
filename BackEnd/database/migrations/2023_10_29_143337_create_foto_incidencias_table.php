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
        Schema::create('foto_incidencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incidencias_id');
            $table->string('data');
            $table->string('nombre');
            $table->timestamps();
            $table->foreign('incidencias_id')->references('id')->on('incidencias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_incidencias');
    }
};
