@extends('layouts.plat')

@php ($pagina = null)

@section('tittle')
Ingresar nueva medida
@endsection

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
            <li><a href="{{ route('catastrofes_path') }}">Catástrofes</a></li>
            <li class="active">Nueva medida</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-heading">
                Ingresar nueva medida
            </div>
            <form method="POST" action="{{ route('store_medida_path') }}">
                {{ csrf_field() }}
                <input type="hidden" name="catastrofe_id" value="{{ $catastrofe_id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="panel-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="fecha_limite" class="control-label">Fecha límite</label>
                            <input type="datetime-local" class="form-control" name="fecha_limite">
                        </div>
                        <div class="col-md-2">
                            <label for="voluntarios" class="control-label">Voluntarios</label>
                            <input type="number" min="1" step="1" class="form-control" name="voluntarios">
                        </div>
                        <div class="col-md-6">
                            <label for="tipo" class="control-label">Tipo de medida</label>
                            <select id="tipo" name="tipo" class="form-control" oninput="formEspecifico()">
                                <option value="0">Seleccione el tipo de medida</option>
                                <option value="economico">Apoyo económico</option>
                                <option value="evento">Eventos a beneficios</option>
                                <option value="recoleccion">Recolecciones</option>
                                <option value="voluntariado">Voluntariados</option>
                            </select>   
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <h3>Objetivos</h3>
                            <div id="objetivos">
                                @include('plat.medidas.formulario.partes.objetivo', ['id' => 0])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Materiales</h3>
                            <div id="materiales">
                                @include('plat.medidas.formulario.partes.material', ['id' => 0])
                            </div>
                        </div>
                    </div>
                    <div id="form-especifico">
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success" role="button">Enviar Información</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
/* Formularios */
function formEspecifico() {
    var tipos = document.getElementById('tipo');
    var tipo = tipos.options[tipos.selectedIndex].value;
    var seccion = document.getElementById('form-especifico');
    if(tipo == 'economico')
        seccion.innerHTML = `@include('plat.medidas.formulario.especificos.economico')`;
    else if(tipo == 'evento')
        seccion.innerHTML = `@include('plat.medidas.formulario.especificos.evento')`;
    else if(tipo == 'recoleccion')
        seccion.innerHTML = `@include('plat.medidas.formulario.especificos.recoleccion')`;
    else if(tipo == 'voluntariado')
        seccion.innerHTML = `@include('plat.medidas.formulario.especificos.voluntariado')`;
    else
        seccion.innerHTML = "";
}

/* Objetivos */
function agregarObjetivo(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(8, parent_id.length)) + 1;
    $('#objetivos').append(`@include('plat.medidas.formulario.partes.objetivo', ['id' => ` + num_act + `])`);
    corregirObjetivos(num_act + 1);
}

function quitarObjetivo(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(8, parent_id.length));
    $('#objetivo' + num_act).remove(); // Quita el objetivo seleccionado
    corregirObjetivos(num_act);
}

function corregirObjetivos(num) {
    var objetivos = document.getElementById('objetivos').childNodes;
    for(var i = num; i < objetivos.length; i++) {
        objetivos[i].id = "objetivo" + i;
    }
}

/* Materiales */
function agregarMaterial(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(8, parent_id.length)) + 1;
    $('#materiales').append(`@include('plat.medidas.formulario.partes.material', ['id' => ` + num_act + `])`);
    corregirMateriales(num_act + 1);
}

function quitarMaterial(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(8, parent_id.length));
    $('#material' + num_act).remove(); // Quita el material seleccionado
    corregirMateriales(num_act);
}

function corregirMateriales(num) {
    var medidas = document.getElementById('materiales').childNodes;
    for(var i = num; i < medidas.length; i++) {
        medidas[i].id = "material" + i;
    }
}

/* Aportes */
function agregarAporte(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(6, parent_id.length)) + 1;
    $('#aportes').append(`@include('plat.medidas.formulario.partes.aporte', ['id' => ` + num_act + `])`);
    corregirAportes(num_act + 1);
}

function quitarAporte(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(6, parent_id.length));
    $('#aporte' + num_act).remove(); // Quita el aporte seleccionado
    corregirAportes(num_act);
}

function corregirAportes(num) {
    var aportes = document.getElementById('aportes').childNodes;
    for(var i = num; i < aportes.length; i++) {
        aportes[i].id = "aporte" + i;
    }
}

/* Actividades */
function agregarActividad(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(9, parent_id.length)) + 1;
    $('#actividades').append(`@include('plat.medidas.formulario.partes.actividad', ['id' => ` + num_act + `])`);
    corregirActividades(num_act + 1);
}

function quitarActividad(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(9, parent_id.length));
    $('#actividad' + num_act).remove(); // Quita el aporte seleccionado
    corregirActividades(num_act);
}

function corregirActividades(num) {
    var actividades = document.getElementById('actividades').childNodes;
    for(var i = num; i < actividades.length; i++) {
        actividades[i].id = "actividad" + i;
    }
}

/* Tareas */
function agregarTarea(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(5, parent_id.length)) + 1;
    $('#tareas').append(`@include('plat.medidas.formulario.partes.tarea', ['id' => ` + num_act + `])`);
    corregirTareas(num_act + 1);
}

function quitarTarea(event) {
    var parent_id = event.currentTarget.parentElement.parentElement.id;
    var num_act = Number(parent_id.substring(5, parent_id.length));
    $('#tarea' + num_act).remove(); // Quita el aporte seleccionado
    corregirTareas(num_act);
}

function corregirTareas(num) {
    var tareas = document.getElementById('tareas').childNodes;
    for(var i = num; i < tareas.length; i++) {
        tareas[i].id = "tarea" + i;
    }
}
</script>
@endsection