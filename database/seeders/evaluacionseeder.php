<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class evaluacionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("evaluacion")->insert([
            "comentario" => "kk",
            "calificacion" => 5,
            "fecha_evaluacion" => "2023-06-01",
        ]);
    }
}
