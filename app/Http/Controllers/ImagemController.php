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
        $linhas = 0;



        foreach(request()->faixas[0] as $k => $v) {
            if($v != null AND $v != 0) {

                $sql .= " WHEN tabelas.faixa_etaria_id = {$k} THEN ${v} ";
                $chaves[] = $k;
            }
        }
        $linhas = count($chaves);

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
            ->where('tabela_origens_id',$cidade)
            ->exists();
        if ($hasTabelaOrigens) {
            $pdf_copar = Pdf::where('plano_id', $plano)
                ->where('tabela_origens_id',$cidade)
                ->first();
        } else {
            $pdf_copar = Pdf::where('plano_id', $plano)->first();
        }
        $image_user = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path(auth()->user()->image)));
        $nome = auth()->user()->name;
        $celular = auth()->user()->celular;
        $corretora = auth()->user()->corretora_id;
        $status_carencia = request()->status_carencia == "true" ? 1 : 0;
        $view = \Illuminate\Support\Facades\View::make("cotacao.cotacao3",[
           'image' => $image_user,
           'dados' => $dados,
           'pdf' => $pdf_copar,
           'nome' => $nome,
           'cidade' => $cidade_nome,
           'plano' => $plano_nome,
           'administradora' => $admin_nome,
           'frase' => $frase,
           'status_carencia' => $status_carencia,
           'odonto' => $odonto,
           'celular' => $celular,
           'linhas' => $linhas,
           'corretora' => $corretora
        ]);
        $pdf = PDFFile::loadHTML($view);
        return $pdf->stream("teste.pdf");


    }
}
