<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoCancelado extends Model
{
    use HasFactory;

    protected $table = 'motivo_cancelados';

    protected $fillable = ['nome'];

}
