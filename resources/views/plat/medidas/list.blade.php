@extends('layouts.plat')

@php ($pagina = 'medidas')

@section('title')
Medidas
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @role('admin', 'gob')
                <div class="panel-heading text-center">Medidas por aprobar</div>
                @if($por_aprobar->count() > 0)
                    @include('plat.medidas.medidas', ['medidas' => $por_aprobar])
                @else
                    <div class="text-center">
                        <h3>No hay medidas por aprobar</h3>
                    </div>
                @endif
                <div class="panel-footer">
                    {{ $por_aprobar->links() }}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center">Medidas aprobadas</div>
                @else
                <div class="panel-heading text-center">Medidas en las que participo</div>
                @endrole
                @if($medidas->count() > 0)
                    @include('plat.medidas.medidas', ['medidas' => $medidas])
                @else
                    <div class="text-center">
                        @role('admin', 'gob')
                        <h3>No se han ingresado medidas</h3>
                        @else
                        <h3>No está participando en ninguna medida actualmente</h3>
                        @endrole
                        <button class="btn btn-success btn-center">Ver catástrofes</button>
                    </div>
                @endif
                <div class="panel-footer">
                    {{ $medidas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
