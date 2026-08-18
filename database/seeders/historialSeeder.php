<?php

namespace Database\Seeders;

use App\Models\historial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class historialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        historial::create([
            'id_orden' => 1,
            'estado' => 'terminado',
            'fecha' => '2026-03-07',
            'observaiones' => 'Exelente trabajo',
            'usuario_IdUsuario' => 1
        ]);
        historial::create([
            'id_orden' => 2,
            'estado' => 'terminado',
            'fecha' => '2026-03-07',
            'observaiones' => 'Bien, pero conpletar en menor tiempo',
            'usuario_IdUsuario' => 2
        ]);
        historial::create([
            'id_orden' => 3,
            'estado' => 'terminado',
            'fecha' => '2026-03-07',
            'observaiones' => 'ok, pero buscar una mejor solucion',
            'usuario_IdUsuario' => 3
        ]);
        historial::create([
            'id_orden' => 1,
            'estado' => 'terminado',
            'fecha' => '2026-03-07',
            'observaiones' => 'Ok',
            'usuario_IdUsuario' => 1
        ]);
        historial::create([
            'id_orden' => 2,
            'estado' => 'terminado',
            'fecha' => '2026-03-07',
            'observaiones' => 'Se recomienda una revision a futuro',
            'usuario_IdUsuario' => 2
        ]);
    }
}