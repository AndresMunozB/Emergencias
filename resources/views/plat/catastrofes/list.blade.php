@extends(Auth::check() ? 'layouts.plat' : 'layouts.inicio')

@php ($pagina = 'catastrofes')

@section('title')
Catástrofes
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Catástrofes
                    @role('admin', 'gob')
                    <a class="btn btn-success btn-xs pull-right" href="{{ route('create_catastrofe_path') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Agregar
                    </a>
                    @endrole
                </div>
                <div class="panel-body">
                @if($catastrofes->count() > 0)
                    @include('plat.catastrofes.catastrofes', ['catastrofes' => $catastrofes])
                @else
                    <div class="text-center">
                        <h3>No se han ingresado nuevas catástrofes</h3>
                        @if(Auth::check())
                        <h4>Puede ingresar una nueva catástrofe presionando el botón de la esquina superior derecha</h4>
                        @endif
                    </div>
                @endif
                </div>
                <div class="panel-footer">
                {{ $catastrofes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
