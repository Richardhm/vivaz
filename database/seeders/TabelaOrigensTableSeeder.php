<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabelaOrigensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tabela_origens')->insert([
            ['id' => 1, 'nome' => 'Anapolis', 'uf' => 'Goias'],
            ['id' => 2, 'nome' => 'Goiania', 'uf' => 'Goias'],
            ['id' => 3, 'nome' => 'Rondonópolis', 'uf' => 'MT'],
            ['id' => 4, 'nome' => 'Cuiabá', 'uf' => 'MT'],
            ['id' => 5, 'nome' => 'Três Lagoas', 'uf' => 'MS'],
            ['id' => 6, 'nome' => 'Dourados', 'uf' => 'MS'],
            ['id' => 7, 'nome' => 'Campo Grande', 'uf' => 'MS'],
            ['id' => 8, 'nome' => 'Brasília', 'uf' => 'DF'],
            ['id' => 9, 'nome' => 'Belo Horizonte', 'uf' => 'MG'],
            ['id' => 10, 'nome' => 'Uberlândia', 'uf' => 'MG'],
            ['id' => 11, 'nome' => 'Uberaba', 'uf' => 'MG'],
            ['id' => 12, 'nome' => 'Contagem', 'uf' => 'MG'],
            ['id' => 13, 'nome' => 'Montes Claros', 'uf' => 'MG'],
            ['id' => 14, 'nome' => 'Divinópolis', 'uf' => 'MG'],
            ['id' => 15, 'nome' => 'Betim', 'uf' => 'MG'],
        ]);
    }
}
