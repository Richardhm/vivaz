<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\UserACLTrait;
class User extends Authenticatable
{
    use HasFactory, Notifiable,UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'user_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function comissoesValoresCorretores()
    {
        return $this->hasMany(ValoresCorretoresLancados::class);
    }

    public function comissoes()
    {
        return $this->hasMany(Comissoes::class);
    }

    public function comissoesConfig()
    {
        return $this->hasMany(ComissoesCorretoresConfiguracoes::class);
    }



}
