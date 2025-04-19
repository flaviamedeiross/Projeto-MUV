<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserv extends Model
{
    use HasFactory;

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function trip(){
        return $this->belongsTo(Trip::class);
    }

    public function sugests(){
        return $this->belongsToMany(Sugest::class, 'reserv_sugests');
    }
}
