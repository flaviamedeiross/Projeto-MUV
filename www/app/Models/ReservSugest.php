<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservSugest extends Model
{
    use HasFactory;
    protected $table = 'reserv_sugests';
    protected $fillable = ['reserv_id', 'sugest_id'];
}
