<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoEmpresarial extends Model
{
    use HasFactory;
    protected $table = 'contrato_empresarial';




    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comissao()
    {
        return $this->hasOne(Comissoes::class);
    }

    public function financeiro()
    {

        return $this->belongsTo(EstagioFinanceiro::class,'financeiro_id','id');
    }

}
