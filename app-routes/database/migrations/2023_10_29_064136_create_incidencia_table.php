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
        Schema::create('incidencia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historico_id');
            $table->enum('tipo',['derrumbe','piedra','estado_fuente','hundimiento'])->default('estado_fuente');
            $table->double('coordenada');
            $table->timestamps();
            $table->foreign('historico_id')->references('id')->on('historico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencia');
    }
};
