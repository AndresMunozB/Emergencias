<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $table = 'entidades';

    protected $fillable = [
        'nombre', 'tipo',
    ];

    public function miembros() {
        return $this->belongsToMany('App\User');
    }
}
