<h3>Recolección</h3>
<div class="form-group row">
    <div class="col-md-4">
        <label for="calle" class="control-label">Calle</label>
        <input type="text" class="form-control" name="calle">
    </div>
    <div class="col-md-2">
        <label for="numero" class="control-label">Casa / Depto</label>
        <input type="text" class="form-control" name="numero">
    </div>
    <div class="col-md-3">
        <label for="comuna" class="control-label">Comuna</label>
        <input type="text" class="form-control" name="comuna">
    </div>
    <div class="col-md-3">
        <label for="region" class="control-label">Región</label>
        <select name="region" class="form-control">
            <option value="0">Seleccione región</option>
            <option value="I">I - Tarapacá</option>
            <option value="II">II - Antofagasta</option>
            <option value="III">III - Atacama</option>
            <option value="IV">IV - Coquimbo</option>
            <option value="V">V - Valaparaíso</option>
            <option value="VI">VI -  O'Higgins</option>
            <option value="VII">VII - Maule</option>
            <option value="VIII">VIII - Bío Bío</option>
            <option value="IX">IX - Araucanía</option>
            <option value="X">X - Lagos</option>
            <option value="XI">XI - Aysén </option>
            <option value="XII">XII- Magallanes y Antártica</option>
            <option value="XIV">XIV - Los Ríos  </option>
            <option value="XV">XV - Arica y Parinacota</option>
            <option value="RM">RM - Región Metropolitana</option>
        </select>   
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 col-md-offset-1">
        <h4>Aportes requeridos</h4>
        <div id="aportes">
            @include('plat.medidas.formulario.partes.aporte', ['id' => 0])
        </div>
    </div>
</div>