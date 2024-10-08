<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabela extends Model
{
    use HasFactory;
    public function faixaEtaria()
    {
        return $this->belongsTo(FaixaEtaria::class);
    }
}
