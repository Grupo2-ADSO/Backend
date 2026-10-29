<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rols')->insert([
            [
                'IdRol' => 1,
                'nombre' => 'Administrador',
            ],
            [
                'IdRol' => 2,
                'nombre' => 'Supervisor',
            ],
            [
                'IdRol' => 3,
                'nombre' => 'Operario',
            ],
        ]);
    }
}