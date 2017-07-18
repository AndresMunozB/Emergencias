<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = "actividades";

    protected $fillable = ['evento_beneficio_id','nombre', 'descripcion', 'realizada'];

    public function recoleccion() {
    	return $this->belongsTo('App\EventoBeneficio');
    }
}
