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
        Schema::create('reportes', function (Blueprint $table) {
          $table->id('IdReporte');
          $table->string('Tipo', 50);
          $table->dateTime('fecha_registro');
          $table->foreignId('usuario_IdUsuario')->constrained('usuarios', 'IdUsuario');
          $table->foreignId('habitaciones_No_habitacion')->constrained('habitaciones', 'No_habitacion');
          $table->foreignId('ambientes_id_ambiente')->constrained('ambientes', 'id_ambiente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
