<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugest extends Model
{
    use HasFactory;

    protected $table = 'sugests';
    protected $fillable = ['nome', 'descricao', 'interesse', 'trip_id'];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function reserv() {
        return $this->belongsToMany(Cliente::class, 'cliente_id');
    }
}




