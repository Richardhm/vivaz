<?php

namespace Database\Seeders;

use App\Models\MotivoCancelado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotivoCanceladoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motivos = [
            ['id' => 1, 'nome' => 'Dados Incorretos'],
            ['id' => 2, 'nome' => 'Cliente Desistiu do Plano'],
            ['id' => 3, 'nome' => 'Cliente Trocou o Plano'],
            ['id' => 4, 'nome' => 'Cliente não encontrado'],
        ];

        foreach ($motivos as $motivo) {
            MotivoCancelado::create($motivo);
        }
    }
}
