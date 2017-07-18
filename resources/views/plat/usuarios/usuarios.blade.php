<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Rut</th>
            <th>Nombre</th>
            @if(Auth::check())
            <th></th>
            @endif
        </tr>
    @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->rut }}</td>
            <td>{{ $usuario->nombre }}</td>
            @if(Auth::check())
            <td>
                <div class="pull-right">
                    <a class="btn btn-primary btn-xs" href="{{ route('usuario_path', ['usuario' => $usuario]) }}">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>


                    @role('admin')
                    

                    <form class="btn-xs pull-right" method="POST" action="{{ route('desabilitar_usuario_path') }}"> 
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $usuario->id }}">
                        <button type="submit" class="btn btn-danger btn-xs">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </form>


                    @endrole
    


                    </div>
                </td>
                @endif
            </tr>
        @endforeach
        </table>
        
</div>