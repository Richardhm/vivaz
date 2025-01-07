<?php

namespace App\Jobs;

use App\Models\FolhaMes;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\ComissoesCorretoresLancadas;
use App\Models\ValoresCorretoresLancados;
use App\Models\FolhaPagamento;


class ProcessarPagamentoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dados;

    /**
     * Create a new job instance.
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Extrai dados recebidos
        $id = $this->dados['id'];
        $user_id = $this->dados['user_id'];
        $mes = $this->dados['mes'];
        $ano = $this->dados['ano'];
        $comissao = $this->dados['comissao'];
        $salario = $this->dados['salario'];
        $premiacao = $this->dados['premiacao'];
        $total = $this->dados['total'];
        $desconto = $this->dados['desconto'];
        $estorno = $this->dados['estorno'];

        $data_comissao = date($ano."-".$mes."-01");

        // Atualiza a comissão do corretor
        $co = ComissoesCorretoresLancadas::find($id);
        $co->status_apto_pagar = 1;
        $co->status_comissao = 1;
        $co->finalizado = 1;
        $co->data_baixa_finalizado = $data_comissao;
        $co->save();

        // Processa ou atualiza os valores
        $va = ValoresCorretoresLancados::where("user_id", $user_id)
            ->whereMonth('data', $mes)
            ->whereYear('data', $ano);

        if (!$va->exists()) {
            $va = new ValoresCorretoresLancados();
            $va->user_id = $user_id;
            $va->valor_comissao = $comissao;
            $va->valor_salario = $salario;
            $va->valor_premiacao = $premiacao;
            $va->valor_total = $total;
            $va->valor_desconto = $desconto;
            $va->valor_estorno = $estorno;
            $va->data = $data_comissao;
            $va->save();
            $id_folha_mes = FolhaMes::whereMonth("mes",$mes)->where("corretora_id",auth()->user()->corretora_id)->whereYear("mes",$ano)->first()->id;
            // Cria registro na folha de pagamento
            $folha = new FolhaPagamento();
            $folha->folha_mes_id = $id_folha_mes; // Substitua pelo id correto
            $folha->valores_corretores_lancados_id = $va->id;
            $folha->save();
        } else {
            $alt = $va->first();
            $alt->update([
                'valor_comissao' => $comissao,
                'valor_salario' => $salario,
                'valor_premiacao' => $premiacao,
                'valor_total' => $total,
                'valor_desconto' => $desconto,
                'valor_estorno' => $estorno,
            ]);
        }
    }
}
