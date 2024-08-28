<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComissoesCorretoresDefaultSeederAccert extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('comissoes_corretores_default')->insert([
            ['plano_id' => 1, 'corretora_id' => 1, 'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 1, 'created_at' => '2023-04-15 20:32:34', 'updated_at' => '2023-04-15 20:32:34'],
            ['plano_id' => 1, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '30', 'parcela' => 2, 'created_at' => '2023-04-15 20:32:35', 'updated_at' => '2023-04-15 20:32:36'],
            ['plano_id' => 1, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 3, 'created_at' => '2023-04-15 20:32:37', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 1, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 4, 'created_at' => '2023-04-15 20:32:36', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 1, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-04-15 20:32:39', 'updated_at' => '2023-04-15 20:32:39'],
            ['plano_id' => 1, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 6, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],

            ['plano_id' => 2, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '30', 'parcela' => 1, 'created_at' => '2023-04-15 20:32:34', 'updated_at' => '2023-04-15 20:32:34'],
            ['plano_id' => 2, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 2, 'created_at' => '2023-04-15 20:32:35', 'updated_at' => '2023-04-15 20:32:36'],
            ['plano_id' => 2, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 3, 'created_at' => '2023-04-15 20:32:37', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 2, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 4, 'created_at' => '2023-04-15 20:32:36', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 2, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-04-15 20:32:39', 'updated_at' => '2023-04-15 20:32:39'],
            ['plano_id' => 2, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 6, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],

            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 1, 'created_at' => '2023-04-15 20:32:34', 'updated_at' => '2023-04-15 20:32:34'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '30', 'parcela' => 2, 'created_at' => '2023-04-15 20:32:35', 'updated_at' => '2023-04-15 20:32:36'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 3, 'created_at' => '2023-04-15 20:32:37', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 4, 'created_at' => '2023-04-15 20:32:36', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-04-15 20:32:39', 'updated_at' => '2023-04-15 20:32:39'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 6, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 1, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 7, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],

            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 1, 'created_at' => '2023-04-15 20:32:34', 'updated_at' => '2023-04-15 20:32:34'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '30', 'parcela' => 2, 'created_at' => '2023-04-15 20:32:35', 'updated_at' => '2023-04-15 20:32:36'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 3, 'created_at' => '2023-04-15 20:32:37', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 4, 'created_at' => '2023-04-15 20:32:36', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-04-15 20:32:39', 'updated_at' => '2023-04-15 20:32:39'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 6, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 2, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 7, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],

            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 1, 'created_at' => '2023-04-15 20:32:34', 'updated_at' => '2023-04-15 20:32:34'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '30', 'parcela' => 2, 'created_at' => '2023-04-15 20:32:35', 'updated_at' => '2023-04-15 20:32:36'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 3, 'created_at' => '2023-04-15 20:32:37', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '10', 'parcela' => 4, 'created_at' => '2023-04-15 20:32:36', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-04-15 20:32:39', 'updated_at' => '2023-04-15 20:32:39'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 6, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],
            ['plano_id' => 3, 'corretora_id' => 1,'administradora_id' => 3, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 7, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],

            ['plano_id' => 4, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '50', 'parcela' => 1, 'created_at' => '2023-09-22 21:02:58', 'updated_at' => '2023-09-22 21:03:12'],
            ['plano_id' => 4, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 2, 'created_at' => '2023-09-22 21:03:20', 'updated_at' => '2023-09-22 21:05:39'],
            ['plano_id' => 4, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 3, 'created_at' => '2023-09-22 21:05:45', 'updated_at' => '2023-09-22 21:05:50'],
            ['plano_id' => 4, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 4, 'created_at' => '2023-09-22 21:05:55', 'updated_at' => '2023-09-22 21:05:59'],
            ['plano_id' => 4, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-09-22 21:06:03', 'updated_at' => '2023-09-22 21:06:07'],
            ['plano_id' => 4, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 6, 'created_at' => '2023-09-22 21:06:11', 'updated_at' => '2023-09-22 21:06:28'],

            ['plano_id' => 5, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '60', 'parcela' => 1, 'created_at' => '2023-04-15 20:32:34', 'updated_at' => '2023-04-15 20:32:34'],
            ['plano_id' => 5, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 2, 'created_at' => '2023-04-15 20:32:35', 'updated_at' => '2023-04-15 20:32:36'],
            ['plano_id' => 5, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 3, 'created_at' => '2023-04-15 20:32:37', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 5, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 4, 'created_at' => '2023-04-15 20:32:36', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 5, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-04-15 20:32:39', 'updated_at' => '2023-04-15 20:32:39'],
            ['plano_id' => 5, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 6, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],

            ['plano_id' => 6, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '60', 'parcela' => 1, 'created_at' => '2023-04-15 20:32:34', 'updated_at' => '2023-04-15 20:32:34'],
            ['plano_id' => 6, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 2, 'created_at' => '2023-04-15 20:32:35', 'updated_at' => '2023-04-15 20:32:36'],
            ['plano_id' => 6, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 3, 'created_at' => '2023-04-15 20:32:37', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 6, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 4, 'created_at' => '2023-04-15 20:32:36', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 6, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-04-15 20:32:39', 'updated_at' => '2023-04-15 20:32:39'],
            ['plano_id' => 6, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 6, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],

            ['plano_id' => 8, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '40', 'parcela' => 1, 'created_at' => '2023-04-15 20:32:34', 'updated_at' => '2023-04-15 20:32:34'],
            ['plano_id' => 8, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 2, 'created_at' => '2023-04-15 20:32:35', 'updated_at' => '2023-04-15 20:32:36'],
            ['plano_id' => 8, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 3, 'created_at' => '2023-04-15 20:32:37', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 8, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 4, 'created_at' => '2023-04-15 20:32:36', 'updated_at' => '2023-04-15 20:32:38'],
            ['plano_id' => 8, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-04-15 20:32:39', 'updated_at' => '2023-04-15 20:32:39'],
            ['plano_id' => 8, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 6, 'created_at' => '2023-04-15 20:32:40', 'updated_at' => '2023-04-15 20:32:41'],

            // Adicione todos os outros registros aqui...
            ['plano_id' => 12, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '40', 'parcela' => 1, 'created_at' => '2023-09-22 21:02:58', 'updated_at' => '2023-09-22 21:03:12'],
            ['plano_id' => 12, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 2, 'created_at' => '2023-09-22 21:03:20', 'updated_at' => '2023-09-22 21:05:39'],
            ['plano_id' => 12, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 3, 'created_at' => '2023-09-22 21:05:45', 'updated_at' => '2023-09-22 21:05:50'],
            ['plano_id' => 12, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 4, 'created_at' => '2023-09-22 21:05:55', 'updated_at' => '2023-09-22 21:05:59'],
            ['plano_id' => 12, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 5, 'created_at' => '2023-09-22 21:06:03', 'updated_at' => '2023-09-22 21:06:07'],
            ['plano_id' => 12, 'corretora_id' => 1,'administradora_id' => 4, 'tabela_origens_id' => 2, 'valor' => '0', 'parcela' => 6, 'created_at' => '2023-09-22 21:06:11', 'updated_at' => '2023-09-22 21:06:28'],
        ]);
    }
}
