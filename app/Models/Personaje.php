<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{
     protected $fillable = [
        'nombre',
        'descripcion',
        'rol',
        'anime_id'
    ];
    public function anime(){
        return $this->belongsTo(Anime::class);
    }
}
