<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Tipo</th>
            <th>Avance</th>
            <th></th>
        </tr>
    @foreach($medidas as $medida)
        <tr>
            <td>{{ $medida->tipo() }}</td>
            <td>{{ $medida->avance }}%</td>
            <td>
                <div class="pull-right">
                    <a class="btn btn-primary btn-xs" href="{{ route('medida_path', ['medida' => $medida]) }}">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                    @if($medida->aprobada)
                    @role('admin', 'gob')
                    <form class="btn-xs pull-right" method="POST" action="{{ route('delete_medida_path', ['medida' => $medida]) }}"> 
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-xs">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </form>
                    @endrole
                    @else
                    <form class="btn-xs pull-right" method="POST" action="{{ route('aprobar_medida_path', ['medida' => $medida]) }}"> 
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success btn-xs">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        </button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </table>
</div>