<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Cliente extends Authenticatable
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = ['nome', 'cep', 'endereco','bairro','cidade','estado','telefone'];

    public function user()
    {
        return $this->hasOne(User::class, 'cliente_id');
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'client_trip');
    }

    public function sugests()
    {
        return $this->belongsToMany(Sugest::class, 'cliente_sugest');
    }

    public function reservs()
    {
        return $this->hasMany(Reserv::class, 'cliente_id');
    }

}

