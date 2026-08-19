<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('evidencias')->insert([
            [
                "tipo" => "imagen",
                "fecha_envio" => "2026-03-13 10:40:00",
                "ruta_archivo" => "/evidencias/img1.jpg",
                "observaciones" => "Aire reparado",
                "ordenes_de_trabajo_idOrden" => 1,
                "evaluacion_idEvaluacion" => 1
            ],
            [
                "tipo" => "video",
                "fecha_envio" => "2026-03-12 14:30:00",
                "ruta_archivo" => "/evidencias/video1.mp4",
                "observaciones" => "Funciona con normalidad",
                "ordenes_de_trabajo_idOrden" => 2,
                "evaluacion_idEvaluacion" => 2
            ],
            [
                "tipo" => "imagen",
                "fecha_envio" => "2026-03-11 09:25:00",
                "ruta_archivo" => "/evidencias/img2.jpg",
                "observaciones" => "Fuga controlada",
                "ordenes_de_trabajo_idOrden" => 3,
                "evaluacion_idEvaluacion" => 3
            ],
            [
                "tipo" => "documento",
                "fecha_envio" => "2026-03-10 16:50:00",
                "ruta_archivo" => "/docs/reporte1.pdf",
                "observaciones" => "Informe tecnico",
                "ordenes_de_trabajo_idOrden" => 4,
                "evaluacion_idEvaluacion" => 4
            ],
            [
                "tipo" => "imagen",
                "fecha_envio" => "2026-03-09 11:20:00",
                "ruta_archivo" => "/evidencias/img3.jpg",
                "observaciones" => "Problema resuleto parcialmente",
                "ordenes_de_trabajo_idOrden" => 5,
                "evaluacion_idEvaluacion" => 5
            ]
        ]);
    }
}
