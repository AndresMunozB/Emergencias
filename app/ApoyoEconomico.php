<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApoyoEconomico extends Model
{
    protected $table = "apoyos_economicos";

    protected $fillable = ['numero_cuenta', 'monto_minimo'];

    public function medida() {
    	return $this->morphOne('App\Medida', 'medida');
    }
}
