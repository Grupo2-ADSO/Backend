<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReporteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reportes')->insert([
            [
                'Tipo' => 'Mantenimiento',
                'fecha_registro' => '2026-08-01',
                'usuario_IdUsuario' => 1,
                'habitaciones_No_habitacion' => 601,
                'ambientes_id_ambiente' => 1,
            ],
            [
                'Tipo' => 'Limpieza',
                'fecha_registro' => '2026-08-03',
                'usuario_IdUsuario' => 2,
                'habitaciones_No_habitacion' => 602,
                'ambientes_id_ambiente' => 2,
            ],
            [
                'Tipo' => 'Daño',
                'fecha_registro' => '2026-08-05',
                'usuario_IdUsuario' => 3,
                'habitaciones_No_habitacion' => 603,
                'ambientes_id_ambiente' => 3,
            ],
            [
                'Tipo' => 'Revisión',
                'fecha_registro' => '2026-08-07',
                'usuario_IdUsuario' => 4,
                'habitaciones_No_habitacion' => 604,
                'ambientes_id_ambiente' => 4,
            ],
        ]);
    }
}