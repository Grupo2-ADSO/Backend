<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evidencias', function (Blueprint $table) {
            $table->id('idEvidencia');
            $table->string('tipo', 100);
            $table->dateTime('fecha_envio');
            $table->string('ruta_archivo', 200);
            $table->string('observaciones', 200);
            $table->unsignedBigInteger('ordenes_de_trabajo_idOrden');
            $table->unsignedBigInteger('evaluacion_idEvaluacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidencia');
    }
};
