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
        $cidade = request()->tabela_origem;
        $plano = request()->plano;
        $operadora = request()->operadora;
        $odonto = request()->odonto;
        $sql = "";
        $chaves = [];
        foreach(request()->faixas[0] as $k => $v) {
            if($v != null AND $v != 0) {
                $sql .= " WHEN tabelas.faixa_etaria_id = {$k} THEN ${v} ";
                $chaves[] = $k;
            }
        }
        $cidade_nome = TabelaOrigens::find($cidade)->nome;
        $plano_nome = Plano::find($plano)->nome;

        $admin_nome = Administradora::find($operadora)->nome;

        $odonto_frase = $odonto == 1 ? " c/odonto" : " s/odonto";
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
