<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catastrofe extends Model
{
    protected $table = "catastrofes";

    protected $fillable = ['tipo','descripcion','region','comuna', 'fecha'];

    public function medidas(){
    	return $this->hasMany('App\Medida');
    }
}
