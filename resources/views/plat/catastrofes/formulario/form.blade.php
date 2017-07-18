@extends('layouts.plat')

@php ($pagina = 'catastrofes')

@section('title')
Ingresar nueva catástrofe
@endsection

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
			<ol class="breadcrumb">
				<li><a href="{{ route('catastrofes_path') }}">Catástrofes</a></li>
				<li class="active">Nueva catástrofe</li>
			</ol>
			<form action="{{ route('store_catastrofe_path') }}" method="POST">
				<div class="panel panel-default">
					@if(count($errors) > 0 )
					<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $error)
							<li> {{$error}} </li>
							@endforeach
						</ul>
					</div>
					@endif
						{{ csrf_field() }}
					<div class="panel-heading">Ingresar nueva catástrofe</div>
					<div class="panel-body">
						<div class="form-group row">
							<div class="col-md-8">
								<label for="tipo">Tipo:</label>
								<input type="text" name="tipo" class="form-control" value="{{ old('tipo') }}" placeholder="Terremoto, incendio forestal, etc..">
							</div>							
							<div class="col-md-4">
								<label for="fecha">Fecha y hora:</label>
								<input type="datetime-local" name="fecha" class="form-control" value="{{ old('fecha') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="descripcion">Descripción:</label>
							<textarea rows="5" name="descripcion" class="form-control" placeholder="Ingrese una descripción de la catástrofe">{{ old('descripcion') }}</textarea>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
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
							<div class="col-md-6">
								<label for="comuna">Comuna:</label>
								<input type="text" name="comuna" class="form-control" value="{{ old('comuna') }}" placeholder="Ingrese la comuna">
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-primary" > Crear catástrofe</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection