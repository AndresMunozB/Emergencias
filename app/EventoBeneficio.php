<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoBeneficio extends Model
{
    protected $table = "eventos_a_beneficio";

    protected $fillable = ['calle', 'numero', 'comuna', 'region'];

    public function medida() {
    	return $this->morphOne('App\Medida', 'medida');
    }

    public function actividades() {
        return $this->hasMany('App\Actividad');
    }
}
