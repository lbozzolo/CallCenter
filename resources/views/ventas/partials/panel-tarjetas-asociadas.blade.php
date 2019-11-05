<div class="card">
    <div class="card-header">
        <ul class="list-unstyled list-inline">
            <li><h3>{!! $venta->cliente->fullname !!}</h3></li>
            @permission('agregar.tarjeta.cliente')
            <li><button class="nonStyledButton" style="color:cyan" id="botonNuevaTarjeta"><i class="fa fa-plus"></i> Agregar</button> </li>
            @endpermission
        </ul>
        @if($venta->cliente->hasCard('credito') || $venta->cliente->hasCard('debito'))
        <h4>Tarjetas asociadas</h4>
        @endif
    </div>
    <div class="card-body">

        @permission('agregar.tarjeta.cliente')
        @include('ventas.partials.agregar-tarjeta-asociada')
        @endpermission

        @if($venta->cliente->hasCard('credito') || $venta->cliente->hasCard('debito'))
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: gray">
                        <th>Tarjeta</th>
                        <th>Banco</th>
                        <th>Nº Tarjeta</th>
                        <th>Código</th>
                        <th>Titular</th>
                        <th>Fecha expiración</th>
                        <th style="width: 100px">Opciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($venta->cliente->datosTarjeta as $tarjeta)

                        <tr id="showTarjetaAsociada{!! $tarjeta->id !!}" class="showTarjetaAsociada">
                            <td>{!! $tarjeta->marca->nombre !!}</td>
                            <td>{!! $tarjeta->banco->nombre !!}</td>
                            <td>{!! $tarjeta->card_number !!}</td>
                            <td>{!! $tarjeta->security_number !!}</td>
                            <td>{!! $tarjeta->titular !!}</td>
                            <td>
                                {!! $tarjeta->expiration_date !!}
                                @if($tarjeta->isExpired())
                                <span class="label label-danger">tarjeta vencida</span>
                                @endif
                            </td>
                            <td>
                                @permission('editar.tarjeta.cliente')
                                <button type="button" class="btn btn-primary btn-flat botonEditarTarjetaAsociada" data-id="{!! $tarjeta->id !!}"><i class="fa fa-edit"></i></button>
                                @endpermission
                                @permission('eliminar.tarjeta.cliente')
                                <button type="button" title="Eliminar tarjeta" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#eliminarTarjeta{!! $tarjeta->id !!}">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                <div class="modal fade col-lg-2 col-lg-offset-10" id="eliminarTarjeta{!! $tarjeta->id !!}">
                                    <div class="card">
                                        <div class="card-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Eliminar Tarjeta</h4>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-danger">¿Desea eliminar esta tarjeta?</p>
                                        </div>
                                        <div class="card-footer">

                                            {!! Form::open(['url' => route('clientes.eliminar.tarjeta', $tarjeta->id), 'method' => 'delete']) !!}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                                @endpermission
                            </td>
                        </tr>

                        @permission('editar.tarjeta.cliente')
                        @include('ventas.partials.editar-tarjeta-asociada')
                        @endpermission

                    @endforeach

                </tbody>
            </table>
        </div>
        @else
            <span class="text-muted">No hay ninguna tarjeta asociada a este cliente</span><br>
        @endif

    </div>
</div>