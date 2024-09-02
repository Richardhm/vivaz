<?php

namespace App\Http\Controllers;

use App\Models\Acomodacao;
use App\Models\Administradora;
use App\Models\cidadeCodigoVendedor;
use App\Models\Cliente;
use App\Models\Comissoes;
use App\Models\ComissoesCorretoraConfiguracoes;
use App\Models\ComissoesCorretoraLancadas;
use App\Models\ComissoesCorretoresConfiguracoes;
use App\Models\ComissoesCorretoresDefault;
use App\Models\ComissoesCorretoresLancadas;
use App\Models\Contrato;
use App\Models\ContratoEmpresarial;
use App\Models\Dependente;
use App\Models\MotivoCancelado;
use App\Models\Plano;
use App\Models\TabelaOrigens;
use App\Models\User;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FinanceiroController extends Controller
{
    public function index(Request $request)
    {
        return view('financeiro.index');
    }

    public function geralIndividualPendentes(Request $request)
    {

        $corretora_id = 1;
        $user = auth()->user();

        if ($request->ajax()) {

            if($request->mes == '00' || !isset($request->mes)) {

                $cacheKey = 'geralIndividualPendentesCobranca'.time();
                $tempoDeExpiracao = 60;
                $resultado = Cache::remember($cacheKey, $tempoDeExpiracao, function () use($corretora_id){
                    return DB::select("
                        SELECT
                        DATE_FORMAT(contratos.created_at,'%d/%m/%Y') as data,
                        (contratos.codigo_externo) as orcamento,
                        users.name as corretor,
                        clientes.nome as cliente,
                        DATE_FORMAT(clientes.data_nascimento,'%d/%m/%Y') AS data_nascimento,
                        clientes.celular AS telefone,
                        clientes.cpf as cpf,
                        clientes.quantidade_vidas as quantidade_vidas,
                        (contratos.valor_plano) as valor_plano,
                        contratos.id,
                        estagio_financeiros.nome as parcelas,
                        DATE_FORMAT(comissoes_corretores_lancadas.data,'%d/%m/%Y') as vencimento,
                        CASE
                            WHEN comissoes_corretores_lancadas.data < CURDATE() AND estagio_financeiros.id != 10 THEN 'Atrasado'
                            ELSE 'Aprovado'
                        END AS status

                    FROM comissoes_corretores_lancadas
                            INNER JOIN comissoes ON comissoes.id = comissoes_corretores_lancadas.comissoes_id
                            INNER JOIN contratos ON contratos.id = comissoes.contrato_id
                            INNER JOIN clientes ON clientes.id = contratos.cliente_id
                            INNER JOIN users ON users.id = clientes.user_id
                            INNER JOIN estagio_financeiros ON estagio_financeiros.id = contratos.financeiro_id
                    WHERE
                    contratos.plano_id = 1 AND ( (comissoes_corretores_lancadas.data_baixa IS NULL AND comissoes_corretores_lancadas.status_financeiro = 0)
	                OR (comissoes_corretores_lancadas.parcela = 6 AND comissoes_corretores_lancadas.status_financeiro = 1))
                    AND clientes.corretora_id = $corretora_id
                    GROUP BY comissoes_corretores_lancadas.comissoes_id;
                    ");
                });







            } else {
                $mes = $request->mes;
                $cacheKey = "geralIndividualPendentesCobranca{$mes}";
                $tempoDeExpiracao = 60;
                $resultado = Cache::remember($cacheKey, $tempoDeExpiracao, function () use($mes,$corretora_id) {
                    return DB::select("
                        SELECT
                        DATE_FORMAT(contratos.created_at,'%d/%m/%Y') as data,
                        (contratos.codigo_externo) as orcamento,
                        users.name as corretor,
                        clientes.nome as cliente,
                        DATE_FORMAT(clientes.data_nascimento,'%d/%m/%Y') AS data_nascimento,
                        clientes.celular AS telefone,
                        clientes.cpf as cpf,
                        clientes.quantidade_vidas as quantidade_vidas,
                        (contratos.valor_plano) as valor_plano,
                        contratos.id,
                        estagio_financeiros.nome as parcelas,
                        DATE_FORMAT(comissoes_corretores_lancadas.data,'%d/%m/%Y') as vencimento,
                        CASE
                            WHEN comissoes_corretores_lancadas.data < CURDATE() AND estagio_financeiros.id != 10 THEN 'Atrasado'
                            ELSE 'Aprovado'
                        END AS status

                    FROM comissoes_corretores_lancadas
                            INNER JOIN comissoes ON comissoes.id = comissoes_corretores_lancadas.comissoes_id
                            INNER JOIN contratos ON contratos.id = comissoes.contrato_id
                            INNER JOIN clientes ON clientes.id = contratos.cliente_id
                            INNER JOIN users ON users.id = clientes.user_id
                            INNER JOIN estagio_financeiros ON estagio_financeiros.id = contratos.financeiro_id
                    WHERE
                        (status_financeiro = 0 OR (status_financeiro = 1 AND parcela = 6))
                    AND contratos.plano_id = 1
                    AND clientes.cateirinha IS NOT NULL and month(contratos.created_at) = {$mes} and clientes.corretora_id = $corretora_id

                    GROUP BY contratos.id;
                    ");
                });
            }
            return response()->json(['data' => $resultado]);
        }

    }


    public function formCreateEmpresarial()
    {
        $users = User
            ::where("id","!=",1)
            ->get();

        $plano_empresarial = Plano::where("empresarial",1)->get();
        $tabela_origem = TabelaOrigens::all();
        return view('financeiro.cadastrar-empresa',[
            "users" => $users,
            "planos_empresarial" => $plano_empresarial,
            "origem_tabela" =>  $tabela_origem
        ]);
    }

    public function storeEmpresarialFinanceiro(Request $request)
    {
        //dd($request->all());

        $corretora_id = User::find($request->user_id)->corretora_id;
        $codigo_vendedor = User::find($request->user_id)->codigo_vendedor;

        $dados = $request->except('_token');

        $dados['taxa_adesao'] = str_replace([".", ","], ["", "."], $request->taxa_adesao);
        $dados['desconto_corretor'] = $request->desconto_corretor != "" ? str_replace([".", ","], ["", "."], $request->desconto_corretor) : 0;
        $dados['desconto_corretora'] = $request->desconto_corretora != "" ? str_replace([".", ","], ["", "."], $request->desconto_corretora) : 0;
        $dados['data_baixa'] = date('Y-m-d');
        $dados['codigo_vendedor'] = $codigo_vendedor;
        $dados['valor_plano'] = str_replace([".", ","], ["", "."], $request->valor_plano);
        $dados['valor_plano_saude'] = str_replace([".", ","], ["", "."], $request->valor_plano_saude);
        $dados['valor_plano_odonto'] = str_replace([".", ","], ["", "."], $request->valor_plano_odonto);
        $dados['valor_plano'] = $dados['valor_plano_saude'] + $dados['valor_plano_odonto'];
        $dados['valor_total'] = $dados['valor_plano'] + $dados['taxa_adesao'];
        $dados['valor_boleto'] = str_replace([".", ","], ["", "."], $request->valor_boleto);
        $dados['data_boleto'] = date('Y-m-d', strtotime($request->data_boleto));
        $dados['corretora_id'] = $corretora_id;
        $dados['created_at'] = $request->created_at;
        $dados['financeiro_id'] = 1;
        $valor = $dados['valor_plano'];





        $contrato = ContratoEmpresarial::create($dados);
        $comissao = new Comissoes();
        $comissao->contrato_empresarial_id = $contrato->id;
        // $comissao->cliente_id = $contrato->cliente_id;
        $comissao->user_id = $request->user_id;
        $comissao->corretora_id = $corretora_id;
        // $comissao->status = 1;
        $comissao->plano_id = $request->plano_id;
        $comissao->administradora_id = 4;
        $comissao->tabela_origens_id = $request->tabela_origens_id;
        $comissao->data = date('Y-m-d');
        $comissao->empresarial = 1;
        $comissao->save();


        $comissoes_configuradas_corretor = ComissoesCorretoresConfiguracoes
            ::where("plano_id", $request->plano_id)
            ->where("administradora_id", 4)
            ->where("user_id", $request->user_id)
            ->get();


        $date = new \DateTime(now());
        $date->add(new \DateInterval('PT1M'));
        $data = $date->format('Y-m-d H:i:s');


        $comissao_corretor_contagem = 0;
        $comissao_corretor_default = 0;
        if (count($comissoes_configuradas_corretor) >= 1) {
            foreach ($comissoes_configuradas_corretor as $c) {
                $comissaoVendedor = new ComissoesCorretoresLancadas();
                $comissaoVendedor->comissoes_id = $comissao->id;
                //$comissaoVendedor->user_id = auth()->user()->id;
                $comissaoVendedor->parcela = $c->parcela;
                if ($comissao_corretor_contagem == 0) {
                    $comissaoVendedor->data = date('Y-m-d H:i:s', strtotime($request->data_boleto));
                    //$comissaoVendedor->tempo = $data;
                } else {
                    $comissaoVendedor->data = date("Y-m-d H:i:s", strtotime($request->data_boleto . "+{$comissao_corretor_contagem}month"));
                    $date = new \DateTime($data);
                    $date->add(new \DateInterval("PT{$comissao_corretor_contagem}M"));
                    $data_add = $date->format('Y-m-d H:i:s');
                    //$comissaoVendedor->tempo = $data_add;
                }
                $comissaoVendedor->valor = ($valor * $c->valor) / 100;
                $comissaoVendedor->save();
                $comissao_corretor_contagem++;
            }
        } else {
            $dados = ComissoesCorretoresDefault
                ::where("plano_id", $request->plano_id)
                ->where("administradora_id", 4)
                ->where('corretora_id',$corretora_id)
                ->get();
            foreach ($dados as $c) {
                $comissaoVendedor = new ComissoesCorretoresLancadas();
                $comissaoVendedor->comissoes_id = $comissao->id;
                $comissaoVendedor->parcela = $c->parcela;
                if ($comissao_corretor_default == 0) {
                    $comissaoVendedor->data = date('Y-m-d H:i:s', strtotime($request->data_boleto));
                    //$comissaoVendedor->data = $data_vigencia;
                    //$comissaoVendedor->status_financeiro = 1;
                    // if($comissaoVendedor->valor == "0.00" || $comissaoVendedor->valor == 0 || $comissaoVendedor->valor >= 0) {
                    //     //$comissaoVendedor->status_gerente = 1;
                    // }

                } else {
                    $comissaoVendedor->data = date("Y-m-d H:i:s", strtotime($request->data_boleto . "+{$comissao_corretor_default}month"));
                    $date = new \DateTime($data);
                    $date->add(new \DateInterval("PT{$comissao_corretor_default}M"));
                    //$data_add = $date->format('Y-m-d H:i:s');
                }
                $comissaoVendedor->valor = ($valor * $c->valor) / 100;
                $comissaoVendedor->save();
                $comissao_corretor_default++;
            }
        }

       return redirect('/financeiro?ac=empresarial');
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

    private function codigoExterno($codigo)
    {
        $cliente = Cliente::where("codigo_externo",$codigo)->count();
        return $cliente;
    }
    public function sincronizarDados(Request $request)
    {
        set_time_limit(300);
        $filename = uniqid() . ".xlsx";
        if (move_uploaded_file($request->file, $filename)) {
            $filePath = base_path("public/{$filename}");
            $cpfs = [];
            $reader = ReaderEntityFactory::createReaderFromFile($filePath);
            $reader->open($filePath);
            $cidade = "";
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $rowNumber => $row) {
                    $cells = $row->getCells();
                    if ($rowNumber === 3) {
                        $cidade = $cells[2]->getValue();
                    }
                    if ($rowNumber >= 5 && $this->codigoExterno($cells[0]->getValue()) == 0) {
                        $cpf = mb_strlen($cells[4]->getValue()) == 11 ? $cells[4]->getValue() : str_pad($cells[4]->getValue(), 11, "000", STR_PAD_LEFT);
                        $dia = str_pad($cells[18]->getValue(), 2, "0", STR_PAD_LEFT);
                        array_push($cpfs, $cells[0]->getValue());
                        //$user_count = User::where('codigo_vendedor', $cells[2]->getValue())->count();
                        //$user_count = cidadeCodigoVendedor::where("codigo_vendedor",$cells[2]->getValue());

                        $user_id = User::where('codigo_vendedor', $cells[2]->getValue())->first()->id;
                        $corretora_id = User::where('codigo_vendedor', $cells[2]->getValue())->first()->corretora_id;





                        $cidade_id = 2;
                        $cliente = new Cliente();
                        $cliente->user_id = $user_id;
                        $cliente->nome = mb_convert_case($cells[5]->getValue(), MB_CASE_TITLE, "UTF-8");
                        $cliente->celular = $cells[7]->getValue();
                        $cliente->corretora_id = $corretora_id;
                        $cliente->cpf = $cpf;
                        $cliente->data_nascimento = implode("-", array_reverse(explode("/", $cells[6]->getValue())));
                        $cliente->pessoa_fisica = 1;
                        $cliente->pessoa_juridica = 0;
                        $cliente->codigo_externo = $cells[0]->getValue();
                        $cliente->corretora_id = $corretora_id;
                        if ($cells[8]->getValue() == "RESPONSÁVEL FINANCEIRO") {
                            $cliente->quantidade_vidas = $cells[15]->getValue();
                        } else {
                            $cliente->quantidade_vidas = $cells[15]->getValue() + 1;
                        }
//
                        $cliente->save();
                        $data_vigencia = implode("-", array_reverse(explode("/", $cells[17]->getValue())));
                        $contrato = new Contrato();
                        //$contrato->acomodacao_id = $acomodacao_id;
                        $contrato->cliente_id = $cliente->id;
                        $contrato->administradora_id = 4;
                        $contrato->tabela_origens_id = $cidade_id;
                        $contrato->plano_id = 1;
                        $contrato->financeiro_id = 5;
                        $contrato->data_vigencia = implode("-", array_reverse(explode("/", $cells[17]->getValue())));
                        $contrato->codigo_externo = $cells[0]->getValue();
                        $contrato->data_boleto = implode("-", array_reverse(explode("/", $cells[17]->getValue())));
                        $contrato->valor_adesao = str_replace([".",","],["","."], $cells[12]->getValue());
                        $contrato->valor_plano = (float) str_replace([".",","],["","."], $cells[12]->getValue()) - 25;
                        $contrato->coparticipacao = 1;
                        $contrato->odonto = 0;
                        $contrato->created_at = $data_vigencia;
                        $contrato->desconto_corretor = "0";
                        $contrato->desconto_corretora = "0";
                        $contrato->save();
                        $comissao = new Comissoes();
                        $comissao->contrato_id = $contrato->id;
                        // $comissao->cliente_id = $contrato->cliente_id;
                        $comissao->user_id = $user_id;
                        // $comissao->status = 1;
                        $comissao->plano_id = 1;
                        $comissao->administradora_id = 4;
                        $comissao->tabela_origens_id = $cidade_id;
                        $comissao->data = date('Y-m-d');
                        $comissao->corretora_id = $corretora_id;
                        $comissao->save();

                        $comissoes_configuradas_corretor = ComissoesCorretoresConfiguracoes
                            ::where("plano_id", 1)
                            ->where("administradora_id", 4)
                            ->where("user_id", $user_id)
                            //->where("tabela_origens_id", 2)
                            ->get();
//
                        $comissao_corretor_contagem = 0;
                        $comissao_corretor_default = 0;
//
//
                        if (count($comissoes_configuradas_corretor) >= 1) {
                            foreach ($comissoes_configuradas_corretor as $c) {
                                $valor_comissao = (float) str_replace([".",","],["","."], $cells[12]->getValue()) - 25;
                                $comissaoVendedor = new ComissoesCorretoresLancadas();
                                $comissaoVendedor->comissoes_id = $comissao->id;
                                //$comissaoVendedor->user_id = auth()->user()->id;
                                // $comissaoVendedor->documento_gerador = "12345678";
                                $comissaoVendedor->parcela = $c->parcela;
                                $comissaoVendedor->valor = ($valor_comissao * $c->valor) / 100;
                                if ($comissao_corretor_contagem == 0) {
                                    $comissaoVendedor->data = $data_vigencia;
                                    $comissaoVendedor->status_financeiro = 1;
                                    if ($comissaoVendedor->valor == "0.00" || $comissaoVendedor->valor == 0 || $comissaoVendedor->valor >= 0) {

                                    }
                                    $comissaoVendedor->data_baixa = implode("-", array_reverse(explode("/", $cells[17]->getValue())));
                                    $comissaoVendedor->valor_pago = str_replace([".",","],["","."], $cells[12]->getValue());
                                } else {
                                    $data_vigencia_sem_dia = date("Y-m", strtotime($data_vigencia));
                                    $dates = date("Y-m", strtotime($data_vigencia_sem_dia . "+{$comissao_corretor_contagem}month"));

                                    $mes = explode("-", $dates)[1];
                                    if ($dia == 30 && $mes == 02) {

                                        $ano = explode("-", $dates)[0];

                                        $comissaoVendedor->data = date($ano."-02-28");
                                        $ano = explode("-", $comissaoVendedor->data)[0];
                                        $bissexto = date('L', mktime(0, 0, 0, 1, 1, $ano));

                                        if ($bissexto == 1) {
                                            $comissaoVendedor->data = date($ano."-02-29");
                                        } else {

                                            $comissaoVendedor->data = date($ano."-02-28");
                                        }

                                    } else {
                                        $comissaoVendedor->data = date("Y-m-" . $dia, strtotime($dates));
                                    }

                                }
                                $comissaoVendedor->save();
                                $comissao_corretor_contagem++;
                            }
                        } else {

                            $dados = ComissoesCorretoresDefault
                                ::where("plano_id", 1)
                                ->where("administradora_id", 4)
                                ->where("corretora_id",$corretora_id)
                                //->where("tabela_origens_id", 2)
                                ->get();
                            foreach ($dados as $c) {
                                $valor_comissao_default = (float) str_replace([".",","],["","."], $cells[12]->getValue()) - 25;
                                $comissaoVendedor = new ComissoesCorretoresLancadas();
                                $comissaoVendedor->comissoes_id = $comissao->id;
                                $comissaoVendedor->parcela = $c->parcela;
                                $comissaoVendedor->valor = ($valor_comissao_default * $c->valor) / 100;
                                if ($comissao_corretor_default == 0) {
                                    $comissaoVendedor->data = $data_vigencia;
                                    $comissaoVendedor->status_financeiro = 1;
                                    if ($comissaoVendedor->valor == "0.00" || $comissaoVendedor->valor == 0 || $comissaoVendedor->valor >= 0) {

                                    }
                                    $comissaoVendedor->data_baixa = implode("-", array_reverse(explode("/", $cells[17]->getValue())));
                                    $comissaoVendedor->valor_pago = str_replace([".",","],["","."], $cells[12]->getValue());
                                } else {
                                    $data_vigencia_sem_dia = date("Y-m", strtotime($data_vigencia));
                                    $dates = date("Y-m", strtotime($data_vigencia_sem_dia . "+{$comissao_corretor_default}month"));

                                    $mes = explode("-", $dates)[1];
                                    if ($dia == 30 && $mes == 02) {
                                        $ano = explode("-", $dates)[0];
                                        $comissaoVendedor->data = date($ano."-02-28");

                                        $bissexto = date('L', mktime(0, 0, 0, 1, 1, $ano));
                                        if ($bissexto == 1) {
                                            $comissaoVendedor->data = date($ano."-02-29");
                                        } else {
                                            $comissaoVendedor->data = date($ano."-02-28");
                                        }
                                    } else {
                                        $comissaoVendedor->data = date("Y-m-" . $dia, strtotime($dates));
                                    }
                                }
                                $comissaoVendedor->save();
                                $comissao_corretor_default++;
                            }
                            //}
                            /****FIm SE Comissoes Lancadas */
                        }




                    }

                    //unlink("public/".$filename);
                }
            }
        }
        //Cliente::orderBy("id","desc")->first()->update(["last"=>1]);
        return "sucesso";
    }

    public function formCreateColetivo()
    {
        $corretora_id = auth()->user()->corretora_id;
        $users = User::where("id","!=",1)->where('ativo',1)->where('corretora_id',$corretora_id)->get();
        $origem_tabela = TabelaOrigens::all();
        $administradoras = Administradora::whereRaw("id != (SELECT id FROM administradoras WHERE nome LIKE '%hapvida%')")->get();
        return view('financeiro.cadastrar-coletivo',[
            'users' => $users,
            'cidades' => $origem_tabela,
            'administradoras' => $administradoras
        ]);
    }

    public function montarPlanos(Request $request)
    {
        $sql = "";
        $chaves = [];
        foreach($request->faixas[0] as $k => $v) {
            if($v != null AND $v != 0) {
                $sql .= "WHEN (SELECT id FROM faixa_etarias WHERE faixa_etarias.id = tabelas.faixa_etaria_id) = $k THEN $v ";
                $chaves[] = $k;
            }
        }

        $administradora = $request->administradora_id;
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
        WHERE faixa_etaria_id IN($chaves) AND tabela_origens_id =  $cidade AND administradora_id = $administradora AND odonto = $odonto AND coparticipacao = $coparticipacao");

        return view("financeiro.acomodacao",[
            "dados" => $dados,
            "card_inicial" => $dados[0]->card,
            "quantidade" => count($dados)
        ]);

    }






    public function detalhesContrato($id)
    {

        $contratos = Contrato
            ::where("id",$id)
            ->with(['administradora',
                'financeiro',
                'cidade',
                'comissao',
                'acomodacao',
                'plano',
                'comissao.comissaoAtualFinanceiro','comissao.comissoesLancadas','clientes','clientes.user'])
            ->orderBy("id","desc")
            ->first();

        $users = User::where("id","!=",auth()->user()->id)->get();


        return view('financeiro.detalhe',[
            "dados" => $contratos,
            "users" => $users,

            "plano" => $contratos->plano->id
        ]);
    }




    public function sincronizarBaixasJaExiste(Request $request)
    {
        set_time_limit(300);
        $filename = uniqid() . ".xlsx";
        if (move_uploaded_file($request->file, $filename)) {
            $filePath = base_path("public/{$filename}");
            $cpfs = [];
            $reader = ReaderEntityFactory::createReaderFromFile($filePath);
            $reader->open($filePath);
            $cidade = "";
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $rowNumber => $row) {
                    if($rowNumber > 1) {
                        $cells = $row->getCells();
                        $nome = $cells[7]->getValue();
                        $codi = $cells[4]->getValue();
                        //echo $cells[11]->getValue()."<br />";

//                        if($cells[11]->getValue() == "CANCELADO") {
//
//                            $spreadsheetCodeCancelado = $cells[5]->getValue();
//
//                            $carteirinha_existe_cancelado = Cliente
//                                ::select('clientes.*')
//                                ->join('users','users.id','=','clientes.user_id')
//                                ->join('contratos','contratos.cliente_id','=','clientes.id')
//                                ->whereRaw("LEFT(cateirinha, 11) = ?", [$spreadsheetCodeCancelado])
//                                ///->whereDate('contratos.created_at',$cells[6]->getValue()->format('Y-m-d'))
//                                ->with(['user','contrato'])
//                                ->first();
//                            $contrato_id_cancelado = $carteirinha_existe_cancelado->contrato->id;
//                            //Contrato::where("id",$contrato_id_cancelado)->update(["financeiro_id" => 6]);
//                            $alt = Contrato::find($contrato_id_cancelado);
//                            $alt->cancelado_confirmacao = 1;
//                            $alt->save();
//                            //echo $nome_existe."<br />";
//                            //$contrato_id_cancelado = Contrato::where("cliente_id",$id_alt)->first()->id;
//                            //echo $contrato_id_cancelado."<br />";
//                        }






                        if($id_alt = $this->verificarCarteirinha($nome,$codi)) {




                            $cliente_alt = Cliente::find($id_alt);
                            $cliente_alt->cateirinha = $cells[5]->getValue();
                            $cliente_alt->save();

                            $contrato_id = Contrato::where("cliente_id",$id_alt)->first()->id;
                            $cc = Contrato::find($contrato_id);
                            $cc->created_at = $cells[6]->getValue()->format('Y-m-d');
                            $cc->save();


                            //$contrato_id_cancelado = $cliente_alt->contrato->id;
                            if($cells[11]->getValue() == "LIQUIDADO" || $cells[11]->getValue() == "LIQUIDADO N/COB") {
                                if($cliente_alt) {
                                    $comissoes = $cliente_alt->contrato->comissao->comissoesLancadas;
                                    $vencimento = $cells[13]->getValue()->format('Y-m-d');
                                    $dt_pagamento = $cells[12]->getValue()->format('Y-m-d');
                                    foreach($comissoes as $c) {
                                        if(date('m', strtotime($c->data)) == date('m', strtotime($vencimento))) {
                                            ComissoesCorretoresLancadas::find($c->id)->update([
                                                'status_financeiro'=>1,
                                                'data_baixa' => $dt_pagamento,
                                                'valor_pago' => $cells[10]->getValue()
                                            ]);
                                            switch($c->parcela) {
                                                case 2:
                                                    $contrato_id=Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 6]);
                                                    break;

                                                case 3:
                                                    $contrato_id = Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 7]);
                                                    break;

                                                case 4:
                                                    $contrato_id = Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 8]);
                                                    break;

                                                case 5:
                                                    $contrato_id = Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 9]);
                                                    break;

                                                case 6:
                                                    $contrato_id = Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 11]);
                                                    break;

                                                default:

                                                    break;
                                            }
                                        }
                                    }
                                }
                            }
                        } else {

                            $nome_existe = $cells[7]->getValue();
                            $codi_existe = $cells[4]->getValue();
                            $spreadsheetCode = $cells[5]->getValue();

                            $carteirinha_existe = Cliente
                                ::select('clientes.*')
                                ->join('users','users.id','=','clientes.user_id')
                                ->join('contratos','contratos.cliente_id','=','clientes.id')
                                ->whereRaw("LEFT(cateirinha, 11) = ?", [$spreadsheetCode])
                                ///->whereDate('contratos.created_at',$cells[6]->getValue()->format('Y-m-d'))
                                ->with(['user','contrato','contrato.comissao','contrato.comissao.comissoesLancadas'])
                                ->first();

                            if($cells[11]->getValue() == "LIQUIDADO" || $cells[11]->getValue() == "LIQUIDADO N/COB") {
                                if($carteirinha_existe) {
                                    $comissoes = $carteirinha_existe->contrato->comissao->comissoesLancadas;
                                    $vencimento = $cells[13]->getValue()->format('Y-m-d');
                                    $dt_pagamento = $cells[12]->getValue()->format('Y-m-d');
                                    foreach($comissoes as $c) {
                                        if(date('m', strtotime($c->data)) == date('m', strtotime($vencimento))) {
                                            ComissoesCorretoresLancadas::find($c->id)->update([
                                                'status_financeiro'=>1,
                                                'data_baixa' => $dt_pagamento,
                                                'valor_pago' => $cells[10]->getValue()
                                            ]);
                                            switch($c->parcela) {
                                                case 2:
                                                    $contrato_id=Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 6]);
                                                    break;

                                                case 3:
                                                    $contrato_id = Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 7]);
                                                    break;

                                                case 4:
                                                    $contrato_id = Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 8]);
                                                    break;

                                                case 5:
                                                    $contrato_id = Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 9]);
                                                    break;

                                                case 6:
                                                    $contrato_id = Comissoes::where("id",$c->comissoes_id)->first()->contrato_id;
                                                    Contrato::where("id",$contrato_id)->update(["financeiro_id" => 11]);
                                                    break;

                                                default:

                                                    break;
                                            }
                                        }
                                    }
                                }
                            }


                        }
                    }
                }
            }
        }
        return "successo";
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


    private function coletivoVerificarCodigoExterno($codigo)
    {


        $contrato = Contrato::where("codigo_externo",$codigo);
        return $contrato->count();
    }



    public function store(Request $request)
    {
        $corretora_id = User::find($request->usuario_coletivo_switch)->corretora_id;
        if($cod = $this->coletivoVerificarCodigoExterno($request->codigo_externo_coletivo) != 0) {
            return "ja_existe";
        }
        $desconto_corretor = $request->desconto_corretor;
        $desconto_corretora = $request->desconto_corretora;
        $valor = str_replace([".",","],["","."],$request->valor);
        $cliente = new Cliente();
        $cliente->nome = $request->nome_coletivo;
        $cliente->corretora_id = $corretora_id;
        $cliente->user_id = $request->usuario_coletivo_switch;
        $cliente->cidade = $request->cidade_origem_coletivo;
        $cliente->celular = $request->celular;
        $cliente->telefone = $request->telefone;
        $cliente->email = $request->email_coletivo;
        $cliente->cpf = $request->cpf_coletivo;
        $cliente->data_nascimento = date('Y-m-d',strtotime($request->data_nascimento_coletivo));
        $cliente->cep = $request->cep_coletivo;
        $cliente->rua = $request->rua_coletivo;
        $cliente->bairro = $request->bairro_coletivo;
        $cliente->complemento = $request->complemento_coletivo;
        $cliente->uf = $request->uf_coletivo;
        $cliente->pessoa_fisica = 1;
        $cliente->pessoa_juridica = 0;
        $cliente->dependente = ($request->dependente_coletivo == "on" ? 1 : 0);
        $cliente->save();

        if($cliente->dependente) {

            $dependente = new Dependente();
            $dependente->cliente_id = $cliente->id;
            $dependente->nome = $request->responsavel_financeiro_coletivo_cadastrar_nome;
            $dependente->cpf = $request->responsavel_financeiro_coletivo_cadastrar_cpf;
            $dependente->save();
        }

        $acomodacao = $request->acomodacao;
        $acomodacao_id = Acomodacao::selectRaw('id')->whereRaw("nome LIKE '%{$acomodacao}%'")->first()->id;
        $data_vigencia = $request->data_vigencia;
        $data_boleto = $request->data_boleto;
        $valor_adesao = str_replace([".",","],["","."],$request->valor_adesao);
        $valor_plano = str_replace([".",","],["","."],$request->valor);

        $contrato = new Contrato();

        $contrato->acomodacao_id = $acomodacao_id;
        $contrato->cliente_id = $cliente->id;
        $contrato->administradora_id = $request->administradora;
        $contrato->tabela_origens_id = $request->tabela_origem;
        $contrato->plano_id = 3;
        $contrato->financeiro_id = 1;
        $contrato->data_vigencia = $data_vigencia;
        $contrato->codigo_externo = $request->codigo_externo_coletivo;
        $contrato->data_boleto = $data_boleto;
        $contrato->valor_adesao = $valor_adesao;
        $contrato->valor_plano = $valor_plano;
        $contrato->coparticipacao = ($request->coparticipacao_coletivo == "sim" ? 1 : 0);
        $contrato->odonto = ($request->odonto_coletivo == "sim" ? 1 : 0);
        $contrato->created_at = $request->created_at;
        $contrato->desconto_corretor = $desconto_corretor;
        $contrato->desconto_corretora = $desconto_corretora;
        $contrato->save();
        $totalVidas = 0;
        $faixas = $request->faixas_etarias;
        foreach($faixas as $k => $v) {
            if($v != 0) {
//                $orcamentoFaixaEtaria = new CotacaoFaixaEtaria();
//                $orcamentoFaixaEtaria->contrato_id = $contrato->id;
//                $orcamentoFaixaEtaria->faixa_etaria_id = $k;
//                $orcamentoFaixaEtaria->quantidade = $v;
//                $orcamentoFaixaEtaria->save();
                $totalVidas += $v;
            }
        }



        $alt = Cliente::where("id",$cliente->id)->first();
        $alt->quantidade_vidas = $totalVidas;
        $alt->save();


        $comissao = new Comissoes();
        $comissao->contrato_id = $contrato->id;
        // $comissao->cliente_id = $contrato->cliente_id;
        $comissao->user_id = $request->usuario_coletivo_switch;
        // $comissao->status = 1;
        $comissao->plano_id = 3;
        $comissao->administradora_id = $request->administradora;
        $comissao->tabela_origens_id = $request->tabela_origem;
        $comissao->data = date('Y-m-d');
        $comissao->save();

        /* Comissao Corretor */
        $comissoes_configuradas_corretor = ComissoesCorretoresConfiguracoes
            ::where("plano_id",3)

            ->where("administradora_id",$request->administradora)
            ->where("user_id",$request->usuario_coletivo_switch)
            ->where("tabela_origens_id",$request->tabela_origem)
            ->get();

        $date = new \DateTime(now());
        $date->add(new \DateInterval('PT1M'));
        $data = $date->format('Y-m-d H:i:s');

        $comissao_corretor_contagem = 0;
        $comissao_corretor_default = 0;

        $ii=0;

        if(count($comissoes_configuradas_corretor) >= 1) {
            foreach($comissoes_configuradas_corretor as $c) {
                $comissaoVendedor = new ComissoesCorretoresLancadas();
                $comissaoVendedor->comissoes_id = $comissao->id;
                //$comissaoVendedor->user_id = auth()->user()->id;
                $comissaoVendedor->parcela = $c->parcela;
                if($comissao_corretor_contagem == 0) {
                    $comissaoVendedor->data = date('Y-m-d H:i:s',strtotime($request->data_vigencia));
                    //$comissaoVendedor->tempo = $data;
                } else {
                    $comissaoVendedor->data = date("Y-m-d H:i:s",strtotime($request->data_vigencia."+{$ii}month"));
                    $date = new \DateTime($data);
                    $date->add(new \DateInterval("PT{$comissao_corretor_contagem}M"));
                    $data_add = $date->format('Y-m-d H:i:s');
                    //$comissaoVendedor->tempo = $data_add;
                    $ii++;
                }
                $comissaoVendedor->valor = ($valor * $c->valor) / 100;
                $comissaoVendedor->save();
                $comissao_corretor_contagem++;
            }
        } else {

            $dados = ComissoesCorretoresDefault
                ::where("plano_id",3)
                ->where('corretora_id',$corretora_id)
                ->where("administradora_id",$request->administradora)
                ->where("tabela_origens_id",2)
                ->get();
            foreach($dados as $c) {
                $comissaoVendedor = new ComissoesCorretoresLancadas();
                $comissaoVendedor->comissoes_id = $comissao->id;
                $comissaoVendedor->parcela = $c->parcela;


                if($comissao_corretor_default == 0) {
                    $comissaoVendedor->data = $data_boleto;
                    //$comissaoVendedor->status_financeiro = 1;
                    if($comissaoVendedor->valor == "0.00" || $comissaoVendedor->valor == 0 || $comissaoVendedor->valor >= 0) {
                        //$comissaoVendedor->status_gerente = 1;
                    }

                } elseif($comissao_corretor_default == 1) {
                    $comissaoVendedor->data = date("Y-m-d H:i:s",strtotime($request->data_vigencia));
                }  else {
                    $mes = $comissao_corretor_default - 1;
                    $comissaoVendedor->data = date("Y-m-d H:i:s",strtotime($request->data_vigencia."+{$mes}month"));
                    //$date = new \DateTime($data);
                    //$date->add(new \DateInterval("PT{$comissao_corretor_default}M"));
                    //$data_add = $date->format('Y-m-d H:i:s');
                }
                $comissaoVendedor->valor = ($valor * $c->valor) / 100;
                $comissaoVendedor->save();
                $comissao_corretor_default++;
            }



        }



        if($request->tipo_financeiro) {
            return "financeiro";
        }



//        if($request->tipo_cadastro == "administrador_cadastro") {
//            return "contratos";
//        } else {
//            return "contrato";
//        }
        //return redirect('admin/contratos?ac=coletivo')->with('success',"Contrato com ".$request->nome." cadastrado com sucesso");
    }

    public function detalhesContratoColetivo($id)
    {

        $contratos = Contrato
            ::where("id",$id)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','comissao.comissoesLancadas','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->first();


        $cliente_id = $contratos->cliente_id;

        $motivo_cancelados = MotivoCancelado::all();
        $status = "";
        $parcela = "";
        if(isset($contratos->comissao->comissaoAtualFinanceiro->parcela) && $contratos->comissao->comissaoAtualFinanceiro->parcela != null) {
            switch($contratos->comissao->comissaoAtualFinanceiro->parcela) {

                case 3:
                    $status = "Pagou Vigencia";
                    break;
                case 4:
                    $status = "Pagou 2º Parcela";
                    break;
                case 5:
                    $status = "Pagou 3º Parcela";
                    break;
                case 6:
                    $status = "Pagou 4º Parcela";
                    break;
                case 7:
                    $status = "Pagou 5º Parcela";
                    break;

            }

            $parcela = $contratos->comissao->comissaoAtualFinanceiro->parcela;
        }

        //$cancelados = $contratos->whereHas('comissao.')


        $cancelados = $contratos->comissao->comissoesLancadas->where("cancelados",1)->count();

        $dependentes = "";


        if(Dependente::where('cliente_id',$cliente_id)->first()) {
            $dependentes = Dependente::where('cliente_id',$cliente_id)->first();
        }





        return view('financeiro.detalhe-coletivo',[
            "dados" => $contratos,
            "motivo_cancelados" => $motivo_cancelados,
            "status" => $status,
            "parcela" => $parcela,
            "cancelados" => $cancelados,
            "dependentes" => $dependentes
        ]);
    }

    public function recalcularColetivo()
    {
        $qtd_coletivo_em_analise = Contrato::where("financeiro_id",1)
            ->where("plano_id",3)
            ->count();

        $qtd_coletivo_emissao_boleto = Contrato::where("financeiro_id",2)
            ->where("plano_id",3)
            ->count();

        $qtd_coletivo_pg_adesao = Contrato::where('financeiro_id',3)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",1);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();


        $qtd_coletivo_pg_vigencia = Contrato::where('financeiro_id',4)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",2);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();



        $qtd_coletivo_02_parcela = Contrato::where('financeiro_id',6)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",3);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_03_parcela = Contrato::where('financeiro_id',7)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",4);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_04_parcela = Contrato::where('financeiro_id',8)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",5);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_05_parcela = Contrato::where('financeiro_id',9)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",6);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_06_parcela = Contrato::where('financeiro_id',10)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",7);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_finalizado = Contrato::where('financeiro_id',11)->where("plano_id",3)->count();
        $qtd_coletivo_cancelado = Contrato::where('financeiro_id',12)->where("plano_id",3)->count();

        return [
            "qtd_coletivo_em_analise" => $qtd_coletivo_em_analise,
            "qtd_coletivo_emissao_boleto" => $qtd_coletivo_emissao_boleto,
            "qtd_coletivo_pg_adesao" => $qtd_coletivo_pg_adesao,
            "qtd_coletivo_pg_vigencia" => $qtd_coletivo_pg_vigencia,
            "qtd_coletivo_02_parcela" => $qtd_coletivo_02_parcela,
            "qtd_coletivo_03_parcela" => $qtd_coletivo_03_parcela,
            "qtd_coletivo_04_parcela" =>  $qtd_coletivo_04_parcela,
            "qtd_coletivo_05_parcela" => $qtd_coletivo_05_parcela,
            "qtd_coletivo_06_parcela" => $qtd_coletivo_06_parcela,
            "qtd_coletivo_finalizado" => $qtd_coletivo_finalizado,
            "qtd_coletivo_cancelado" => $qtd_coletivo_cancelado
        ];
    }

    public function mudarEstadosColetivo(Request $request)
    {

        $id_cliente = $request->id_cliente;
        $id_contrato = $request->id_contrato;
        $contrato = Contrato::find($id_contrato);
        switch ($contrato->financeiro_id) {
            case 1:
                $contrato->financeiro_id = 2;
                break;
            case 2:
                $contrato->financeiro_id = 3;
                break;
            default:
                return "abrir_modal";
                break;
        }
        $contrato->save();
        return $this->recalcularColetivo();
    }

    public function baixaDaData(Request $request)
    {


        $parcela = ComissoesCorretoresLancadas::where("comissoes_id",$request->comissao_id)->where("status_financeiro",0)->where("status_gerente",0)->first()->parcela;
        // $id_cliente = $request->id_cliente;
        $id_contrato = $request->id_contrato;
        $contrato = Contrato::find($id_contrato);

        switch ($parcela) {
            case 1:
                $contrato->financeiro_id = 4;
                $contrato->data_baixa = $request->data_baixa;
                $comissaoCorretor = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",1)
                    ->first();
                if($comissaoCorretor) {
                    $comissaoCorretor->status_financeiro = 1;
                    $comissaoCorretor->data_baixa = $request->data_baixa;
                    $comissaoCorretor->save();
                }

                ComissoesCorretoresLancadas::where("comissoes_id",$request->comissao_id)->where("parcela",2)->update(['atual'=>1]);




                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',1)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }

                break;




            case 2:
                $contrato->financeiro_id = 6;
                $contrato->data_baixa = $request->data_baixa;
                $comissaoCorretor = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",2)
                    ->first();
                if($comissaoCorretor) {
                    $comissaoCorretor->status_financeiro = 1;
                    $comissaoCorretor->data_baixa = $request->data_baixa;
                    $comissaoCorretor->atual = 0;
                    $comissaoCorretor->save();
                }

                ComissoesCorretoresLancadas::where("comissoes_id",$request->comissao_id)->where("parcela",3)->update(['atual'=>1]);

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',2)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }

                break;

            case 3:

                $contrato->financeiro_id = 7;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",3)
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->atual = 0;
                    $comissao->save();
                }

                ComissoesCorretoresLancadas::where("comissoes_id",$request->comissao_id)->where("parcela",4)->update(['atual'=>1]);

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',3)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }
                break;

            case 4:
                $contrato->financeiro_id = 8;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",4)
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->atual = 0;
                    $comissao->save();
                }
                ComissoesCorretoresLancadas::where("comissoes_id",$request->comissao_id)->where("parcela",5)->update(['atual'=>1]);

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',4)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }
                break;

            case 5:
                $contrato->financeiro_id = 9;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",5)
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->atual = 0;
                    $comissao->save();
                }
                ComissoesCorretoresLancadas::where("comissoes_id",$request->comissao_id)->where("parcela",6)->update(['atual'=>1]);

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',5)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }
                break;

            case 6:
                $contrato->financeiro_id = 10;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",6)
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->atual = 0;
                    $comissao->save();
                }

                ComissoesCorretoresLancadas::where("comissoes_id",$request->comissao_id)->where("parcela",7)->update(['atual'=>1]);

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',6)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }
                break;

            case 7:
                $contrato->financeiro_id = 11;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",7)
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->atual = 0;
                    $comissao->save();
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',7)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }

                break;

            // case 10:

            //     //$contrato->financeiro_id = 11;
            //     $contrato->data_baixa = $request->data_baixa;
            //     $comissao = ComissoesCorretoresLancadas
            //         ::where("comissoes_id",$request->comissao_id)
            //         ->where("parcela",7)
            //         ->first();
            //     if($comissao) {
            //         $comissao->status_financeiro = 1;
            //         $comissao->data_baixa = $request->data_baixa;
            //         $comissao->save();
            //     }

            //     $comissaoCorretora = ComissoesCorretoraLancadas
            //         ::where('comissoes_id',$request->comissao_id)
            //         ->where('parcela',7)
            //         ->first();
            //     if(isset($comissaoCorretora) && $comissaoCorretora) {
            //         $comissaoCorretora->status_financeiro = 1;
            //         $comissaoCorretora->data_baixa = $request->data_baixa;
            //         $comissaoCorretora->save();
            //     }




            // break;


            default:
                return "error";
                break;
        }
        $contrato->save();
        return $this->recalcularColetivo();
    }

    public function editarCampoIndividualmente(Request $request)
    {
        $cliente = Cliente::where("id",$request->id_cliente)->first();
        $dependente = Dependentes::where('cliente_id',$request->id_cliente)->first();
        $contrato = Contrato::where("cliente_id",$request->id_cliente)->first();

        switch($request->alvo) {

            case "codigo_externo":
                $contrato->codigo_externo = implode("-",array_reverse(explode("/",$request->valor)));
                $contrato->save();
                break;

            case "data_vigencia":
                $contrato->data_vigencia = implode("-",array_reverse(explode("/",$request->valor)));
                $contrato->save();
                break;

            case "desconto_corretora":
                $contrato->desconto_corretora = str_replace([".",","],["","."],$request->valor);
                $contrato->save();
                break;

            case "desconto_corretor":
                $contrato->desconto_corretor = str_replace([".",","],["","."],$request->valor);
                $contrato->save();
                break;



            case "cliente":

                $cliente->nome = $request->valor;
                $cliente->save();

                break;

            case "data_nascimento":

                $data = implode("-",array_reverse(explode("/",$request->valor)));
                $cliente->data_nascimento = $data;
                $cliente->save();

                break;

            case "cpf":

                $cliente->cpf = $request->valor;
                $cliente->save();

                break;

            case "nome_responsavel":

                if(!$dependente) {

                    $cad = new Dependentes();
                    $cad->cliente_id = $request->id_cliente;
                    $cad->nome = $request->valor;
                    $cad->save();
                } else {
                    $dependente->nome = $request->valor;
                    $dependente->save();
                }

                break;

            case "cpf_responsavel":

                if(!$dependente) {
                    $cad = new Dependentes();
                    $cad->cliente_id = $request->id_cliente;
                    $cad->cpf = $request->valor;
                    $cad->save();
                } else {
                    $dependente->cpf = $request->valor;
                    $dependente->save();
                }

                break;

            case "celular":

                $cliente->celular = $request->valor;
                $cliente->save();

                break;

            case "telefone":

                $cliente->telefone = $request->valor;
                $cliente->save();

                break;

            case "cep":

                $cliente->cep = $request->valor;
                $cliente->save();

                break;


            case "email":

                $cliente->email = $request->valor;
                $cliente->save();

                break;

            case "cidade":

                $cliente->cidade = $request->valor;
                $cliente->save();

                break;

            case "uf":

                $cliente->uf = $request->valor;
                $cliente->save();

                break;

            case "bairro":

                $cliente->bairro = $request->valor;
                $cliente->save();

                break;

            case "rua":

                $cliente->rua = $request->valor;
                $cliente->save();

                break;

            case "complemento":

                $cliente->complemento = $request->valor;
                $cliente->save();

                break;

            default:

                break;

            //$cliente->save();

        }
    }






    public function cancelarContrato(Request $request)
    {
        $contrato_id = Comissoes::where("id", $request->comissao_id_cancelado)->first()->contrato_id;
        $contrato = Contrato::where("id", $contrato_id)->first();
        $comissaoLancadas = ComissoesCorretoresLancadas
            ::where('comissoes_id', $request->comissao_id_cancelado)
            ->where('data_baixa', null)
            ->update(["atual" => 0, "cancelados" => 1]);
        if (!$comissaoLancadas) {
            return "error";
        }
        Contrato::where("id", $contrato->id)->update(['financeiro_id' => 12]);
        return "sucesso";
    }




    public function excluirCliente(Request $request)
    {
        if ($request->ajax()) {
            $id_cliente = $request->id_cliente;
            if ($id_cliente != null) {
                $d = Cliente::where("id", $id_cliente)->delete();
                if ($d) {
                    return $this->recalcularColetivo();
                } else {
                    return "error";
                }
            }
        }

    }



    public function zerarTabelaFinanceiro()
    {
        return [];
    }

    public function coletivoEmGeral(Request $request)
    {

        if ($request->ajax()) {
            $cacheKey = "geralColetivoGeral_" . now()->format('YmdHis');
            $tempoDeExpiracao = 60;
            $dados = Cache::remember($cacheKey, $tempoDeExpiracao, function () {
                return DB::select("
                    SELECT
                        DATE_FORMAT(contratos.created_at,'%d/%m/%Y') as data,
                        (contratos.codigo_externo) as orcamento,
                        users.name as corretor,
                        clientes.nome as cliente,
                        clientes.cpf as cpf,
                        clientes.quantidade_vidas as quantidade_vidas,
                        (contratos.valor_plano) as valor_plano,
                        contratos.id,
                        estagio_financeiros.nome as parcelas,
                        administradoras.nome as administradora,
                        (estagio_financeiros.nome) as status,
                        CASE
                                WHEN comissoes_corretores_lancadas.data < CURDATE() AND estagio_financeiros.id != 10 THEN 'Atrasado'
                            ELSE 'Aprovado'
                        END AS resposta,

                        clientes.data_nascimento as nascimento,
                        clientes.celular as fone,
                        clientes.email as email,
                        clientes.cidade as cidade,
                        clientes.bairro as bairro,
                        clientes.rua as rua,
                        clientes.cep as cep,



                        DATE_FORMAT(comissoes_corretores_lancadas.data,'%d/%m/%Y') as vencimento
                                FROM comissoes_corretores_lancadas
                        INNER JOIN comissoes ON comissoes.id = comissoes_corretores_lancadas.comissoes_id
                        INNER JOIN contratos ON contratos.id = comissoes.contrato_id
                        INNER JOIN clientes ON clientes.id = contratos.cliente_id
                        INNER JOIN users ON users.id = clientes.user_id
                        inner join administradoras on administradoras.id = contratos.administradora_id
                        INNER JOIN estagio_financeiros ON estagio_financeiros.id = contratos.financeiro_id
                        WHERE
                        (status_financeiro = 0 OR (status_financeiro = 1 AND parcela = 7))
                        AND contratos.plano_id = 3
                        GROUP BY contratos.id
                ");
            });
            return response()->json($dados);
        }
    }

    public function listarContratoEmpresaPendentes(Request $request)
    {
        if($request->ajax()) {
            $cacheKey = 'listarContratoEmpresaPendentes';
            $tempoDeExpiracao = 60;
            $resultado = Cache::remember($cacheKey, $tempoDeExpiracao, function () {
                return DB::select("
                SELECT
                date_format(contrato_empresarial.created_at,'%d/%m/%Y') as created_at,
              codigo_externo as codigo_externo,
              users.name as usuario,
              razao_social,
              cnpj,
              quantidade_vidas,
              valor_plano,

              contrato_empresarial.email as email,
              contrato_empresarial.celular as fone,
              contrato_empresarial.cidade as cidade,





              planos.nome as plano,
              date_format(comissoes_corretores_lancadas.`data`,'%d/%m/%Y') AS vencimento,
              estagio_financeiros.nome as status,
              contrato_empresarial.id as id,
              CASE
                  WHEN comissoes_corretores_lancadas.data < CURDATE() AND estagio_financeiros.id != 10 THEN 'Atrasado'
               ELSE 'Aprovado'
               END AS resposta
            FROM comissoes_corretores_lancadas
            INNER JOIN comissoes ON comissoes.id = comissoes_corretores_lancadas.comissoes_id
            INNER JOIN contrato_empresarial ON contrato_empresarial.id = comissoes.contrato_empresarial_id
            INNER JOIN users on users.id = comissoes.user_id
            INNER JOIN planos on planos.id = comissoes.plano_id
            inner join estagio_financeiros on estagio_financeiros.id = contrato_empresarial.financeiro_id
            WHERE comissoes.empresarial = 1 AND (status_financeiro = 0 OR (status_financeiro = 1 AND parcela = 6))
            GROUP BY comissoes_corretores_lancadas.comissoes_id
                ");
            });
            return response()->json($resultado);
        }
    }

    public function sincronizarCancelados(Request $request)
    {
        set_time_limit(300);
        $filename = uniqid() . ".xlsx";
        if (move_uploaded_file($request->file, $filename)) {
            $filePath = base_path("public/{$filename}");
            $cpfs = [];
            $reader = ReaderEntityFactory::createReaderFromFile($filePath);
            $reader->open($filePath);
            $cidade = "";
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $rowNumber => $row) {
                    if($rowNumber > 1) {
                        $cells = $row->getCells();
                        $cart = $cells[1]->getValue();
                        $status = $cells[4]->getValue();
                        $nome = $cells[3]->getValue();

                        if($status == "CANCELADO") {
                            $carteirinha = Cliente
                                ::select('clientes.*')
                                ->join('users','users.id','=','clientes.user_id')
                                ->join('contratos','contratos.cliente_id','=','clientes.id')
                                ->where('clientes.cateirinha',$cart)
                                ->with(['user','contrato','contrato.comissao','contrato.comissao.comissoesLancadas'])
                                ->first();

                            if($carteirinha) {
                                $c = Contrato::find($carteirinha->contrato->id);
                                $c->financeiro_id = 12;
                                $c->save();
                            }

                        }



//                        $nome = $cells[7]->getValue();
//                        $codi = $cells[4]->getValue();
//                        $carteirinha = Cliente
//                            ::select('clientes.*')
//                            ->join('users','users.id','=','clientes.user_id')
//                            ->join('contratos','contratos.cliente_id','=','clientes.id')
//                            ->where('clientes.nome','like',$nome)
//                            ->where('users.codigo_vendedor',$codi)
//                            ->with(['user','contrato','contrato.comissao','contrato.comissao.comissoesLancadas'])
//                            ->first();
//
//                        if($carteirinha && $carteirinha->cateirinha == null) {
//                            $carteirinha->cateirinha = $cells[5]->getValue();
//                            $carteirinha->save();
//                            $cc = Contrato::find($carteirinha->contrato->id);
//                            $cc->created_at = $cells[6]->getValue()->format('Y-m-d');
//                            $cc->save();
//                        } else {
//                        }

                        /*
                        //Realizar Baixas
                        if($carteirinha && $cells[11]->getValue() == "LIQUIDADO") {
                            $cliente = Cliente::select('clientes.*')
                                ->join('users', 'users.id', '=', 'clientes.user_id')
                                ->where('clientes.nome','like',$nome)
                                //->where('clientes.cateirinha',$cells[7]->getValue())
                                ->where('users.codigo_vendedor',$codi)
                                ->with(['user', 'contrato','contrato.comissao','contrato.comissao.comissoesLancadas'])
                                ->first();
                        }
                        */


                    }
                }
            }
            return "sucesso";
        }
    }

    public function atualizarDados(Request $request)
    {
        $clientes = Cliente::with('contrato')->where("dados",0)->whereRaw("baixa IS NULL")
            ->chunkById(50,function($clientes) {
                foreach($clientes as $v) {
                    $url = "https://api-hapvida.sensedia.com/DESATIVADO_/wssrvonline/v1/beneficiario?cpf=$v->cpf";
                    $ch = curl_init($url);
                    curl_setopt($ch,CURLOPT_URL,$url);
                    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                    $resultado = (array) json_decode(curl_exec($ch),true);
                    foreach($resultado as $rr) {
                        if($rr['tipoPlanoC'] == "SAUDE" AND $rr['nomeEmpresa'] == "I N D I V I D U A L" AND $rr['nuMatriculaEmpresa'] == $v->codigo_externo) {
                            $cliente = Cliente::where("codigo_externo",$v->codigo_externo)->first();
                            $cliente->cidade = mb_convert_case($rr['cidadeEndereco'], MB_CASE_TITLE, "UTF-8");
                            $cliente->cep = $rr['cepEndereco'];
                            $cliente->rua = $rr['ruaEndereco'];
                            $cliente->bairro =  mb_convert_case($rr['bairroEndereco'], MB_CASE_TITLE, "UTF-8");
                            $cliente->complemento = ($rr['complementoEndereco'] != null ? mb_convert_case($rr['complementoEndereco'], MB_CASE_TITLE, "UTF-8") : null);
                            $cliente->uf = $rr['ufEndereco'];
                            $cliente->pessoa_fisica = 1;
                            $cliente->pessoa_juridica = 0;
                            $cliente->nm_plano = $rr['nmPlano'];
                            $cliente->numero_registro_plano = $rr['nuRegistroPlano'];
                            $cliente->rede_plano = $rr['redePlano'];
                            $cliente->tipo_acomodacao_plano = $rr['tipoAcomodacaoPlano'];
                            $cliente->segmentacao_plano = $rr['segmentacaoPlano'];
                            $cliente->cateirinha = $rr['cdUsuario'];
                            $cliente->save();
                        }
                    }
                }
            });

        Cliente::where("dados",0)->update(["dados"=>1]);
        //Cliente::whereRaw("baixa IS NULL")->update(["baixa"=>date('Y-m-d')]);

        return "sucesso";
    }

    public function sincronizarBaixas(Request $request)
    {
        Cliente::where("dados",1)->whereRaw("baixa IS NULL")
            ->chunkById(50,function($clientes) {
                foreach($clientes as $cc) {
                    $contrato = Contrato::where('cliente_id',$cc->id)->first()->id;
                    $comissao_id = Comissoes::where("contrato_id",$contrato)->first()->id;
                    ComissoesCorretoresLancadas::where("comissoes_id",$comissao_id)->update(['documento_gerador'=>substr($cc->cateirinha,0,-3)]);
                    $url = "https://api-hapvida.sensedia.com/DESATIVADO_/wssrvonline/v1/beneficiario/$cc->cateirinha/financeiro/historico";
                    $curl = curl_init($url);
                    curl_setopt($curl,CURLOPT_URL, $url);
                    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
                    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
                    $resp=curl_exec($curl);
                    curl_close($curl);
                    $dados=json_decode($resp);
                    $data="";
                    $docu="";
                    if(!empty($dados) && $dados != null) {
                        foreach($dados as $d) {
                            if($d->dtPagamento != null && $d->cdStatus != 16) {
                                // $data = implode("-",array_reverse(explode('/',$d->dtVencimento)));
                                $mes = explode("/",$d->dtVencimento);
                                $data_baixa = implode("-",array_reverse(explode('/',$d->dtPagamento)));
                                $docu = $d->cdDocumentoGerador;
                                ComissoesCorretoresLancadas
                                    ::whereRaw("DATE_FORMAT(data,'%m') = ?",$mes[1])
                                    ->where("documento_gerador",$docu)
                                    ->where("status_financeiro","!=",1)
                                    ->update([
                                        'status_financeiro'=>1,
                                        'valor_pago' => $d->vlObrigacao,
                                        'data_baixa'=>$data_baixa
                                    ]);

                                ComissoesCorretoraLancadas
                                    ::whereRaw("DATE_FORMAT(data,'%m') = ?",$mes[1])
                                    ->where("comissoes_id",$comissao_id)
                                    ->where("status_financeiro","!=",1)
                                    ->update(['status_financeiro'=>1]);
                            }

                            if($d->cdStatus == 8 && $d->dsStatus == "CANCELADO") {
                                $canc = new ComissoesCorretoresCancelados();
                                $canc->comissoes_id = $comissao_id;
                                $canc->data = implode("-",array_reverse(explode('/',$d->dtVencimento)));
                                $canc->documento_gerador = $d->cdDocumentoGerador;
                                $canc->save();
                            }


                        }
                    }

                }

            });


        $comissoes = ComissoesCorretoresLancadas
            ::where("status_financeiro",1)
            //->where("status_gerente",1)
            ->where("parcela","!=",1)
            //->where("comissoes_id",$comissoes>id)

            ->get();
        foreach($comissoes as $cc) {

            switch($cc->parcela) {
                case 2:
                    $contrato_id = Comissoes::where("id",$cc->comissoes_id)->first()->contrato_id;
                    Contrato::where("id",$contrato_id)->update([
                        "financeiro_id" => 6
                    ]);

                    break;

                case 3:
                    $contrato_id = Comissoes::where("id",$cc->comissoes_id)->first()->contrato_id;
                    Contrato::where("id",$contrato_id)->update([
                        "financeiro_id" => 7
                    ]);
                    break;

                case 4:
                    $contrato_id = Comissoes::where("id",$cc->comissoes_id)->first()->contrato_id;
                    Contrato::where("id",$contrato_id)->update([
                        "financeiro_id" => 8
                    ]);
                    break;

                case 5:
                    $contrato_id = Comissoes::where("id",$cc->comissoes_id)->first()->contrato_id;
                    Contrato::where("id",$contrato_id)->update([
                        "financeiro_id" => 9
                    ]);
                    break;

                case 6:
                    $contrato_id = Comissoes::where("id",$cc->comissoes_id)->first()->contrato_id;
                    Contrato::where("id",$contrato_id)->update([
                        "financeiro_id" => 10
                    ]);
                    break;

                default:
                    $contrato_id = Comissoes::where("id",$cc->comissoes_id)->first()->contrato_id;
                    Contrato::where("id",$contrato_id)->update([
                        "financeiro_id" => 11
                    ]);
                    break;
            }
        }

        $dados = DB::select('
            SELECT * FROM comissoes_corretores_cancelados
            INNER JOIN comissoes_corretores_lancadas ON
            comissoes_corretores_cancelados.documento_gerador = comissoes_corretores_lancadas.documento_gerador
            WHERE MONTH(comissoes_corretores_lancadas.`data`) = MONTH(comissoes_corretores_cancelados.data)
            AND valor_pago IS NULL
            GROUP BY comissoes_corretores_cancelados.documento_gerador
        ');

        foreach($dados as $d) {
            $contrato_id = Comissoes::where("id",$d->comissoes_id)->first()->contrato_id;
            Contrato::where("id",$contrato_id)->update(["financeiro_id"=>12]);
        }

        $canc = DB::select("
            SELECT * FROM comissoes_corretores_cancelados
            INNER JOIN comissoes_corretores_lancadas ON
            comissoes_corretores_cancelados.documento_gerador = comissoes_corretores_lancadas.documento_gerador
            WHERE MONTH(comissoes_corretores_lancadas.`data`) = MONTH(comissoes_corretores_cancelados.data)
            AND valor_pago IS NULL AND comissoes_corretores_lancadas.`data` >= DATE(NOW() - INTERVAL 6 MONTH)
            GROUP BY comissoes_corretores_cancelados.documento_gerador
        ");

        foreach($canc as $c) {
            DB::table('comissoes_corretores_lancadas')
                ->where("id","=",$c->id)
                ->whereRaw("data_baixa IS NULL")
                ->update(['cancelados'=>1]);
        }

        Cliente::whereRaw("baixa IS NULL")->update(["baixa"=>date('Y-m-d')]);


        return "sucesso";
    }

    public function sincronizarDadosColetivo(Request $request)
    {

        $filename = uniqid() . ".xlsx";
        if (move_uploaded_file($request->file, $filename)) {
            $filePath = base_path("public/{$filename}");
            $reader = ReaderEntityFactory::createReaderFromFile($filePath);
            $reader->open($filePath);
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $rowNumber => $row) {
                    $cells = $row->getCells();
                    if ($rowNumber >= 2) {

                        $tabela_origens_id = TabelaOrigens::where("nome", "LIKE", $cells[3]->getValue())->first()->id;
                        $administradora_id = Administradoras::where("nome", "LIKE", $cells[2]->getValue())->first()->id;


                        $user_id = cidadeCodigoVendedor::where("codigo_vendedor", $cells[0]->getValue())
                            ->where("tabela_origens_id", $tabela_origens_id)
                            ->first()
                            ->user_id;


                        $cpf = mb_strlen($cells[6]->getValue()) == 11 ? $cells[6]->getValue() : str_pad($cells[6]->getValue(), 11, "000", STR_PAD_LEFT);
                        //$user_id = User::where('codigo_vendedor', $cells[0]->getValue())->first()->id;

                        $nascimento = $cells[9]->getValue()->format('Y-m-d');
                        $criacao = $cells[18]->getValue()->format('Y-m-d');

                        $alvo = trim($cells[21]->getValue());
                        $id_acomodacao = Acomodacao::where("nome", "LIKE", "%$alvo%")->first()->id;
                        $cliente = new Cliente();
                        $cliente->user_id = $user_id;
                        $cliente->nome = mb_convert_case($cells[4]->getValue(), MB_CASE_TITLE, "UTF-8");
                        $cliente->celular = $cells[11]->getValue();
                        $cliente->cpf = $cpf;
                        $cliente->data_nascimento = $nascimento;
                        $cliente->pessoa_fisica = 1;
                        $cliente->pessoa_juridica = 0;
                        $cliente->codigo_externo = $cells[5]->getValue();
                        $cliente->cep = $cells[12]->getValue();
                        $cliente->cidade = $cells[13]->getValue();
                        $cliente->bairro = $cells[14]->getValue();
                        $cliente->rua = $cells[15]->getValue();
                        $cliente->complemento = $cells[16]->getValue();
                        $cliente->uf = $cells[17]->getValue();

                        $cliente->created_at = $criacao;
                        $cliente->quantidade_vidas = $cells[25]->getValue();
                        $cliente->email = mb_convert_case($cells[10]->getValue(), MB_CASE_LOWER, "UTF-8");
                        $cliente->save();

                        if (!empty($cells[7]->getValue()) && $cells[7]->getValue() != null) {
                            $dependente = new Dependentes();
                            $cpf_responsavel = mb_strlen($cells[8]->getValue()) == 11 ? $cells[8]->getValue() : str_pad($cells[8]->getValue(), 11, "000", STR_PAD_LEFT);
                            $dependente->cliente_id = $cliente->id;
                            $dependente->nome = mb_convert_case($cells[7]->getValue(), MB_CASE_TITLE, "UTF-8");
                            $dependente->cpf = $cpf_responsavel;
                            $dependente->save();
                        }


                        $coparticipacao = 0;
                        if ($cells[22]->getValue() == 1 && $cells[23]->getValue() == 0) {
                            $coparticipacao = 1;
                        } else if ($cells[22]->getValue() == 0 && $cells[23]->getValue() == 1) {
                            $coparticipacao = 0;
                        } else {
                            $coparticipacao = 0;
                        }


                        $contrato = new Contrato();
                        $contrato->acomodacao_id = $id_acomodacao;
                        $contrato->cliente_id = $cliente->id;
                        $contrato->administradora_id = $administradora_id;
                        $contrato->tabela_origens_id = $tabela_origens_id;
                        $contrato->plano_id = 3;
                        $contrato->financeiro_id = 1;
                        $contrato->data_vigencia = $cells[19]->getValue()->format('Y-m-d');
                        $contrato->codigo_externo = $cells[5]->getValue();
                        // $contrato->data_boleto = implode("-",array_reverse(explode("/",$cells[21]->getValue())));
                        $contrato->data_boleto = $cells[20]->getValue()->format('Y-m-d');
                        $contrato->valor_adesao = empty($cells[27]->getValue()) && $cells[27]->getValue() == null ? $cells[27]->getValue() : $cells[27]->getValue();
                        $contrato->valor_plano = $cells[26]->getValue();
                        $contrato->coparticipacao = $coparticipacao;
                        $contrato->odonto = $cells[24];
                        $contrato->created_at = $cells[18]->getValue()->format('Y-m-d');
                        $contrato->desconto_corretor = "0,00";
                        $contrato->desconto_corretora = "0,00";
                        $contrato->save();

                        $comissao = new Comissoes();
                        $comissao->contrato_id = $contrato->id;
                        // $comissao->cliente_id = $contrato->cliente_id;
                        $comissao->user_id = $user_id;
                        // $comissao->status = 1;
                        $comissao->plano_id = 3;
                        $comissao->administradora_id = $administradora_id;
                        $comissao->tabela_origens_id = $tabela_origens_id;
                        $comissao->data = date('Y-m-d');
                        $comissao->save();

                        /* Comissao Corretor */
                        $comissoes_configuradas_corretor = ComissoesCorretoresConfiguracoes
                            ::where("plano_id", 3)
                            ->where("administradora_id", $administradora_id)
                            ->where("user_id", $user_id)
                            //->where("tabela_origens_id", $tabela_origens_id)
                            ->get();
                        $data_vigencia = $cells[19]->getValue()->format('Y-m-d');
                        $comissao_corretor_contagem = 0;
                        $comissao_corretor_default = 0;
                        if (count($comissoes_configuradas_corretor) >= 1) {
                            foreach ($comissoes_configuradas_corretor as $c) {
                                $comissaoVendedor = new ComissoesCorretoresLancadas();
                                $comissaoVendedor->comissoes_id = $comissao->id;
                                //$comissaoVendedor->user_id = auth()->user()->id;
                                $comissaoVendedor->parcela = $c->parcela;
                                if ($comissao_corretor_contagem == 0) {
                                    $comissaoVendedor->data = $cells[20]->getValue()->format('Y-m-d');
                                    //$comissaoVendedor->status_financeiro = 1;
                                    if ($comissaoVendedor->valor == "0.00" || $comissaoVendedor->valor == 0 || $comissaoVendedor->valor >= 0) {
                                        //$comissaoVendedor->status_gerente = 1;
                                    }

                                } elseif ($comissao_corretor_contagem == 1) {
                                    $comissaoVendedor->data = date("Y-m-d H:i:s", strtotime($data_vigencia));
                                } else {
                                    $mes = $comissao_corretor_contagem - 1;
                                    $comissaoVendedor->data = date("Y-m-d H:i:s", strtotime($data_vigencia . "+{$mes}month"));

                                }
                                $comissaoVendedor->valor = ($cells[27]->getValue() * $c->valor) / 100;
                                $comissaoVendedor->save();
                                $comissao_corretor_contagem++;
                            }
                        } else {

                            $dados = ComissoesCorretoresDefault
                                ::where("plano_id", 3)
                                ->where("administradora_id", $administradora_id)
                                ->where("tabela_origens_id", $tabela_origens_id)
                                ->get();
                            foreach ($dados as $c) {
                                $comissaoVendedor = new ComissoesCorretoresLancadas();
                                $comissaoVendedor->comissoes_id = $comissao->id;
                                $comissaoVendedor->parcela = $c->parcela;


                                if ($comissao_corretor_default == 0) {
                                    $comissaoVendedor->data = $cells[20]->getValue()->format('Y-m-d');
                                    //$comissaoVendedor->status_financeiro = 1;
                                    if ($comissaoVendedor->valor == "0.00" || $comissaoVendedor->valor == 0 || $comissaoVendedor->valor >= 0) {
                                        //$comissaoVendedor->status_gerente = 1;
                                    }

                                } elseif ($comissao_corretor_default == 1) {
                                    $comissaoVendedor->data = date("Y-m-d H:i:s", strtotime($data_vigencia));
                                } else {
                                    $mes = $comissao_corretor_default - 1;
                                    $comissaoVendedor->data = date("Y-m-d H:i:s", strtotime($data_vigencia . "+{$mes}month"));

                                }
                                $comissaoVendedor->valor = ($cells[27]->getValue() * $c->valor) / 100;
                                $comissaoVendedor->save();
                                $comissao_corretor_default++;
                            }
                        }

                        $comissoes_configurada_corretora = ComissoesCorretoraConfiguracoes
                            ::where("administradora_id", $administradora_id)
                            ->where('plano_id', 3)
                            ->where('tabela_origens_id', $tabela_origens_id)
                            ->get();

                        $comissoes_corretora_contagem = 0;
                        if (count($comissoes_configurada_corretora) >= 1) {
                            foreach ($comissoes_configurada_corretora as $cc) {
                                $comissaoCorretoraLancadas = new ComissoesCorretoraLancadas();
                                $comissaoCorretoraLancadas->comissoes_id = $comissao->id;
                                $comissaoCorretoraLancadas->parcela = $cc->parcela;
                                if ($comissoes_corretora_contagem == 0) {
                                    $comissaoCorretoraLancadas->data = $data_vigencia;

                                    // } else if($comissoes_corretora_contagem == 1) {
                                    //     $comissaoCorretoraLancadas->data = date("Y-m-d H:i:s",strtotime($data_vigencia));
                                    // } else {
                                    //     $mes = $comissoes_corretora_contagem - 1;
                                    //     $comissaoCorretoraLancadas->data = date("Y-m-d",strtotime($data_vigencia."+{$mes}month"));
                                } else {
                                    $comissaoCorretoraLancadas->data = date("Y-m-d", strtotime($data_vigencia . "+{$comissoes_corretora_contagem}month"));
                                }
                                $comissaoCorretoraLancadas->valor = ($cells[27]->getValue() * $cc->valor) / 100;
                                $comissaoCorretoraLancadas->save();
                                $comissoes_corretora_contagem++;
                            }
                        }


                    }
                }
            }


            return "sucesso";
        }
    }








}
