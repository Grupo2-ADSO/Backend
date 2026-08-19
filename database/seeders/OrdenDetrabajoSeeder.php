<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdenDeTrabajoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ordenes_de_trabajos')->insert([
            [
                'descripcion' => 'Revisar aire acondicionado de la habitación.',
                'prioridad' => 'alta',
                'fecha_creacion' => '2026-08-01',
                'reportes_IdReporte' => 1,
                'ambientes_id_ambiente' => 1,
                'habitaciones_No_habitacion' => 601,
                'usuario_IdUsuario' => 3,
            ],
            [
                'descripcion' => 'Realizar limpieza general del área.',
                'prioridad' => 'media',
                'fecha_creacion' => '2026-08-03',
                'reportes_IdReporte' => 2,
                'ambientes_id_ambiente' => 2,
                'habitaciones_No_habitacion' => 602,
                'usuario_IdUsuario' => 4,
            ],
            [
                'descripcion' => 'Revisar daño reportado en la habitación.',
                'prioridad' => 'alta',
                'fecha_creacion' => '2026-08-05',
                'reportes_IdReporte' => 3,
                'ambientes_id_ambiente' => 3,
                'habitaciones_No_habitacion' => 603,
                'usuario_IdUsuario' => 3,
            ],
            [
                'descripcion' => 'Realizar revisión preventiva de instalaciones.',
                'prioridad' => 'baja',
                'fecha_creacion' => '2026-08-07',
                'reportes_IdReporte' => 4,
                'ambientes_id_ambiente' => 4,
                'habitaciones_No_habitacion' => 604,
                'usuario_IdUsuario' => 4,
            ],
        ]);
    }
}
