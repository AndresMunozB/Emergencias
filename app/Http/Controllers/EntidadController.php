<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Medida;
use App\ApoyoEconomico;
use App\EventoBeneficio;
use App\Voluntariado;


class EntidadController extends Controller
{	

	public function index()
    {
        $medida = Medida::orderBy('id','desc')->paginate(10);
        return view('medidas.index')->with(['medidas' => $medidas]);
    }

    public function create()
    {
    	return view('formularios.entidad');
    }

    public function store(Request $request)
    {	

    }

    public function show($medida)
    {
    	// TODO: Mostrar medidas
    }
}
