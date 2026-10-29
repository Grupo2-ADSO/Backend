<?php

namespace Database\Seeders;

use App\Http\Controllers\HabitacionesController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\habitaciones;

class HabitacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($piso = 6; $piso <= 15; $piso++) {
            for ($numero = 1; $numero <= 16; $numero++) {
                $habitacion = ($piso * 100) + $numero;

                if ($numero <= 7 || $numero == 11) {
                    $tipo = "KDXN";
                } else {
                    $tipo = "TDXN";
                }

                habitaciones::create([
                    'No_habitacion' => $habitacion,
                    'piso' => $piso,
                    'tipo_hab' => $tipo
                ]);
            }
        }
    }
}
