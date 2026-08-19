<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluacionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('evaluacion')->insert([
            [
                'comentario' => 'Excelente servicio y atención del personal.',
                'calificacion' => '5',
                'fecha_evaluacion' => '2026-08-01'
            ],
            [
                'comentario' => 'La atención fue buena, pero hubo demora en el servicio.',
                'calificacion' => '4',
                'fecha_evaluacion' => '2026-08-03'
            ],
            [
                'comentario' => 'El servicio cumplió con las expectativas.',
                'calificacion' => '4',
                'fecha_evaluacion' => '2026-08-05'
            ],
            [
                'comentario' => 'Se presentó una demora en la atención de la habitación.',
                'calificacion' => '3',
                'fecha_evaluacion' => '2026-08-07'
            ],
            [
                'comentario' => 'Muy buena experiencia en el hotel.',
                'calificacion' => '5',
                'fecha_evaluacion' => '2026-08-10'
            ],
        ]);
    }
}