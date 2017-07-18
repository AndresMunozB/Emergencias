@extends('layouts.plat')

@php ($pagina = 'inicio')

@section('title')
Inicio
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading text-center">Catástrofes recientes</div>
                @if(count($catastrofes) > 0)
                    @include('plat.catastrofes.catastrofes', ['catastrofes' => $catastrofes])
                @else
                    <h3>No se han ingresado nuevas catástrofes</h3>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading text-center">Medidas que requieren ayuda</div>
                @if(count($medidas) > 0)
                    @include('plat.medidas.medidas', ['medidas' => $medidas])
                @else
                    <h3>No hay medidas que requieran ayuda</h3>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
