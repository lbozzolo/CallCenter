

<ul class="list-group listado">
    @if(isset($categoria))
        <li class="list-group-item text-center">
            <a href="{{ route('categorias.index') }}"  class="btn btn-sm btn-default">Agregar nueva categoría</a>
        </li>
    @endif

    @foreach($categorias as $categoria)
        <li class="list-group-item">
            <button type="button" title="Eliminar" class="pull-right nonStyledButton" data-toggle="modal" data-target="#eliminarCategoria{!! $categoria->id !!}" style="border: none">
                <i class="glyphicon glyphicon-trash small text-danger"></i>
            </button>
            <a href="{{ route('categorias.edit', $categoria->id) }}" class="pull-right nonStyledButton"><i class="glyphicon glyphicon-edit small text-info"></i></a>

            {!! $categoria->nombre !!}

        </li>

        <div class="modal fade col-lg-4 col-lg-offset-8" id="eliminarCategoria{!! $categoria->id !!}">
            <div class="card">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar categoría</h4>
                </div>
                <div class="modal-body">
                    <p class="text-danger">
                        Usted está a punto de eliminar la categoría '{!! $categoria->nombre !!}' devinitivamente<br>
                        Al hacerlo puede ocasionar problemas al sistema.
                    </p>
                    <p>¿Desea continuar?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    {!! Form::open(['route'  => ['categorias.destroy', $categoria->id], 'method' => 'delete']) !!}
                    <button type="submit" class="btn btn-danger pull-right">Eliminar de todos modos</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endforeach

</ul>