<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    protected $table = "medidas";

    protected $fillable = [
        'catastrofe_id',
        'user_id',
        'fecha_limite',
        'voluntarios',
        'aprobada',
        'avance'
    ];

    public function catastrofe()
    {
    	return $this->belongsTo('App\Catastrofe');
    }

    public function materiales() {
        return $this->hasMany('App\Material');
    }

    public function objetivos() {
        return $this->hasMany('App\Objetivo');
    }

    public function comentarios() {
        return $this->hasMany('App\Comentario');
    }
    
    public function especifica() {
        return $this->morphTo('medida');
    }

    public function getAvanceAttribute($value) {
        return round($value, 2);
    }

    public function tipo() {
        switch($this->medida_type) {
            case 'App\ApoyoEconomico': return 'Apoyo económico';
            case 'App\EventoBeneficio': return 'Evento a beneficio';
            case 'App\Recoleccion': return 'Recolección';
            default: return 'Voluntariado';
        }
    }
}
