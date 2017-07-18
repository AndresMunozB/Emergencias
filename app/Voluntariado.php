<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voluntariado extends Model
{
    protected $table = "voluntariados";

    protected $fillable = ['descripcion', 'perfil_voluntario', 'calle', 'numero', 'comuna', 'region'];

    public function medida() {
    	return $this->morphOne('App\Medida', 'medida');
    }

    public function tareas() {
        return $this->hasMany('App\Tarea');
    }
}
