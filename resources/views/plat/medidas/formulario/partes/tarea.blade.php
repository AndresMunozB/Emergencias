<div id="tarea{{ $id }}" class="input-group">
    <input type="text" class="form-control" name="tarea[]" placeholder="Tarea">
    <span class="input-group-btn">
        <button type="button" class="btn btn-success" onclick="agregarTarea(event)">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>
    </span>
    <span class="input-group-btn">
        <button type="button" class="btn btn-danger" onclick="quitarTarea(event)" @if($id == '0') disabled @endif>
            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
        </button>
    </span>
</div>