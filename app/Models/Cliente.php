<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dependentes()
    {

        return $this->hasMany(Dependente::class);
    }

    public function contrato()
    {
        return $this->hasOne(Contrato::class);
    }

}
