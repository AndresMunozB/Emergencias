<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aporte extends Model
{
    protected $table = "aportes";

    protected $fillable = ['nombre', 'necesario'];

    public function recoleccion() {
    	return $this->belongsTo('App\Recoleccion');
    }
}
