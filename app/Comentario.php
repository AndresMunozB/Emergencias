<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comentario;

class Comentario extends Model
{
    protected $table = "comentarios";

    protected $fillable = ['user_id', 'medida_id', 'texto', 'comentario_id'];

    public function usuario() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function medida() {
    	return $this->belongsTo('App\Medida');
    }

    public function respuestas() {
        return Comentario::where('comentario_id', $this->id)->get();
    }
}
