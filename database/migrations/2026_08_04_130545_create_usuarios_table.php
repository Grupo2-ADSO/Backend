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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('IdUsuario');
            $table->string('Nombre', 100);
            $table->string('Apellidos', 100);
            $table->string('Correo', 150);
            $table->string('contrasena', 100);
            $table->enum('Estado', ['Activo','Inactivo'])->default('Activo');   
            $table->string('Cedula', 11)->unique();
            $table->string('Telefono', 11)->nullable();
            //$table->unsignedBigInteger('Rol_IdRol');
            $table->foreignId('Rol_IdRol')->constrained('rols', 'IdRol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
