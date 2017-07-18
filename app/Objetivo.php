<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $table = "objetivos";

    protected $fillable = ['medida_id', 'descripcion'];

    public function medida() {
    	return $this->belongsTo('App\Medida');
    }
}
