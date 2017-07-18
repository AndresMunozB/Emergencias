<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Región</th>
            <th>Comuna</th>
            <th>Tipo</th>
            @if(Auth::check())
            <th></th>
            @endif
        </tr>
    @foreach($catastrofes as $catastrofe)
        <tr>
            <td>{{ $catastrofe->region }}</td>
            <td>{{ $catastrofe->comuna }}</td>
            <td>{{ $catastrofe->tipo }}</td>
            @if(Auth::check())
            <td>
                <div class="pull-right">
                    <a class="btn btn-primary btn-xs" href="{{ route('catastrofe_path', ['catastrofe' => $catastrofe]) }}">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                    <a class="btn btn-success btn-xs" href="{{ route('create_medida_path', ['catastrofe_id' => $catastrofe->id]) }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Medida
                    </a>
                    @role('admin', 'gob')
                    <form class="btn-xs pull-right" method="POST" action="{{ route('delete_catastrofe_path', ['catastrofe' => $catastrofe]) }}"> 
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
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
    <!-- Descripción de catástrofe -->
    <div id="descripcion" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Descripción de catástrofe</h4>
                </div>
                <div class="modal-body">
                    <p id="descripcion-catastrofe">Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>