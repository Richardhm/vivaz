<?php

namespace App\Http\Controllers;

use App\Models\Acomodacao;
use App\Models\Cliente;
use App\Models\Comissoes;
use App\Models\Contrato;
use App\Models\TabelaOrigens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceiroController extends Controller
{
    public function index(Request $request)
    {
        return view('financeiro.index');
    }

    public function geralIndividualPendentes(Request $request)
    {
        $corretora_id = $request->input('corretora_id');
        $user = auth()->user();

        // Consulta base
        $query = DB::table('comissoes_corretores_lancadas')
            ->join('comissoes', 'comissoes.id', '=', 'comissoes_corretores_lancadas.comissoes_id')
            ->join('contratos', 'contratos.id', '=', 'comissoes.contrato_id')
            ->join('clientes', 'clientes.id', '=', 'contratos.cliente_id')
            ->join('users', 'users.id', '=', 'clientes.user_id')
            ->join('estagio_financeiros', 'estagio_financeiros.id', '=', 'contratos.financeiro_id')
            ->select(
                DB::raw("DATE_FORMAT(contratos.created_at, '%d/%m/%Y') as data"),
                'contratos.codigo_externo as orcamento',
                'users.name as corretor',
                'clientes.nome as cliente',
                'clientes.cpf as cpf',
                'clientes.quantidade_vidas as quantidade_vidas',
                'contratos.valor_plano as valor_plano',
                'contratos.id',
                'estagio_financeiros.nome as parcelas',
                DB::raw("DATE_FORMAT(comissoes_corretores_lancadas.data, '%d/%m/%Y') as vencimento"),
                DB::raw("DATE_FORMAT(clientes.data_nascimento, '%d/%m/%Y') as data_nascimento"),
                'clientes.celular as fone',
                'clientes.email as email',
                'clientes.cidade as cidade',
                'clientes.bairro as bairro',
                'clientes.rua as rua',
                'clientes.cep as cep',
                DB::raw("CASE WHEN comissoes_corretores_lancadas.data < CURDATE() AND estagio_financeiros.id != 10 THEN 'Atrasado' ELSE 'Aprovado' END AS status")
            );

        if ($request->mes != '00' && isset($request->mes)) {
            $mes = $request->mes;
            $query->whereMonth('contratos.created_at', $mes);
        }

        // Se o usuário pode listar todos, aplicar o filtro por corretora somente se corretora_id for diferente de 0
        if ($user->can('listar_todos_accert') || $user->can('listar_todos_innove')) {
            if ($corretora_id != 0) {
                $query->where('clientes.corretora_id', $corretora_id);
            }
        } else {
            // Para usuários que não podem listar todos, filtrar apenas pela corretora do usuário
            $userCorretoraId = $user->corretora_id; // Supondo que o modelo User tem um campo corretora_id
            if ($corretora_id != $userCorretoraId) {
                // Se o corretora_id solicitado não corresponde à corretora do usuário, não retornar dados
                $query->where('clientes.corretora_id', $userCorretoraId);
            } else {
                // Caso contrário, aplicar o filtro pelo corretora_id solicitado
                $query->where('clientes.corretora_id', $corretora_id);
            }
        }
        $query->where('contratos.plano_id',1);
        $resultado = $query->groupBy('comissoes_corretores_lancadas.comissoes_id')->get();

        return response()->json(['data' => $resultado]);
    }

    public function formCreate(Request $request)
    {
        $users = User::where("id","!=",auth()->user()->id)->get();
        $origem_tabela = TabelaOrigens::all();
        return view('contratos.cadastrar',[
            'users' => $users,
            'origem_tabela' => $origem_tabela
        ]);
    }

    public function montarPlanosIndividual(Request $request)
    {
        $sql = "";
        $chaves = [];
        foreach($request->faixas[0] as $k => $v) {
            if($v != null AND $v != 0) {
                $sql .= "WHEN (SELECT id FROM faixa_etarias WHERE faixa_etarias.id = tabelas.faixa_etaria_id) = $k THEN $v ";
                $chaves[] = $k;
            }
        }


        $chaves = implode(",",$chaves);
        $cidade = $request->tabela_origem;
        $odonto = $request->odonto == "sim" ? 1 : 0;
        $coparticipacao = $request->coparticipacao == "sim" ? 1 : 0;

        $dados = DB::select("SELECT
            id,
            (select logo from administradoras where administradoras.id = tabelas.administradora_id) as logo,
            (select id from administradoras where administradoras.id = tabelas.administradora_id) as administradora,
            tabela_origens_id,
            (select nome from planos where planos.id = tabelas.plano_id) as planos,
            (select nome from acomodacoes where acomodacoes.id = tabelas.acomodacao_id) as acomodacao,

            (select nome from faixa_etarias where faixa_etarias.id = tabelas.faixa_etaria_id) as faixa,
            if(coparticipacao,'Com Coparticipação','Sem Coparticipação') as coparticipacao,
            if(odonto,'Com Odonto','Sem Odonto') as odonto,
        CASE
            $sql
        ELSE 0
        END AS quantidade,
        valor,
        CONCAT('card_',acomodacao_id) AS card
        FROM tabelas
        WHERE faixa_etaria_id IN($chaves) AND tabela_origens_id =  $cidade AND administradora_id = 4 AND plano_id = 1 AND odonto = $odonto AND coparticipacao = $coparticipacao");



        return view("financeiro.acomodacao",[
            "dados" => $dados,
            "card_inicial" => $dados[0]->card,
            "quantidade" => count($dados)
        ]);
    }


    public function storeIndividual(Request $request)
    {

        $cpf = str_replace([".","-"],"",$request->cpf_individual);
        $dia = 10;
        $codigo_externo = $request->codigo_externo_individual;




        $valores_numericos = array_filter($request->faixas_etarias, function ($valor) {
            return is_numeric($valor);
        });
        $quantidade_vidas = array_sum($valores_numericos);
        $valor = str_replace([".",","],["","."],$request->valor);
        $cliente = new Cliente();
        $cliente->user_id = $request->users_individual;
        $cliente->corretora_id = auth()->user()->corretora_id;
        $cliente->nome = $request->nome_individual;
        $cliente->cidade = $request->cidade_origem_individual;
        $cliente->celular = $request->celular_individual;
        $cliente->telefone = $request->telefone_individual;
        $cliente->email = $request->email_individual;
        $cliente->cpf = $request->cpf_individual;
        $cliente->data_nascimento = date('Y-m-d',strtotime($request->data_nascimento_individual));
        $cliente->cep = $request->cep_individual;
        $cliente->rua = $request->rua_individual;
        $cliente->bairro = $request->bairro_individual;
        $cliente->complemento = $request->complemento_individual;
        $cliente->uf = $request->uf_individual;
        $cliente->pessoa_fisica = 1;
        $cliente->pessoa_juridica = 0;
        $cliente->dependente = ($request->dependente_individual == "on" ? 1 : 0);
        $cliente->quantidade_vidas = $quantidade_vidas;
        $cliente->nm_plano = null;
        $cliente->numero_registro_plano = null;
        $cliente->rede_plano = null;
        $cliente->tipo_acomodacao_plano = null;
        $cliente->segmentacao_plano = null;
        $cliente->cateirinha = null;
        $cliente->dados = 1;
        $cliente->save();

//        if($cliente->dependente) {
//            $dependente = new Dependentes();
//            $dependente->cliente_id = $cliente->id;
//            $dependente->nome = $request->responsavel_financeiro_individual_cadastro;
//            $dependente->cpf = $request->cpf_financeiro_individual_cadastro;
//            $dependente->save();
//        }


        $acomodacao = $request->acomodacao;
        $acomodacao_id = Acomodacao::selectRaw('id')->whereRaw("nome LIKE '%{$acomodacao}%'")->first()->id;
        $data_vigencia = $request->data_vigencia;
        $data_boleto = $request->data_boleto;
        $valor_adesao = str_replace([".",","],["","."],$request->valor_adesao);
        $valor_plano = str_replace([".",","],["","."],$request->valor);

        $contrato = new Contrato();
        $contrato->cliente_id = $cliente->id;
        $contrato->administradora_id = 4;
        $contrato->acomodacao_id = $acomodacao_id;
        $contrato->tabela_origens_id = $request->tabela_origem_individual;
        $contrato->plano_id = 1;
        $contrato->financeiro_id = 1;
        $contrato->coparticipacao = ($request->coparticipacao_individual == "sim" ? 1 : 0);
        $contrato->odonto = ($request->odonto_individual == "sim" ? 1 : 0);
        $contrato->codigo_externo = $request->codigo_externo_individual;
        $contrato->data_vigencia = $data_vigencia;
        $contrato->data_boleto = $data_boleto;
        $contrato->valor_adesao = $valor_adesao;
        $contrato->valor_plano = $valor_plano;
        $contrato->save();

        // CotacaoFaixaEtaria::where("contrato_id",$contrato->id)->delete();
        $totalVidas = 0;
        $faixas = $request->faixas_etarias;
        foreach($faixas as $k => $v) {
            if($v != 0) {

                $totalVidas += $v;
            }
        }

        $comissao = new Comissoes();
        $comissao->contrato_id = $contrato->id;
        // $comissao->cliente_id = $contrato->cliente_id;
        $comissao->user_id = $request->users_individual;
        // $comissao->status = 1;
        $comissao->plano_id = 1;
        $comissao->corretora_id = auth()->user()->corretora_id;
        $comissao->administradora_id = 4;
        $comissao->tabela_origens_id = $request->tabela_origem_individual;
        $comissao->data = date('Y-m-d');
        $comissao->save();

//        $comissoes_configuradas_corretor = ComissoesCorretoresConfiguracoes
//            ::where("plano_id",1)
//            ->where("administradora_id",4)
//            ->where("user_id",$request->users_individual)
//            ->where("tabela_origens_id",2)
//            ->get();
//
//        $comissao_corretor_contagem = 0;
//        $comissao_corretor_default = 0;
//
//        if(count($comissoes_configuradas_corretor) >= 1) {
//            foreach($comissoes_configuradas_corretor as $c) {
//                $valor_comissao = $valor_plano - 25;
//                $comissaoVendedor = new ComissoesCorretoresLancadas();
//                $comissaoVendedor->comissoes_id = $comissao->id;
//                $comissaoVendedor->parcela = $c->parcela;
//                $comissaoVendedor->valor = ($valor_comissao * $c->valor) / 100;
//                if($comissao_corretor_contagem == 0) {
//                    $comissaoVendedor->data = $data_vigencia;
//                    $comissaoVendedor->status_financeiro = 1;
//                    if($comissaoVendedor->valor == "0.00" || $comissaoVendedor->valor == 0 || $comissaoVendedor->valor >= 0) {
//
//                    }
//                    $comissaoVendedor->data_baixa = implode("-",array_reverse(explode("/",$data_vigencia)));
//                    $comissaoVendedor->valor_pago = $valor_adesao;
//                } else {
//                    $data_vigencia_sem_dia = date("Y-m",strtotime($data_vigencia));
//                    $dates = date("Y-m",strtotime($data_vigencia_sem_dia."+{$comissao_corretor_contagem}month"));
//
//                    $mes = explode("-",$dates)[1];
//                    if($dia == 30 && $mes == 02) {
//                        $comissaoVendedor->data = date("Y-02-28");
//                        $ano = explode("-",$comissaoVendedor->data)[0];
//                        $bissexto= date('L', mktime(0, 0, 0, 1, 1, $ano));
//
//                        if($bissexto == 1) {
//                            $comissaoVendedor->data = date("Y-02-29");
//                        } else {
//                            $comissaoVendedor->data = date("Y-02-28");
//                        }
//
//                    }  else {
//                        $comissaoVendedor->data = date("Y-m-".$dia,strtotime($dates));
//                    }
//
//                }
//                $comissaoVendedor->save();
//                $comissao_corretor_contagem++;
//            }
//        } else {
//
//            $dados = ComissoesCorretoresDefault
//                ::where("plano_id",1)
//                ->where("administradora_id",4)
//                ->where("tabela_origens_id",2)
//                ->get();
//            foreach($dados as $c) {
//                $valor_comissao_default = $valor_plano - 25;
//
//
//                $comissaoVendedor = new ComissoesCorretoresLancadas();
//                $comissaoVendedor->comissoes_id = $comissao->id;
//                $comissaoVendedor->parcela = $c->parcela;
//                $comissaoVendedor->valor = ($valor_comissao_default * $c->valor) / 100;
//
//                if($comissao_corretor_default == 0) {
//                    $comissaoVendedor->data = $data_vigencia;
//                    $comissaoVendedor->status_financeiro = 1;
//                    if($comissaoVendedor->valor == "0.00" || $comissaoVendedor->valor == 0 || $comissaoVendedor->valor >= 0) {
//
//                    }
//                    $comissaoVendedor->data_baixa = implode("-",array_reverse(explode("/",$data_vigencia)));
//                    $comissaoVendedor->valor_pago = $valor_adesao;
//                } else {
//                    $data_vigencia_sem_dia = date("Y-m",strtotime($data_vigencia));
//                    $dates = date("Y-m",strtotime($data_vigencia_sem_dia."+{$comissao_corretor_default}month"));
//
//                    $mes = explode("-",$dates)[1];
//                    if($dia == 30 && $mes == 02) {
//                        $comissaoVendedor->data = date("Y-02-28");
//                        $ano = explode("-",$comissaoVendedor->data)[0];
//                        $bissexto= date('L', mktime(0, 0, 0, 1, 1, $ano));
//
//                        if($bissexto == 1) {
//                            $comissaoVendedor->data = date("Y-02-29");
//                        } else {
//                            $comissaoVendedor->data = date("Y-02-28");
//                        }
//
//                    }  else {
//                        $comissaoVendedor->data = date("Y-m-".$dia,strtotime($dates));
//                    }
//
//                }
//                $comissaoVendedor->save();
//                $comissao_corretor_default++;
//            }
//        } /****FIm SE Comissoes Lancadas */










        if($request->tipo_cadastro == "administrador_cadastro") {
            return "contratos";
        } else {
            return "contrato";
        }

    }







}
