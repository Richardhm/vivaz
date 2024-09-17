<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Concessionaria;
use App\Models\ContratoEmpresarial;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function filtragem(Request $request)
    {
        $concessionarias = Concessionaria::all();
        $corretora = $request->input('corretora');
        $corretora_id = null;

        if ($corretora == 'accert') {
            $corretora_id = 1;
        } elseif ($corretora == 'innove') {
            $corretora_id = 2;
        } elseif ($corretora == 'estrela' || $corretora == 'vivaz' || $corretora == "concessi") {
            // Não filtrar, traz todos os dados
            $corretora_id = null;
        }

        if($corretora != "estrela" && $corretora != "concessi") {
            $ranking = DB::select("
                SELECT users.name as corretor, users.image as imagem,SUM(CASE WHEN comissoes.plano_id = 1 AND comissoes.empresarial = 0 THEN  (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0) FROM clientes INNER JOIN contratos ON contratos.cliente_id = clientes.id WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 1) ELSE 0 END) as quantidade_individual, SUM( CASE WHEN comissoes.plano_id = 3 AND comissoes.empresarial = 0 THEN (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0) FROM clientes INNER JOIN contratos ON contratos.cliente_id = clientes.id WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 3) ELSE 0 END) as quantidade_coletivo,
                SUM(CASE WHEN comissoes.plano_id = 5 AND comissoes.empresarial = 1 THEN (SELECT IFNULL(SUM(contrato_empresarial.quantidade_vidas), 0) FROM contrato_empresarial WHERE contrato_empresarial.id = comissoes.contrato_empresarial_id AND contrato_empresarial.plano_id = 5) ELSE 0 END) as quantidade_empresarial,
                SUM( CASE WHEN comissoes.plano_id = 1 AND comissoes.empresarial = 0 THEN (SELECT IFNULL(SUM(contratos.valor_plano), 0) FROM contratos WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 1) WHEN comissoes.plano_id = 3 AND comissoes.empresarial = 0 THEN (SELECT IFNULL(SUM(contratos.valor_plano), 0) FROM contratos  WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 3) WHEN comissoes.plano_id = 5 AND comissoes.empresarial = 1 THEN (SELECT IFNULL(SUM(contrato_empresarial.valor_plano), 0) FROM contrato_empresarial WHERE contrato_empresarial.id = comissoes.contrato_empresarial_id AND contrato_empresarial.plano_id = 5) ELSE 0 END) as valor_total,
                SUM(CASE WHEN comissoes.empresarial = 1 THEN (SELECT IFNULL(SUM(contrato_empresarial.quantidade_vidas), 0) FROM contrato_empresarial WHERE contrato_empresarial.id = comissoes.contrato_empresarial_id AND contrato_empresarial.plano_id = 5) ELSE (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0) FROM clientes INNER JOIN contratos ON contratos.cliente_id = clientes.id WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = comissoes.plano_id AND contratos.plano_id IN (1, 3)) END) as quantidade_vidas,(corretoras.nome) as corretora FROM comissoes
                INNER JOIN users ON users.id = comissoes.user_id
                INNER JOIN corretoras ON users.corretora_id = corretoras.id
                WHERE comissoes.plano_id IN (1,3,5) " . ($corretora_id ? " AND comissoes.corretora_id = {$corretora_id}" : "") . "
                GROUP BY comissoes.user_id
                ORDER BY quantidade_vidas DESC;
            ");
            $podium = view('ranking.podium',[
                'ranking' => $ranking
            ])->render();
            $ranking = view('ranking.ranking',[
                'ranking' => $ranking
            ])->render();
            $totals = DB::select("SELECT
                SUM(CASE WHEN comissoes.plano_id = 1 AND comissoes.empresarial = 0 THEN (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0) FROM clientes INNER JOIN contratos ON contratos.cliente_id = clientes.id WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 1) ELSE 0 END) as total_individual,
                SUM(CASE WHEN comissoes.plano_id = 3 AND comissoes.empresarial = 0 THEN (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0) FROM clientes INNER JOIN contratos ON contratos.cliente_id = clientes.id WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 3) ELSE 0 END) as total_coletivo,
                SUM( CASE WHEN comissoes.plano_id = 5 AND comissoes.empresarial = 1 THEN(SELECT IFNULL(SUM(contrato_empresarial.quantidade_vidas), 0) FROM contrato_empresarial WHERE contrato_empresarial.id = comissoes.contrato_empresarial_id AND contrato_empresarial.plano_id = 5)ELSE 0 END) as total_empresarial
                FROM comissoes
                WHERE comissoes.plano_id IN (1, 3, 5) " . ($corretora_id ? " AND comissoes.corretora_id = {$corretora_id}" : "") . "
            ");

            return [
                'podium' => $podium,
                'ranking' => $ranking,
                'totals' => $totals,
                'concessionarias' => $concessionarias
            ];

        } else if($corretora == "estrela") {

            $ranking = DB::select("
                SELECT users.name as corretor,users.image as imagem,
                SUM(CASE WHEN comissoes.plano_id = 1 AND comissoes.empresarial = 0 THEN (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0) FROM clientes INNER JOIN contratos ON contratos.cliente_id = clientes.id WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 1) ELSE 0 END) as quantidade_individual,
                0 as quantidade_coletivo,
                0 quantidade_empresarial,
                SUM(CASE WHEN comissoes.plano_id = 1 AND comissoes.empresarial = 0 THEN (SELECT IFNULL(SUM(contratos.valor_plano), 0) FROM contratos WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 1) ELSE 0 END) as valor_total,
                SUM((SELECT IFNULL(SUM(clientes.quantidade_vidas), 0) FROM clientes INNER JOIN contratos ON contratos.cliente_id = clientes.id WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = comissoes.plano_id AND contratos.plano_id IN (1))) as quantidade_vidas,
                (corretoras.nome) as corretora
                FROM comissoes
                INNER JOIN users ON users.id = comissoes.user_id
                INNER JOIN corretoras ON users.corretora_id = corretoras.id
                WHERE comissoes.plano_id IN (1) " . ($corretora_id ? " AND comissoes.corretora_id = {$corretora_id}" : "") . "
                GROUP BY comissoes.user_id
                ORDER BY quantidade_vidas DESC;
            ");

            $podium = view('ranking.podium',[
                'ranking' => $ranking
            ])->render();
            $ranking = view('ranking.ranking',[
                'ranking' => $ranking
            ])->render();
            $totals = DB::select("SELECT
                SUM(CASE WHEN comissoes.plano_id = 1 AND comissoes.empresarial = 0 THEN (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0) FROM clientes INNER JOIN contratos ON contratos.cliente_id = clientes.id WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 1) ELSE 0 END) as total_individual,
                SUM(CASE WHEN comissoes.plano_id = 3 AND comissoes.empresarial = 0 THEN (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0) FROM clientes INNER JOIN contratos ON contratos.cliente_id = clientes.id WHERE contratos.id = comissoes.contrato_id AND contratos.plano_id = 3) ELSE 0 END) as total_coletivo,
                SUM( CASE WHEN comissoes.plano_id = 5 AND comissoes.empresarial = 1 THEN(SELECT IFNULL(SUM(contrato_empresarial.quantidade_vidas), 0) FROM contrato_empresarial WHERE contrato_empresarial.id = comissoes.contrato_empresarial_id AND contrato_empresarial.plano_id = 5)ELSE 0 END) as total_empresarial
                FROM comissoes
                WHERE comissoes.plano_id IN (1, 3, 5) " . ($corretora_id ? " AND comissoes.corretora_id = {$corretora_id}" : "") . "
            ");

            return [
                'podium' => $podium,
                'ranking' => $ranking,
                'totals' => $totals,
                'concessionarias' => $concessionarias
            ];

        } else if($corretora == "concessi") {

            $ranking = DB::select("
                SELECT id,nome,
                meta_individual + meta_super_simples + meta_pme + meta_adesao AS meta_total,
                individual + super_simples + pme + adesao AS total_vidas,
                ROUND(((individual + super_simples + pme + adesao) /
                (meta_individual + meta_super_simples + meta_pme + meta_adesao)) * 100, 2) AS porcentagem_vendas
                FROM concessionarias
                ORDER BY total_vidas DESC;
            ");
            $podium = view('ranking.podium-concessionarias',[
                'ranking' => $ranking
            ])->render();
            $ranking = view('ranking.ranking-concessionarias',[
                'ranking' => $ranking
            ])->render();

            $totals = DB::select("
                SELECT
                    SUM(individual) AS total_individual,
                    SUM(super_simples) AS total_super_simples,
                    SUM(pme) AS total_pme,
                    SUM(adesao) AS total_adesao,
                    SUM(meta_individual) + SUM(meta_super_simples) + SUM(meta_pme) + SUM(meta_adesao) AS total_meta,
                    SUM(individual) + SUM(super_simples) + SUM(pme) + SUM(adesao) AS total_vidas,
                    (SUM(individual) + SUM(super_simples) + SUM(pme) + SUM(adesao)) /
                    NULLIF(SUM(meta_individual) + SUM(meta_super_simples) + SUM(meta_pme) + SUM(meta_adesao), 0) * 100 AS porcentagem_geral
                FROM
                    concessionarias;
            ");

            return [
                'podium' => $podium,
                'ranking' => $ranking,
                'totals_con' => $totals,
                'concessionarias' => $concessionarias
            ];
        } else {

        }
    }









    public function index(Request $request)
    {
        $ranking = DB::select("
            SELECT
                users.name as corretor,
                users.image as imagem,
                SUM(
                        CASE
                            WHEN comissoes.plano_id = 1 AND comissoes.empresarial = 0 THEN
                                (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0)
                                 FROM clientes
                                          INNER JOIN contratos ON contratos.cliente_id = clientes.id
                                 WHERE contratos.id = comissoes.contrato_id
                                   AND contratos.plano_id = 1)
                            ELSE 0
                            END
                ) as quantidade_individual,
                SUM(
                        CASE
                            WHEN comissoes.plano_id = 3 AND comissoes.empresarial = 0 THEN
                                (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0)
                                 FROM clientes
                                          INNER JOIN contratos ON contratos.cliente_id = clientes.id
                                 WHERE contratos.id = comissoes.contrato_id
                                   AND contratos.plano_id = 3)
                            ELSE 0
                            END
                ) as quantidade_coletivo,
                SUM(
                        CASE
                            WHEN comissoes.plano_id = 5 AND comissoes.empresarial = 1 THEN
                                (SELECT IFNULL(SUM(contrato_empresarial.quantidade_vidas), 0)
                                 FROM contrato_empresarial
                                 WHERE contrato_empresarial.id = comissoes.contrato_empresarial_id
                                   AND contrato_empresarial.plano_id = 5)
                            ELSE 0
                            END
                ) as quantidade_empresarial,
                SUM(
                        CASE
                            WHEN comissoes.plano_id = 1 AND comissoes.empresarial = 0 THEN
                                (SELECT IFNULL(SUM(contratos.valor_plano), 0)
                                 FROM contratos
                                 WHERE contratos.id = comissoes.contrato_id
                                   AND contratos.plano_id = 1)
                            WHEN comissoes.plano_id = 3 AND comissoes.empresarial = 0 THEN
                                (SELECT IFNULL(SUM(contratos.valor_plano), 0)
                                 FROM contratos
                                 WHERE contratos.id = comissoes.contrato_id
                                   AND contratos.plano_id = 3)
                            WHEN comissoes.plano_id = 5 AND comissoes.empresarial = 1 THEN
                                (SELECT IFNULL(SUM(contrato_empresarial.valor_plano), 0)
                                 FROM contrato_empresarial
                                 WHERE contrato_empresarial.id = comissoes.contrato_empresarial_id
                                   AND contrato_empresarial.plano_id = 5)
                            ELSE 0
                            END
                ) as valor_total,
                SUM(
                        CASE
                            WHEN comissoes.empresarial = 1 THEN
                                (SELECT IFNULL(SUM(contrato_empresarial.quantidade_vidas), 0)
                                 FROM contrato_empresarial
                                 WHERE contrato_empresarial.id = comissoes.contrato_empresarial_id
                                   AND contrato_empresarial.plano_id = 5)
                            ELSE
                                (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0)
                                 FROM clientes
                                          INNER JOIN contratos ON contratos.cliente_id = clientes.id
                                 WHERE contratos.id = comissoes.contrato_id
                                   AND contratos.plano_id = comissoes.plano_id
                                   AND contratos.plano_id IN (1, 3))
                            END
                ) as quantidade_vidas,
                (corretoras.nome) as corretora
            FROM comissoes
                     INNER JOIN users ON users.id = comissoes.user_id
                     INNER JOIN corretoras ON users.corretora_id = corretoras.id
            WHERE comissoes.plano_id IN (1,3,5)
            GROUP BY comissoes.user_id
            ORDER BY quantidade_vidas DESC;
        ");

        $totals = DB::select("
            SELECT
                SUM(
                    CASE WHEN comissoes.plano_id = 1 AND comissoes.empresarial = 0 THEN
                        (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0)
                         FROM clientes
                         INNER JOIN contratos ON contratos.cliente_id = clientes.id
                         WHERE contratos.id = comissoes.contrato_id
                         AND contratos.plano_id = 1)
                    ELSE 0
                    END
                ) as total_individual,
                SUM(
                    CASE WHEN comissoes.plano_id = 3 AND comissoes.empresarial = 0 THEN
                        (SELECT IFNULL(SUM(clientes.quantidade_vidas), 0)
                         FROM clientes
                         INNER JOIN contratos ON contratos.cliente_id = clientes.id
                         WHERE contratos.id = comissoes.contrato_id
                         AND contratos.plano_id = 3)
                    ELSE 0
                    END
                ) as total_coletivo,
                SUM(
                    CASE WHEN comissoes.plano_id = 5 AND comissoes.empresarial = 1 THEN
                        (SELECT IFNULL(SUM(contrato_empresarial.quantidade_vidas), 0)
                         FROM contrato_empresarial
                         WHERE contrato_empresarial.id = comissoes.contrato_empresarial_id
                         AND contrato_empresarial.plano_id = 5)
                    ELSE 0
                    END
                ) as total_empresarial
            FROM comissoes
            WHERE comissoes.plano_id IN (1, 3, 5)
        ");


        $concessionarias = Concessionaria::all();




        return view('ranking.index',[
            'ranking' => $ranking,
            'totals' => $totals,
            'concessionarias' => $concessionarias
        ]);
    }

    public function cadastrarConcessionaria(Request $request)
    {

        $concessionarias = $request->input('concessionarias');

        // Itera sobre cada concessionária e salva as alterações
        foreach ($concessionarias as $concessionariaData) {
            // Encontra a concessionária pelo ID
            $concessionaria = Concessionaria::find($concessionariaData['id']);

            // Atualiza os campos da concessionária
            if ($concessionaria) {
                $concessionaria->meta_individual = $concessionariaData['meta_individual'];
                $concessionaria->individual = $concessionariaData['individual'];

                $concessionaria->meta_super_simples = $concessionariaData['meta_super_simples'];
                $concessionaria->super_simples = $concessionariaData['super_simples'];

                $concessionaria->meta_pme = $concessionariaData['meta_pme'];
                $concessionaria->pme = $concessionariaData['pme'];

                $concessionaria->meta_adesao = $concessionariaData['meta_adesao'];
                $concessionaria->adesao = $concessionariaData['adesao'];

                // Salva a concessionária no banco de dados
                $concessionaria->save();
            }
        }

        // Retorna uma resposta de sucesso
        return response()->json(['success' => true]);
    }
}
