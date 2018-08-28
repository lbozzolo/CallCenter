

<ul class="list-group">
    @if(isset($institucion))
        <li class="list-group-item text-center">
            <a href="{{ route('instituciones.index') }}"  class="btn btn-sm btn-default">Agregar nueva institución</a>
        </li>
    @endif

    @forelse($instituciones as $institucion)

    <div class="card-body">
        <div class="table-responsive">
            <table class="table student-data-table m-t-20">
                <thead>
                    <tr>
                        <th>Institucion</th>
                        <th align="right">Opciones</th>
                     </tr>
                </thead>   
                <tbody>
                <tr>
                    <td align="left">{!! $institucion->nombre !!}</td>
        <td align="center">
            <button type="button" title="Eliminar" class="pull-right btn btn-danger btn-xs" data-toggle="modal" data-target="#eliminarInstitucion{!! $institucion->id !!}">
                <i class="fa fa-trash-o"></i>

            </button>
            <a href="{{ route('instituciones.edit', $institucion->id) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>

            
            <a href="{{ route('instituciones.show', $institucion->id) }}" class="pull-right btn btn-success btn-xs"><i class="fa fa-eye"></i></a>


       
        </td>


        </tr>
    </tbody>
</table></div></div>

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