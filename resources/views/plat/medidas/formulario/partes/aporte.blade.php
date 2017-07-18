<div id="aporte{{ $id }}" class="form-inline">
    <input type="text" class="form-control" name="aporte[]" placeholder="Aporte" style="width: 68%">
    <input type="number" min="1" step="1" class="form-control" name="cantidad_aporte[]" placeholder="Cantidad" style="width: 15%">
    <div class="input-group">
        <button type="button" class="btn btn-success" onclick="agregarAporte(event)">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>
        <button type="button" class="btn btn-danger" onclick="quitarAporte(event)" @if($id == '0') disabled @endif>
            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
        </button>
    </div>
</div>