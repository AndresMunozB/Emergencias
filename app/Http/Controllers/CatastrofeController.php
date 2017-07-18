<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catastrofe;
use App\TwitterAPIExchange;
use Auth;

class CatastrofeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catastrofes = Catastrofe::orderBy('created_at','desc')->simplePaginate(5);
        return view('plat.catastrofes.list')->with(['catastrofes' => $catastrofes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('plat.catastrofes.formulario.form'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catastrofe = Catastrofe::create($request->all());
        TwitterAPIExchange::sendTweet('Nueva catastrofe: '. $catastrofe->tipo . ' en '. $catastrofe->region . ', ' . $catastrofe->comuna);
        return redirect()->route('catastrofes_path');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Catastrofe $catastrofe)
    {
        //dd($catastrofe);
        return view('plat.catastrofes.detalle.detalle')->with(['catastrofe' => $catastrofe]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Catastrofe $catastrofe)
    {
        return view('catastrofes.edit')->with(['catastrofe' => $catastrofe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Catastrofe $catastrofe, Request $request)
    {
        $catastrofe->update($request->all());
        return redirect()->route('catastrofe_path',['catastrofe' => $catastrofe->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Catastrofe $catastrofe)
    {
        $catastrofe->delete();
        return redirect()->route('catastrofes_path');
    }


}
