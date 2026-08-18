<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'Nombre' => 'Carlos',
                'Apellidos' => 'Rodríguez',
                'Correo' => 'carlos@holidayinn.com',
                'Contrasena' => Hash::make('123456'),
                'Estado' => 'Activo',
                'Cedula' => 1001001001,
                'Telefono' => '3001234567',
                'Rol_IdRol' => 1,
            ],
            [
                'Nombre' => 'Laura',
                'Apellidos' => 'Gómez',
                'Correo' => 'laura@holidayinn.com',
                'Contrasena' => Hash::make('123456'),
                'Estado' => 'Activo',
                'Cedula' => 1001001002,
                'Telefono' => '3002345678',
                'Rol_IdRol' => 2,
            ],
            [
                'Nombre' => 'Andrés',
                'Apellidos' => 'Martínez',
                'Correo' => 'andres@holidayinn.com',
                'Contrasena' => Hash::make('123456'),
                'Estado' => 'Activo',
                'Cedula' => 1001001003,
                'Telefono' => '3003456789',
                'Rol_IdRol' => 3,
            ],
            [
                'Nombre' => 'Paula',
                'Apellidos' => 'Hernández',
                'Correo' => 'paula@holidayinn.com',
                'Contrasena' => Hash::make('123456'),
                'Estado' => 'Activo',
                'Cedula' => 1001001004,
                'Telefono' => '3004567890',
                'Rol_IdRol' => 3,
            ],
        ]);
    }
}