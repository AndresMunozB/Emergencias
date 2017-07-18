@extends('layouts.plat')

@php ($pagina = 'catastrofes')

@section('title')
Detalle catástrofe
@endsection

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
            <li><a href="{{ route('catastrofes_path') }}">Catástrofes</a></li>
            <li class="active">Detalle catástrofe</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-heading">
                Detalle de catástrofe
            </div>
			<div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="fecha" class="control-label">Fecha y hora</label>
                        <p>{{ $catastrofe->fecha }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="region" class="control-label">Región</label>
                        <p>{{ $catastrofe->region }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="comuna" class="control-label">Comuna</label>
                        <p>{{ $catastrofe->comuna }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <p>{{ $catastrofe->descripcion }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3>
                            Medidas
                            <a class="btn btn-success btn-sm pull-right" href="{{ route('create_medida_path', ['catastrofe_id' => $catastrofe->id]) }}">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Medida
                            </a>
						</h3>
                        @if($catastrofe->medidas->count() > 0)
							@include('plat.medidas.medidas', ['medidas' => App\Medida::where('catastrofe_id', $catastrofe->id)->where('aprobada', true)->simplePaginate(5)])
						@else
                    		<div class="text-center">
								<h3>Aún no se han creado medidas para esta catástrofe</h3>
								<a class="btn btn-success btn-center" href="{{ route('create_medida_path', ['catastrofe_id' => $catastrofe->id]) }}">Crear una medida</a>
							</div>
						@endif
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection