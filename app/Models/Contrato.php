<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    public function administradora()
    {
        return $this->belongsTo(Administradora::class);
    }

    public function financeiro()
    {
        return $this->belongsTo(EstagioFinanceiro::class,'financeiro_id','id');
    }

    public function cidade()
    {
        return $this->belongsTo(TabelaOrigens::class,'tabela_origens_id','id');
    }

    public function acomodacao()
    {
        return $this->belongsTo(Acomodacao::class);
    }

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }

    public function clientes()
    {
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }

    public function comissao()
    {
        return $this->hasOne(Comissoes::class);
    }






}
