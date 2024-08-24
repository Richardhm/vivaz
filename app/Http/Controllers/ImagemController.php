<?php

namespace App\Http\Controllers;

use App\Models\Administradora;
use App\Models\Pdf;
use App\Models\Plano;
use App\Models\Tabela;
use App\Models\TabelaOrigens;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDFFile;
class ImagemController extends Controller
{
    public function criarPDF()
    {
        $faixas = [

                '1' => 1,
                            '2' => 1,
                            '3' => 1,
                            '4' => 1,
                            '5' => 1,
                            '6' => 1,
                            '7' => 1,
                            '8' => 0,
                            '9' => 0,
                            '10' =>0

                   ];
//        $cidade = request()->tabela_origem;
//        $plano = request()->plano;
//        $operadora = request()->operadora;
//        $odonto = request()->odonto;
        $cidade = 2;
        $plano = 1;
        $operadora = 4;
        $odonto = 1;
        $sql = "";
        $chaves = [];
        foreach($faixas as $k => $v) {
            if($v != null AND $v != 0) {
                $sql .= " WHEN tabelas.faixa_etaria_id = {$k} THEN ${v} ";
                $chaves[] = $k;
            }
        }
        $cidade_nome = TabelaOrigens::find($cidade)->nome;
        $plano_nome = Plano::find($plano)->nome;

        $admin_nome = Administradora::find($operadora)->nome;

        $odonto_frase = $odonto == 1 ? " c/ Odonto" : " s/ Odonto";
        $frase = $plano_nome.$odonto_frase;

        $keys = implode(",",$chaves);
        $dados = Tabela::select('tabelas.*')
            ->selectRaw("CASE $sql END AS quantidade")
            ->join('faixa_etarias', 'faixa_etarias.id', '=', 'tabelas.faixa_etaria_id')
            ->where('tabelas.tabela_origens_id', $cidade)
            ->where('tabelas.plano_id', $plano)
            ->where('tabelas.administradora_id', $operadora)
            ->where("tabelas.odonto",$odonto)
            ->where("acomodacao_id","!=",3)
            ->whereIn('tabelas.faixa_etaria_id', explode(',', $keys))
            ->get();

        $hasTabelaOrigens = Pdf::where('plano_id', $plano)
            ->whereNotNull('tabela_origens_id')
            ->exists();
        if ($hasTabelaOrigens) {
            $pdf_copar = Pdf::where('plano_id', $plano)
                ->whereNotNull('tabela_origens_id')
                ->first();
        } else {
            $pdf_copar = Pdf::where('plano_id', $plano)->first();
        }

        $image_user = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path(auth()->user()->image)));
        $nome = auth()->user()->name;


        $view = \Illuminate\Support\Facades\View::make("cotacao.cotacao3",[
           'image' => $image_user,
           'dados' => $dados,
           'pdf' => $pdf_copar,
           'nome' => $nome,
           'cidade' => $cidade_nome,
           'plano' => $plano_nome,
           'administradora' => $admin_nome,
           'frase' => $frase
        ]);
        $pdf = PDFFile::loadHTML($view);
        return $pdf->stream("teste.pdf");


    }
}
