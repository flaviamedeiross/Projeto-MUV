<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animais';
    protected $fillable = ['nome', 'especie', 'descricao', 'paciente_id'];

    // Relacionamento com Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function consulta()
    {
        return $this->hasMany(Consulta::class, 'paciente_id');
    }
}




