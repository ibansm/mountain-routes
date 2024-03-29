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
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('ciudad')->nullable();
            $table->enum('dificultad',['baja','media','alta']);
            $table->float('longitud');
            $table->unsignedInteger('duracion');
            $table->boolean('ninos');
            // $table->date('fecha_creada');
            // $table->date('fecha_realizada');
            $table->json('coordenadas');
            $table->string('foto_perfil')->nullable();
            $table->unsignedBigInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
};
