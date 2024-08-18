<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cargos')->insert([
            [
                'id' => 1,
                'nome' => 'administrador'
            ],
            [
                'id' => 2,
                'nome' => 'corretor'
            ],
            [
                'id' => 3,
                'nome' => 'financeiro'
            ],
            [
                'id' => 4,
                'nome' => 'gerente'
            ],
            [
                'id' => 5,
                'nome' => 'sub-gerente'
            ],
        ]);
    }
}
