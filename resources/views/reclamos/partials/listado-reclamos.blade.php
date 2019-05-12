<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-reclamos" style="display: none">

    <table class="table table-vertical dataTable" id="table-reclamos">

        <thead>
        <tr>
            <th>Id</th>
            <th>Estado</th>
            <th class="text-right">Venta</th>
            <th>Cliente</th>
            <th style="width: 300px">Descripción</th>
            <th class="text-center">solucionado</th>
            <th>Fecha</th>
            <th class="text-right">Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($reclamos as $reclamo)

            <tr>
                <td>{!! $reclamo->id !!}</td>
                <td>
                    @if($reclamo->estado->slug == 'abierto')
                        <label class="label label-success">{!! $reclamo->estado->nombre !!}</label>
                    @elseif($reclamo->estado->slug == 'cerrado')
                        <label class="label label-default">{!! $reclamo->estado->nombre !!}</label>
                    @endif
                </td>
                <td class="text-center">
                @permission('ver.venta')
                    <a href="{{ route('ventas.show', $reclamo->venta->id) }}" style="color: cyan">{!! $reclamo->venta->id !!}</a>
                @endpermission
                </td>
                <td>
                    @permission('ver.cliente')
                    <a href="{{ route('clientes.show', $reclamo->venta->cliente->id) }}">
                        {!! $reclamo->venta->cliente->full_name !!}
                    </a>
                    @endpermission
                </td>
                <td>{!! $reclamo->descripcion !!}</td>
                <td class="text-center">
                    @if($reclamo->solucionado)
                        <i class="fa fa-check text-success"></i>
                    @else
                        <i class="fa fa-close text-danger"></i>
                    @endif
                </td>
                <td>{!! $reclamo->fecha_creado !!}</td>
                <td class="text-center">
                @permission('cambiar.estado.reclamo')
                    <button type="button" {{ ($reclamo->estado && $reclamo->estado->slug == 'abierto')? 'title=CERRAR' : 'title=ABRIR' }} class="btn btn-default btn-xs" data-toggle="modal" data-target="#disableReclamo{!! $reclamo->id !!}" >
                        @if($reclamo->estado && $reclamo->estado->slug == 'activo')
                            <i class="fa fa-toggle-on"></i>
                        @else
                            <i class="fa fa-toggle-off"></i>
                        @endif
                    </button>
                    <div class="modal fade col-lg-3 col-lg-offset-9" id="disableReclamo{!! $reclamo->id !!}">
                        <div class="card alert text-center">
                            <div class="card-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><i class="fa fa-warning "></i>
                                    {!! ($reclamo->estado->slug == 'abierto')? 'Cerrar reclamo' : 'Abrir reclamo' !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                <p>Desea {!! ($reclamo->estado->slug == 'abierto')? 'cerrar' : 'abrir' !!} el reclamo</p>
                            </div>
                            <div class="card-footer">
                                {!! Form::open(['method' => 'put', 'url' => route('reclamos.change.status', $reclamo->id), 'class' => 'form']) !!}
                                    <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger" title="CERRAR">Aceptar</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endpermission

                @permission('ver.reclamo')
                    <a href="{{ route('reclamos.show', ['id' => $reclamo->id, 'reclamoFecha' => null]) }}" class="btn btn-success btn-xs" title="Info"><i class="fa fa-eye"></i> </a>
                @endpermission

                {{--@permission('editar.producto')--}}
                    {{--<a href="{{ route('productos.edit', ['id' => $reclamo->id]) }}" title="Editar" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>--}}
                {{--@endpermission--}}

                @permission('eliminar.reclamo')
                    <button type="button" title="ELIMINAR" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#eliminarReclamo{!! $reclamo->id !!}" >
                        <i class="fa fa-trash-o"></i>
                    </button>
                    <div class="modal fade" id="eliminarReclamo{!! $reclamo->id !!}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar reclamo</h4>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Usted está a punto de elminar al reclamo<br>
                                        <em class="text-danger">{!! $reclamo->nombre !!}</em>
                                    </p>
                                    <p>¿Desea continuar?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                    {!! Form::open(['method' => 'delete', 'url' => route('productos.destroy', $reclamo->id)]) !!}
                                    <button type="submit" title="ELIMINAR" class="btn btn-danger" data-toggle="modal" data-target="#eliminarReclamo{!! $reclamo->id !!}" >
                                        Eliminar
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endpermission

                @permission('ver.updateable')
                <a href="{{ route('updateables.entidad.show', ['entity' => $reclamo->getClass(), 'id' => $reclamo->id]) }}" class="btn btn-updateable btn-xs" title="movimientos"><i class="fa fa-info-circle"></i> </a>
                @endpermission

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
