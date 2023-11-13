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
            $table->unsignedBigInteger('historicos_id');
            $table->enum('tipo',['derrumbe','piedra','estado_fuente','hundimiento'])->default('estado_fuente');
            $table->json('coordenada');
            $table->boolean('estado')->default(true);
            $table->timestamps();
            $table->foreign('historicos_id')->references('id')->on('historicos');
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
