<div class="card">
    <div class="card-header">
        <ul class="list-unstyled list-inline">
            <li><h3>{!! $venta->cliente->fullname !!}</h3></li>
            <li><button class="nonStyledButton" style="color:cyan" id="botonNuevaTarjeta"><i class="fa fa-plus"></i> Agregar</button> </li>
        </ul>
        <h4>Tarjetas asociadas</h4>
    </div>
    <div class="card-body">


        @include('ventas.partials.agregar-tarjeta-asociada')


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
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @if($venta->cliente->hasCard('credito') || $venta->cliente->hasCard('debito'))
                    @foreach($venta->cliente->datosTarjeta as $tarjeta)
                        <tr>
                            <td>{!! $tarjeta->marca->nombre !!}</td>
                            <td>{!! $tarjeta->banco->nombre !!}</td>
                            <td>{!! $tarjeta->card_number !!}</td>
                            <td>{!! $tarjeta->security_number !!}</td>
                            <td>{!! $tarjeta->titular !!}</td>
                            <td>{!! $tarjeta->expiration_date !!}</td>
                            <td>
                                <button type="button" title="Eliminar tarjeta" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#eliminarTarjeta{!! $tarjeta->id !!}" style="border: none">
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
                            </td>
                        </tr>
                    @endforeach
                @else
                    <span class="text-muted">No hay ninguna tarjeta asociada a este cliente</span><br>
                @endif
                </tbody>
            </table>
        </div>



    </div>
</div>