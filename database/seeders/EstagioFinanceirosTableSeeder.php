<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstagioFinanceirosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estagio_financeiros')->insert([
            ['id' => 1, 'nome' => 'Em Análise', 'created_at' => '2023-02-05 12:45:52', 'updated_at' => '2023-02-05 12:45:53'],
            ['id' => 2, 'nome' => 'Emissão Boleto', 'created_at' => '2023-02-05 12:46:23', 'updated_at' => '2023-02-05 12:46:24'],
            ['id' => 3, 'nome' => 'Pag. Adesão', 'created_at' => '2023-02-05 12:46:38', 'updated_at' => '2023-02-05 12:46:39'],
            ['id' => 4, 'nome' => 'Pag. Vigência', 'created_at' => '2023-02-05 12:46:58', 'updated_at' => '2023-02-05 12:46:59'],
            ['id' => 5, 'nome' => 'Pag. 1º Parcela', 'created_at' => '2023-02-05 12:47:11', 'updated_at' => '2023-02-05 12:47:12'],
            ['id' => 6, 'nome' => 'Pag. 2º Parcela', 'created_at' => '2023-02-05 12:47:24', 'updated_at' => '2023-02-05 12:47:25'],
            ['id' => 7, 'nome' => 'Pag. 3º Parcela', 'created_at' => '2023-02-05 12:47:35', 'updated_at' => '2023-02-05 12:47:36'],
            ['id' => 8, 'nome' => 'Pag. 4º Parcela', 'created_at' => '2023-02-05 12:47:45', 'updated_at' => '2023-02-05 12:47:46'],
            ['id' => 9, 'nome' => 'Pag. 5º Parcela', 'created_at' => '2023-02-05 12:47:57', 'updated_at' => '2023-02-05 12:47:59'],
            ['id' => 10, 'nome' => 'Pag. 6º Parcela', 'created_at' => '2023-02-05 12:46:58', 'updated_at' => '2023-02-05 12:46:59'],
            ['id' => 11, 'nome' => 'Finalizado', 'created_at' => '2023-02-14 08:41:37', 'updated_at' => '2023-02-14 08:41:38'],
            ['id' => 12, 'nome' => 'Cancelado', 'created_at' => '2023-02-16 17:05:32', 'updated_at' => '2023-02-16 17:05:33'],
        ]);
    }
}
