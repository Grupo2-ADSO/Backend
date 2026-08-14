<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ambiente;

class AmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ambiente::insert([
            ['nombre' => 'oficinas'],
            ['nombre' => 'golden'],
            ['nombre' => 'restaurante'],
            ['nombre' => 'skybar'],
            ['nombre' => 'cocina_16'],
            ['nombre' => 'cocina_18'],
            ['nombre' => 'salones'],
            ['nombre' => 'pasillos'],
            ['nombre' => 'zona de carga'],
            ['nombre' => 'porcionamiento'],
            ['nombre' => 'lavanderia'],
            ['nombre' => 'baños_empleados_ss'],
        ]);
    }
}
