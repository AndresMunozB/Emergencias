<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = "tareas";

    protected $fillable = ['medida_id', 'descripcion'];

    public function voluntariado() {
    	return $this->belongsTo('App\Voluntariado');
    }
}
