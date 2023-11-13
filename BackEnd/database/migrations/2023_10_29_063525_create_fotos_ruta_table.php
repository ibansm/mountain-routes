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
        Schema::create('fotos_ruta', function (Blueprint $table) {
            $table->id();
            $table->string('data')->unique();
            $table->string('nombre');
            $table->json('coordenadas');
            $table->unsignedBigInteger('rutas_id');
            $table->timestamps();
            $table->foreign('rutas_id')->references('id')->on('rutas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos_ruta');
    }
};
