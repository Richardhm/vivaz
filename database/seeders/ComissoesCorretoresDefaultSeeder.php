<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ComissoesCorretoresDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['plano_id' => 1, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 1],
            ['plano_id' => 1, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '30', 'parcela' => 2],
            ['plano_id' => 1, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 3],
            ['plano_id' => 1, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 4],
            ['plano_id' => 1, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 5],
            ['plano_id' => 1, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 6],

            ['plano_id' => 2, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '30', 'parcela' => 1],
            ['plano_id' => 2, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 2],
            ['plano_id' => 2, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 3],
            ['plano_id' => 2, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 4],
            ['plano_id' => 2, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 5],
            ['plano_id' => 2, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 6],

            ['plano_id' => 4, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '30', 'parcela' => 1],
            ['plano_id' => 4, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 2],
            ['plano_id' => 4, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 3],
            ['plano_id' => 4, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 4],
            ['plano_id' => 4, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 5],
            ['plano_id' => 4, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 6],

            ['plano_id' => 5, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '60', 'parcela' => 1],
            ['plano_id' => 5, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 2],
            ['plano_id' => 5, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 3],
            ['plano_id' => 5, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 4],
            ['plano_id' => 5, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 5],
            ['plano_id' => 5, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 6],

            ['plano_id' => 3, 'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 1],
            ['plano_id' => 3, 'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '50',  'parcela' => 2],
            ['plano_id' => 3, 'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 3],
            ['plano_id' => 3, 'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 4],
            ['plano_id' => 3, 'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 5],
            ['plano_id' => 3, 'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 6],
            ['plano_id' => 3, 'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 7],

            ['plano_id' => 3, 'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 1],
            ['plano_id' => 3, 'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '50',  'parcela' => 2],
            ['plano_id' => 3, 'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 3],
            ['plano_id' => 3, 'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 4],
            ['plano_id' => 3, 'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 5],
            ['plano_id' => 3, 'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 6],
            ['plano_id' => 3, 'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 7],

            ['plano_id' => 3, 'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 1],
            ['plano_id' => 3, 'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '50',  'parcela' => 2],
            ['plano_id' => 3, 'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 3],
            ['plano_id' => 3, 'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 4],
            ['plano_id' => 3, 'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 5],
            ['plano_id' => 3, 'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 6],
            ['plano_id' => 3, 'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0',  'parcela' => 7],



            // ... continue para todas as outras entradas ...
        ];

        foreach ($data as $entry) {
            $entry['created_at'] = Carbon::now();
            $entry['updated_at'] = Carbon::now();
            $entry['corretora_id'] = 2;  // Inserir corretora_id para todos os registros
            DB::table('comissoes_corretores_default')->insert($entry);
        }


    }
}
