<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Catastrofe;
use App\Medida;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->bloqueado) {
            Auth::logout();
            return redirect('/login')
                ->with('bloqueado', 'true');
        } else {
            $catastrofes = Catastrofe::all()->sortBy('created_at')->take(5);
            $medidas = Medida::all()->pipe(function($medidas) {
                $cercanas = array();
                $hoy = Carbon::today();
                foreach($medidas as $medida) {
                    if($hoy->diffInDays(Carbon::parse($medida['fecha_limite'])) <= 14)
                        array_push($cercanas, $medida);
                }
                return collect($cercanas);
            })->sortBy('avance')->take(5);
            
            return view('plat.home', compact('catastrofes', 'medidas'));
        }
    }
}
