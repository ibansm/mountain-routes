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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo',['arbol','derrumbe','piedra','estado_fuente','hundimiento'])->default('estado_fuente');
            $table->text('descripcion');
            $table->json('coordenada');
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('rutas_id');
            $table->unsignedBigInteger('historicos_id');
            $table->timestamps();
            $table->foreign('historicos_id')->references('id')->on('historicos');
            $table->foreign('rutas_id')->references('id')->on('rutas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
