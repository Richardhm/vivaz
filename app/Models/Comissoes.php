<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comissoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'plano_id',
        'user_id',
        'administradora_id',
        'tabela_origens_id',
        'contrato_id',
        'contrato_empresarial_id',
        'empresarial'
    ];

    public function comissaoAtualFinanceiro()
    {
        return $this->hasOne(ComissoesCorretoresLancadas::class)->where('status_financeiro',0)->where('status_gerente',0);
    }

    public function comissoesLancadas()
    {
        return $this->hasMany(ComissoesCorretoresLancadas::class)->selectRaw("
            id,
            comissoes_id,
            parcela,
            data,
            valor,
            status_financeiro,
            status_gerente,
            data_baixa,
            data_baixa_gerente,
            valor_pago,
            cancelados,
            if(DATEDIFF(data_baixa,DATA) >= 1,DATEDIFF(data_baixa,DATA),0) AS quantidade_dias
            ");
    }


}
