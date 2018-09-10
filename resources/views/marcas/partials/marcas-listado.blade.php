
<ul class="list-group">
    @if(isset($marca))
        <li class="list-group-item text-center">
            <a href="{{ route('marcas.index') }}"  class="btn btn-sm btn-default">Agregar nueva marca</a>
        </li>
    @endif

    @forelse($marcas as $marca)
        <li class="list-group-item">
            <button type="button" title="Eliminar" class="pull-right nonStyledButton" data-toggle="modal" data-target="#eliminarMarca{!! $marca->id !!}" style="border: none">
                <i class="glyphicon glyphicon-trash small text-danger"></i>
            </button>
            <a href="{{ route('marcas.edit', $marca->id) }}" class="pull-right nonStyledButton"><i class="glyphicon glyphicon-edit small text-info"></i></a>

            {!! $marca->nombre !!}<br>
            <small class="text-muted">{!! $marca->descripcion !!}</small>
        </li>

        <div class="modal fade col-lg-3 col-lg-offset-9" id="eliminarMarca{!! $marca->id !!}">
            <div class="card">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar marca</h4>
                </div>
                <div class="modal-body">
                    <p class="text-danger">
                        Usted está a punto de eliminar la marca '{!! $marca->nombre !!}'<br>
                    </p>
                    <p>¿Desea continuar?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['route'  => ['marcas.destroy', $marca->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @empty

        <p>Todavía no hay ninguna marca</p>

    @endforelse

</ul>