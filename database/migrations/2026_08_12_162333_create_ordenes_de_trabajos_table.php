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
        Schema::create('ordenes_de_trabajos', function (Blueprint $table) {
           $table->id('idOrden');
            $table->string('descripcion', 200);
            $table->enum('prioridad', ['alta','media','baja']);
            $table->date('fecha_creacion');
            $table->foreignId('reportes_IdReporte')->constrained('reportes', 'IdReporte');
            $table->foreignId('ambientes_id_ambiente')->constrained('ambientes', 'id_ambiente');
          $table->integer('habitaciones_No_habitacion');
            $table->foreign('habitaciones_No_habitacion')
                  ->references('No_habitacion')
                  ->on('habitaciones');
            $table->foreignId('usuario_IdUsuario')->constrained('usuarios', 'IdUsuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_de_trabajos');
    }
};
