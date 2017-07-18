<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recoleccion extends Model
{
    protected $table = "recolecciones";

    protected $fillable = ['calle', 'numero', 'comuna', 'region'];

    public function medida() {
    	return $this->morphOne('App\Medida', 'medida');
    }

    public function aportes() {
        return $this->hasMany('App\Aporte');
    }
}
