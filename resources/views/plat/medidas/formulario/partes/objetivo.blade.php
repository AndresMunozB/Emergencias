<div id="objetivo{{ $id }}" class="input-group">
    <input class="form-control" type="text" name="objetivo[]" placeholder="Objetivo">
    <span class="input-group-btn">
        <button type="button" class="btn btn-success" onclick="agregarObjetivo(event)">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>
    </span>
    <span class="input-group-btn">
        <button type="button" class="btn btn-danger" onclick="quitarObjetivo(event)" @if($id == '0') disabled @endif>
            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
        </button>
    </span>
</div>