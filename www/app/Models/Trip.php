<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'cidade',
        'pais',
        'informacao',
        'data_partida',
        'data_chegada',
        'preco',
        'quantidade_disponivel'
    ];
    

    public function sugests() {
        return $this->hasMany(Sugest::class);
    }

    public function reservs(){
        return $this->hasMany(Reserv::class);
    }

}   
