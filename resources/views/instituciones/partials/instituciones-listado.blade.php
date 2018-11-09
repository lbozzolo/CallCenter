

<ul class="list-group">
    @if(isset($institucion))
        <li class="list-group-item text-center">
            <a href="{{ route('instituciones.index') }}"  class="btn btn-sm btn-default">Agregar nueva institución</a>
        </li>
    @endif



    <div class="card-body">
        <div class="table-responsive">
            <table class="table student-data-table m-t-20">
                <thead>
                    <tr>
                        <th>Institucion</th>
                        <th class="text-right">Opciones</th>
                     </tr>
                </thead>
                <tbody>
                @forelse($instituciones as $institucion)
                    <tr>
                        <td >{!! $institucion->nombre !!}</td>
                        <td>
                            <button type="button" title="Eliminar" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#eliminarInstitucion{!! $institucion->id !!}"><i class="fa fa-trash-o"></i></button>
                            <a href="{{ route('instituciones.edit', $institucion->id) }}" class=" btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('instituciones.show', $institucion->id) }}" class=" btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade col-lg-4 col-lg-offset-8" id="eliminarInstitucion{!! $institucion->id !!}">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="card-title"><i class="fa fa-warning "></i> Eliminar institución</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-danger">Usted está a punto de eliminar la institución '{!! $institucion->nombre !!}' devinitivamente</p>
                                <p>¿Desea continuar?</p>
                            </div>
                            <div class="card-footer">
                                {!! Form::open(['route'  => ['instituciones.destroy', $institucion->id], 'method' => 'delete']) !!}
                                <button type="submit" class="btn btn-danger">Eliminar de todos modos</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @empty

                    <p>Todavía no hay ninguna institución</p>

                @endforelse
                </tbody>
            </table>
        </div>
    </div>





</ul>