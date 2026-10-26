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
                'fecha_registro' => '2026-08-01 08:30:00',
                'usuario_IdUsuario' => 1,
                'habitaciones_No_habitacion' => 601,
                'ambientes_id_ambiente' => null,
            ],
            [
                'Tipo' => 'Limpieza',
                'fecha_registro' => '2026-08-03 10:15:00',
                'usuario_IdUsuario' => 2,
                'habitaciones_No_habitacion' => null,
                'ambientes_id_ambiente' => 2,
            ],
            [
                'Tipo' => 'Daño',
                'fecha_registro' => '2026-08-05 14:45:00',
                'usuario_IdUsuario' => 3,
                'habitaciones_No_habitacion' => 603,
                'ambientes_id_ambiente' => null,
            ],
            [
                'Tipo' => 'Revisión',
                'fecha_registro' => '2026-08-07 16:20:00',
                'usuario_IdUsuario' => 4,
                'habitaciones_No_habitacion' => null,
                'ambientes_id_ambiente' => 4,
            ],
        ]);
    }
}