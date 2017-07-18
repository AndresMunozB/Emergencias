@extends('layouts.plat')

@php ($pagina = 'usuarios')

@section('title')
Usuarios
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Usuarios
                    
                </div>
                <div class="panel-body">
                @if($usuarios->count() > 0)
                    @include('plat.usuarios.usuarios', ['usuarios' => $usuarios])
                @else
                    <div class="text-center">
                        <h3>No existen usuarios en el sistema</h3>
                    </div>
                @endif
                </div>
                <div class="panel-footer">
                {{ $usuarios->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
