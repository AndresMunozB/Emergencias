<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = "materiales";

    protected $fillable = ['medida_id', 'nombre', 'necesario', 'recibido'];

    public function medida() {
    	return $this->belongsTo('App\Medida');
    }
}
