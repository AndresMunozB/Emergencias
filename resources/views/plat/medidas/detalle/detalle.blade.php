@extends('layouts.plat')

@php ($pagina = 'medidas')

@section('title')
Detalle de medida
@endsection

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
            <li><a href="{{ route('catastrofes_path') }}">Catástrofes</a></li>
            <li><a href="{{ route('catastrofe_path', ['catastrofe' => $medida->catastrofe]) }}">Detalle catástrofe</a></li>
            <li class="active">Detalle medida</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-heading">
                Detalle de medida
                @if(!$medida->aprobada)
                <a class="btn btn-success btn-xs pull-right" href="{{ route('aprobar_medida_path', ['medida' => $medida]) }}">Aprobar</a>
                @endif
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <label for="avance" class="control-label">Avance:</label>
                        <div class="pull-right">{{ $medida->avance }}%</div>
                        <div class="progress">
                            <div name="avance" class="progress-bar @if($medida->avance <= 25.0) progress-bar-danger @elseif($medida->avance <= 50.0) progress-bar-warning @elseif($medida->avance <= 75.0) progress-bar-info @else progress-bar-success @endif" role="progressbar" aria-valuenow="{{ $medida->avance }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $medida->avance }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="fecha_limite" class="control-label">Fecha límite</label>
                        <p>{{ $medida->fecha_limite }}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="voluntarios" class="control-label">Voluntarios</label>
                        <p>{{ $medida->voluntarios }}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo" class="control-label">Tipo de medida</label>
                        <p>{{ $medida->region }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Objetivos</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Objetivo</th>
                                </tr>
                            @foreach($medida->objetivos as $objetivo)
                                <tr>
                                    <td>{{ $objetivo->descripcion }}</td>
                                </tr>
                            @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Materiales</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Material</th>
                                    <th>Necesario</th>
                                    <th>Recibido</th>
                                    <th></th>
                                </tr>
                            @foreach($medida->materiales as $material)
                                <tr>
                                    <td>{{ $material->nombre }}</td>
                                    <td>{{ $material->necesario }}</td>
                                    <td>{{ $material->recibido }}</td>
                                    <td>
                                        <form role="form" method="POST" action="{{ route('add_material', ['material' => $material]) }}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input class="form-control" type="number" name="cantidad" min="1" step="1" style="width: 6em">
                                                    <span class="input-group-btn-xs">
                                                        <button type="submit" class="btn btn-success">
                                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                @php ($especifica = $medida->especifica)
                @if($medida->medida_type == 'App\ApoyoEconomico')
                <div class="row">
                    <div class="col-md-3">
                        <label for="numero_cuenta" class="control-label">Número de cuenta</label>
                        <p>{{ $especifica->numero_cuenta }}</p>
                    </div>
                    <div class="col-md-3">
                        <label for="monto_minimo" class="control-label">Monto mínimo requerido</label>
                        <p>$ {{ $especifica->monto_minimo }}</p>
                    </div>
                    <div class="col-md-3">
                        <label for="monto_actual" class="control-label">Monto actual</label>
                        <p>$ {{ $especifica->monto_actual }}</p>
                    </div>
                    <div class="col-md-3">
                        <form role="form" method="POST" action="{{ route('add_aporte_monetario', ['apoyo' => $especifica]) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="aporte">Realizar un aporte monetario</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" name="aporte" min="1" step="1">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @elseif($medida->medida_type == 'App\EventoBeneficio')
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3>Actividades</h3>
                        <div class="table-responsive">
                            <form role="form" method="POST" action="{{ route('update_evento', ['evento' => $especifica]) }}">
                                {{ csrf_field() }}
                                <table class="table">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Realizada</th>
                                    </tr>
                                @foreach($especifica->actividades as $actividad)
                                    <tr>
                                        <td>{{ $actividad->nombre }}</td>
                                        <td>{{ $actividad->descripcion }}</td>
                                        <td>
                                            <input type="checkbox" name="realizada[]" value="true" @if($actividad->realizada) checked @endif>
                                        </td>
                                    </tr>
                                @endforeach
                                </table>
                                <button type="sumbit" class="btn btn-success">Actualizar actividades</button>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif($medida->medida_type == 'App\Recoleccion')
                <div class="row">
                </div>
                @else
                <div class="row">
                </div>
                @endif
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Comentarios</h3>
                        @if($medida->comentarios->count() > 0)
                            <div class="panel panel-default">
                                @foreach($medida->comentarios->where('comentario_id', null) as $comentario)
                                <div class="panel-heading">
                                    Comentario de <b>{{ $comentario->usuario->nombre }}</b>
                                </div>
                                <div class="panel-body">
                                    <p>{{ $comentario->texto }}</p>
                                    @foreach($comentario->respuestas() as $respuesta)
                                    <div class="col-md-11 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <i>Respuesta de <b>{{ $respuesta->usuario->nombre }}</b></i>
                                            </div>
                                            <div class="panel-body">
                                                <p>{{ $respuesta->texto }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-md-11 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <form role="form" method="POST" action="#">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="texto" class="control-label">Responder</label>
                                                                <textarea class="form-control" rows="3" name="texto" placeholder="Responder a {{ $comentario->usuario->nombre }}..."></textarea>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-success pull-right">Publicar respuesta</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center">
                                <h4>Aún no se han realizado comentarios</h4>
                            </div>
                        @endif
                        <form role="form" method="POST" action="#">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="texto" class="control-label">Realizar un comentario</label>
                                    <textarea class="form-control" rows="5" name="texto" placeholder="Comentar medida..."></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success pull-right">Publicar comentario</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection