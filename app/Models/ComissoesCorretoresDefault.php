<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComissoesCorretoresDefault extends Model
{
    use HasFactory;
    protected $table = "comissoes_corretores_default";

    public function planos()
    {
        return $this->belongsTo(Plano::class,'plano_id','id');
    }

    public function administradoras()
    {
        return $this->belongsTo(Administradora::class,'administradora_id','id');
    }

    public function cidades()
    {
        return $this->belongsTo(TabelaOrigens::class,'tabela_origens_id','id');
    }


}
