<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Medida;
use App\ApoyoEconomico;
use App\EventoBeneficio;
use App\Voluntariado;
use App\Objetivo;
use App\Actividad;
use App\Material;
use App\Apoyo;
use App\Tarea;
use App\Recoleccion;
use App\Aporte;
use App\ProcedimientoAlmacenado as PA;

class MedidaController extends Controller
{	

	public function index()
    {
		$por_aprobar = Medida::where('aprobada', false)->simplePaginate(3);
        $medidas = Medida::where('aprobada', true)->where('user_id', Auth::user()->id)->simplePaginate(3);
        return view('plat.medidas.list')->with(['medidas' => $medidas, 'por_aprobar' => $por_aprobar]);
    }

    public function create($catastrofe_id)
    {
		//$entidades = Auth::user()->entidades;
    	return view('plat.medidas.formulario.form', compact('catastrofe_id'));
    }

    public function store(Request $request)
    {	
    	$medida = Medida::create($request->all());
		foreach (Input::get('objetivo') as $descripcion){
			$objetivo = new Objetivo;
			$objetivo->descripcion = $descripcion;
			$medida->objetivos()->save($objetivo);
		}

		$materiales = Input::get('material');
		$cantidades = Input::get('cantidad');
		for ($i = 0; $i < count($materiales); $i++) {
			$material = new Material;
			$material->nombre = $materiales[$i];
			$material->necesario = $cantidades[$i];
			$medida->materiales()->save($material);
		}

    	if ($request->tipo == 'economico') 
    	{
    		$economico = ApoyoEconomico::create($request->all());
    		$economico->medida()->save($medida);
    	}
    	else if ($request->tipo == 'evento') 
    	{
    		$evento = EventoBeneficio::create($request->all());
    		$evento->medida()->save($medida);
            $actividades = Input::get('actividad');
            $descripciones = Input::get('descripcion');
			for ($i = 0; $i < count($actividades); $i++) {
				$actividad = new Actividad;
				$actividad->nombre = $actividades[$i];
				$actividad->descripcion = $descripciones[$i];
				$evento->actividades()->save($actividad);
			}
    	}
    	else if ($request->tipo == 'recoleccion')
    	{
    		$recoleccion = Recoleccion::create($request->all());
    		$recoleccion->save();
    		$recoleccion->medida()->save($medida);
            $aportes = Input::get('aporte');
            $cantidad_aportes = Input::get('cantidad_aporte');
    		for ($i = 0; $i < count($aportes); $i++) {
				$aporte = new Aporte;
				$aporte->nombre = $aportes[$i];
				$aporte->necesario = $cantidad_aportes[$i];
				$recoleccion->aportes()->save($aporte);
			}
    	}
    	else if ($request->tipo == 'voluntariado')
    	{
    		$voluntariado = Voluntariado::create($request->all());
    		$voluntariado->save();
    		$voluntariado->medida()->save($medida);

    		foreach (Input::get('tarea') as $descripcion) {
    			$tarea = new Tarea;
				$tarea->descripcion = $descripcion;
    			$voluntariado->tareas()->save($tarea);
    		}
    	}

    	return redirect()->route('catastrofe_path', ['catastrofe' => $medida->catastrofe]);
    }

	public function approve(Medida $medida) {
		$medida->aprobada = true;
		$medida->save();
		return $this->index();
	}

    public function show(Medida $medida)
    {
    	return view('plat.medidas.detalle.detalle', compact('medida'));
    }

	public function addMaterial(Request $request, Material $material) {
		$material->recibido = $material->recibido + $request->cantidad;
		$material->save();
		if($material->medida->medida_type == 'App\EventoBeneficio')
			PA::avance_evento_beneficio($material->medida->id);

		return redirect()->route('medida_path', ['medida' => $material->medida]);
	}

	public function addApoyo(Request $request, ApoyoEconomico $apoyo) {
		$apoyo->monto_actual = $apoyo->monto_actual + $request->aporte;
		$apoyo->save();
		PA::avance_apoyo_economico($apoyo->medida->id);
			
		return redirect()->route('medida_path', ['medida' => $apoyo->medida]);
	}

	public function updateActividades(Request $request, EventoBeneficio $evento) {
		$estados = Input::get('realizada');
		$i = 0;
		foreach($evento->actividades as $actividad) {
			$actividad->realizada = $estados[$i];
			$actividad->save();
			$i++;
		}
		return redirect()->route('medida_path', ['medida' => $evento->medida]);
	}
}
