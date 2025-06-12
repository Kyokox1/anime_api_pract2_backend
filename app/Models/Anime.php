<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = [
        "nombre",
        "sinopsis",
        "año",
        "genero",
        "estado"
    ];

    public function personajes(){
        return $this->hasMany(Personaje::class);
    }
}
