@extends('layouts.inicio')

@php ($pagina = 'registro')

@section('title')
Registrarse
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">Registro</div>
                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="col-md-6{{ $errors->has('rut') ? ' has-error' : '' }}">
                                <label for="rut">RUT</label>
                                <input id="rut" type="text" class="form-control" name="rut" value="{{ old('rut') }}" placeholder="Ingrese su RUT" oninput="formatRUT()" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rut') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese su nombre" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                             
                        <div class="form-group row">
                            <div class="col-md-4{{ $errors->has('apellido_paterno') ? ' has-error' : '' }}">
                                <label for="apellido_paterno">Apellido paterno</label>
                                <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" value="{{ old('apellido_paterno') }}" placeholder="Ingrese su apellido paterno" required>
                                @if ($errors->has('apellido_paterno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellido_paterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4{{ $errors->has('apellido_materno') ? ' has-error' : '' }}">
                                <label for="apellido_materno">Apellido materno</label>
                                <input id="apellido_materno" type="text" class="form-control" name="apellido_materno" value="{{ old('apellido_materno') }}" placeholder="Ingrese su apellido materno" required>

                                @if ($errors->has('apellido_materno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellido_materno') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>

                                @if ($errors->has('fecha_nacimiento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                               
                        <div class="form-group row">
                            <div class="col-md-6{{ $errors->has('correo') ? ' has-error' : '' }}">
                                <label for="correo">Correo</label>
                                <input id="correo" type="email" class="form-control" name="correo" value="{{ old('correo') }}" placeholder="Ingrese su dirección de correo electrónico" required>

                                @if ($errors->has('correo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('correo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" placeholder="Ingrese su número de teléfono" required>

                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm">Confirmar contraseña</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">
                            Registrarse
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
