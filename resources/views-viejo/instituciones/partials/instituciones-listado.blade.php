

<ul class="list-group">
    @if(isset($institucion))
        <li class="list-group-item text-center">
            <a href="{{ route('instituciones.index') }}"  class="btn btn-sm btn-default">Agregar nueva institución</a>
        </li>
    @endif

    @forelse($instituciones as $institucion)
        <li class="list-group-item">
            <button type="button" title="Eliminar" class="pull-right nonStyledButton" data-toggle="modal" data-target="#eliminarInstitucion{!! $institucion->id !!}" style="border: none">
                <i class="glyphicon glyphicon-trash small text-danger"></i>
            </button>
            <a href="{{ route('instituciones.edit', $institucion->id) }}" class="pull-right nonStyledButton"><i class="glyphicon glyphicon-edit small text-info"></i></a>
            <a href="{{ route('instituciones.show', $institucion->id) }}" class="pull-right nonStyledButton"><i class="fa fa-info-circle small text-info"></i></a>

            {!! $institucion->nombre !!}

        </li>

        <div class="modal fade" id="eliminarInstitucion{!! $institucion->id !!}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar institución</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">Usted está a punto de eliminar la institución '{!! $institucion->nombre !!}' devinitivamente</p>
                        <p>¿Desea continuar?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        {!! Form::open(['route'  => ['instituciones.destroy', $institucion->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger pull-right">Eliminar de todos modos</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    @empty

        <p>Todavía no hay ninguna institución</p>

    @endforelse

</ul>