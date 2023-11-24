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
        Schema::create('carreras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('edicion')->nullable();
            $table->string('lugar');
            $table->string('salida')->nullable();
            $table->string('llegada')->nullable();
            $table->integer('desnivel');
            $table->json('desniveles')->nullable();
            $table->date('fecha');
            $table->boolean('fecha_confirmada');
            $table->json('servicios')->nullable();
            $table->json('info_tecnica')->nullable();
            $table->json('coordenadas')->nullable();
            $table->integer('inscripcion')->nullable();
            $table->float('precio')->nullable();
            $table->string('web')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreras');
    }
};
