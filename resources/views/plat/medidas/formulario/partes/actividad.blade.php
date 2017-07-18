<div id="actividad{{ $id }}" class="form-inline">
    <input type="text" class="form-control" name="actividad[]" placeholder="Actividad" style="width: 20%">
    <input type="text" class="form-control" name="descripcion[]" placeholder="Descripción" style="width: 67%">
    <div class="input-group">
        <button type="button" class="btn btn-success" onclick="agregarActividad(event)">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>
        <button type="button" class="btn btn-danger" onclick="quitarActividad(event)" @if($id == '0') disabled @endif>
            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
        </button>
    </div>
</div>