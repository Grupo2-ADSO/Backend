<?php

namespace Database\Seeders;

use App\Models\historial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorialSeeder extends Seeder
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
            'observaciones' => 'Exelente trabajo',
            'usuario_IdUsuario' => 1
        ]);
        historial::create([
            'id_orden' => 2,
            'estado' => 'terminado',
            'fecha' => '2026-03-07',
            'observaciones' => 'Bien, pero conpletar en menor tiempo',
            'usuario_IdUsuario' => 2
        ]);
        historial::create([
            'id_orden' => 3,
            'estado' => 'terminado',
            'fecha' => '2026-03-07',
            'observaciones' => 'ok, pero buscar una mejor solucion',
            'usuario_IdUsuario' => 3
        ]);
        historial::create([
            'id_orden' => 1,
            'estado' => 'terminado',
            'fecha' => '2026-03-07',
            'observaciones' => 'Ok',
            'usuario_IdUsuario' => 1
        ]);
        historial::create([
            'id_orden' => 2,
            'estado' => 'terminado',
            'fecha' => '2026-03-07',
            'observaciones' => 'Se recomienda una revision a futuro',
            'usuario_IdUsuario' => 2
        ]);
    }
}