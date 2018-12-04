<div class="row">
    <div class="col-lg-8">
        <ul class="list-inline panel panel-barra">
            @if($venta->estado->slug != 'cancelada')
                <li>
                    <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#cierreVenta">
                        <i class="fa fa-legal"></i>
                        Legales
                    </button>
                </li>
                @permission('aceptar.venta')
                <li>
                    <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#aceptarVenta">
                        <i class="fa fa-check text-success"></i>
                        Aceptar venta
                    </button>
                    <div class="modal fade col-lg-4 col-lg-offset-4" id="aceptarVenta">
                        <div class="card">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Aceptar venta</h4>
                            </div>

                                <div class="card">
                                    <div class="card-body">

                                        <p class="lead">Cliente: {!! $venta->cliente->fullname !!}</p>
                                        <p class="panel panel-barra">Productos</p>
                                        <ul class="list-unstyled listado">
                                            @forelse($venta->productos as $producto)
                                                <li class="list-group-item" style="background-color: gray">{!! $producto->nombre !!}, {!! $producto->marca->nombre !!}</li>
                                            @empty
                                                <li class="list-group-item">No hay ningún producto cargado</li>
                                            @endforelse
                                        </ul>
                                        <p class="panel panel-barra">Métodos de pago</p>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-condensed">
                                                <tbody>
                                                @forelse($venta->metodoPagoVenta as $metodoPago)
                                                    <tr>
                                                        <td>{!! $metodoPago->metodoPago->nombre !!}</td>
                                                        <td>${!! $metodoPago->importe_mas_promocion !!}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>No hay ningún método de pago seleccionado aún.</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                                <tfooter>
                                                    <tr>
                                                        <td>Importe total + IVA (21%)</td>
                                                        <td>${!! $venta->importe_total !!}</td>
                                                    </tr>
                                                </tfooter>
                                            </table>
                                        </div>
                                        <p class="panel panel-barra">Importe</p>
                                        <ul class="list-unstyled listado">
                                            <li class="list-group-item">
                                                Importe productos:
                                                <span class="pull-right">${!! $venta->suma_subtotal_productos !!}</span>
                                            </li>
                                            <li class="list-group-item">
                                                IVA (21%)
                                                <span class="pull-right">${!! $venta->suma_productos_iva !!}</span>
                                            </li>
                                            <li class="list-group-item">
                                                Total productos:
                                                <span class="pull-right">${!! $venta->suma_total_productos !!}</span>
                                            </li>
                                            <li class="list-group-item">
                                                Total métodos de pago:
                                                <span class="pull-right">${!! $venta->importe_total !!}</span>
                                            </li>
                                        </ul>


                                    </div>
                                </div>

                            <div class="modal-footer">
                            {!! Form::open(['url' => route('ventas.aceptar'), 'method' => 'put']) !!}

                                @if($venta->diferencia_con_ajuste > 0)

                                    <div class="form-group text-left">
                                        <i class="fa fa-exclamation-triangle text-warning"></i>
                                        <span class="lead text-danger">ATENCIÓN. La suma de los métodos de pago es inferior al importe total de la venta.</span><br>
                                        <span>La diferencia es de ${!! $venta->diferencia_con_ajuste !!}</span>
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="text-warning">¿Desea aceptar esta venta de todos modos?</span>
                                    </div>
                                    <button type="submit" class="btn btn-warning pull-left">Aceptar de todos modos</button>

                                @elseif($venta->diferencia_con_ajuste < 0)


                                    <div class="form-group text-left">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        <span class="lead text-danger">ATENCIÓN. La suma de los métodos de pago es superior al importe total de la venta.</span><br>
                                        <span>La diferencia es de ${!! $venta->diferencia_con_ajuste !!}</span>
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="text-warning">¿Desea aceptar esta venta de todos modos?</span>
                                    </div>
                                    <button type="submit" class="btn btn-warning pull-left">Aceptar de todos modos</button>

                                @else

                                    <div class="form-group text-left">
                                        <span class="text-warning">¿Desea aceptar esta venta?</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-left">Aceptar</button>

                                @endif

                                {!! Form::hidden('venta_id', $venta->id) !!}
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                            {!! Form::close() !!}
                                </div>
                        </div>
                    </div>
                </li>
                @endpermission
                @permission('cancelar.venta')
                <li>
                    <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#cancelarVenta">
                        <i class="fa fa-ban"></i>
                        Cancelar venta
                    </button>
                    <div class="modal fade col-lg-3 col-lg-offset-4" id="cancelarVenta">
                        <div class="card">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Cancelar venta</h4>
                            </div>
                            {!! Form::open(['url' => route('ventas.cancelar'), 'method' => 'put']) !!}
                            <div class="modal-body">
                                <p>¿Desea cancelar esta venta?</p>
                                {!! Form::text('motivo', null, ['class' => 'form-control', 'placeholder' => 'Describa aquí el motivo de la cancelación']) !!}
                                <small class="text-warning">* El motivo es obligatorio</small>
                            </div>
                            <div class="modal-footer">
                                {!! Form::hidden('venta_id', $venta->id) !!}
                                <button type="submit" class="btn btn-danger pull-left">Cancelar venta</button>
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </li>
                @endpermission
            @endif
            <li>
                <span class="text-primary" style="font-size: 1.5em">${!! $venta->suma_total_productos !!}</span>
            </li>
        </ul>
    </div>
    <div class="col-lg-4">
        <ul class="list-inline panel row" style="padding: 5px">
            <li class="col-lg-3">
                Nº de GUÍA<br>
                @if($venta->numero_guia)
                    <small class="text-muted">({!! $venta->numero_guia !!})</small>
                @endif
            </li>
            <li class="col-lg-9">
                {!! Form::model($venta, ['url' => route('ventas.numero.guia', $venta->id), 'method' => 'post']) !!}

                <div class="input-group margin">
                    {!! Form::text('numero_guia', $venta->numero_guia, ['class' => 'form-control']) !!}
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" style="padding: 9px 5px" data-target="#guardarNumeroGuia" data-toggle="modal">Guardar</button>
                    </span>
                </div>

                <div class="modal fade col-lg-3 col-lg-offset-9" id="guardarNumeroGuia">
                    <div class="card">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Guardar Número de guía</h4>
                        </div>
                        <div class="modal-body">
                            <p>¿Desea guardar el número de guía?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </li>
        </ul>
    </div>
</div>


<div class="modal fade col-lg-4 col-lg-offset-3" id="cierreVenta">
    <div class="card">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cierre de venta</h4>
        </div>
        <div class="modal-body">

            {{ config('sistema.ventas.cierre') }}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
