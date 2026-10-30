<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->upsert(
            [
                [
                    'IdUsuario' => 1,
                    'Nombre' => 'Carlos',
                    'Apellidos' => 'Rodríguez',
                    'Correo' => 'carlos@holidayinn.com',
                    'contrasena' => Hash::make('123456'),
                    'Estado' => 'Activo',
                    'Cedula' => '1098765432',
                    'Telefono' => '3001234567',
                    'Rol_IdRol' => 1,
                ],
                [
                    'IdUsuario' => 2,
                    'Nombre' => 'Laura',
                    'Apellidos' => 'Gómez',
                    'Correo' => 'laura@holidayinn.com',
                    'contrasena' => Hash::make('123456'),
                    'Estado' => 'Activo',
                    'Cedula' => '1005678234',
                    'Telefono' => '3002345678',
                    'Rol_IdRol' => 2,
                ],
                [
                    'IdUsuario' => 3,
                    'Nombre' => 'Andrés',
                    'Apellidos' => 'Martínez',
                    'Correo' => 'andres@holidayinn.com',
                    'contrasena' => Hash::make('123456'),
                    'Estado' => 'Activo',
                    'Cedula' => '1123456789',
                    'Telefono' => '3003456789',
                    'Rol_IdRol' => 3,
                ],
                [
                    'IdUsuario' => 4,
                    'Nombre' => 'Paula',
                    'Apellidos' => 'Hernández',
                    'Correo' => 'paula@holidayinn.com',
                    'contrasena' => Hash::make('123456'),
                    'Estado' => 'Activo',
                    'Cedula' => '1034567892',
                    'Telefono' => '3004567890',
                    'Rol_IdRol' => 3,
                ],
            ],
            ['Cedula'],
            [
                'Nombre',
                'Apellidos',
                'Correo',
                'contrasena',
                'Estado',
                'Telefono',
                'Rol_IdRol',
            ]
        );
    }
}