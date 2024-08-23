<?php

namespace App\Http\Controllers;

use App\Models\Administradora;
use App\Models\Plano;
use App\Models\Tabela;
use App\Models\TabelaOrigens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $cidades = TabelaOrigens::all();
        $administradoras = Administradora::all();
        $planos = Plano::all();

        return view('dashboard', compact('cidades', 'administradoras','planos'));
    }

    public function buscar_planos(Request $request)
    {
        $administradora_id = $request->input('administradora_id');
        $planos = DB::table('administradora_planos')
            ->where('administradora_id', $administradora_id)
            ->pluck('plano_id');

        return response()->json(['planos' => $planos]);
    }

    public function orcamento(Request $request)
    {
        $dados = request()->all();

        $sql = "";
        $chaves = [];
        foreach(request()->faixas[0] as $k => $v) {
            if($v != null AND $v != 0) {
                $sql .= " WHEN tabelas.faixa_etaria_id = {$k} THEN ${v} ";
                $chaves[] = $k;
            }
        }
        $keys = implode(",",$chaves);



        $cidade = request()->tabela_origem;
        $plano = request()->plano;
        $operadora = request()->operadora;

        $imagem_operadora = Administradora::find($operadora)->logo;

        $plano_nome = Plano::find($plano)->nome;
        $imagem_plano = Administradora::find($operadora)->logo;
        $cidade_nome = TabelaOrigens::find($cidade)->nome;

        $dados = Tabela::select('tabelas.*')
            ->selectRaw("CASE $sql END AS quantidade")
            ->join('faixa_etarias', 'faixa_etarias.id', '=', 'tabelas.faixa_etaria_id')
            ->where('tabelas.tabela_origens_id', $cidade)
            ->where('tabelas.plano_id', $plano)
            ->where('tabelas.administradora_id', $operadora)
            //->where('acomodacao_id',"!=",3)
            ->whereIn('tabelas.faixa_etaria_id', explode(',', $keys))
            ->get();
        $status = $dados->contains('odonto', 0);


        return view("cotacao.cotacao2",[
            "dados" => $dados,
            "operadora" => $imagem_operadora,
            "plano_nome" => $plano_nome,
            "cidade_nome" => $cidade_nome,
            "imagem_plano" => $imagem_plano,
            "status" => $status
        ]);

    }



}
