<div id="material{{ $id }}" class="form-inline">
    <input type="text" class="form-control" name="material[]" placeholder="Material" style="width: 58%">
    <input type="number" min="1" step="1" class="form-control" name="cantidad[]" style="width: 15%">
    <div class="input-group">
        <button type="button" class="btn btn-success" onclick="agregarMaterial(event)">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>
        <button type="button" class="btn btn-danger" onclick="quitarMaterial(event)" @if($id == '0') disabled @endif>
            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
        </button>
    </div>
</div>