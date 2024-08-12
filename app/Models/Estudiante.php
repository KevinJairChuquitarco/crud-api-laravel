<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    //Con éste atributo le digo que mi tabla se va a llamar estudiante
    protected $table = "estudiante";
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'lenguaje'
    ];
}
