
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

        @if(!$venta->plan_cuotas)

            <div class="card">
                <div class="card-body">
                    <i class="fa fa-exclamation-triangle text-danger"></i>
                    <span class="text-warning lead">ATENCION. No se puede aceptar la venta. Debe seleccionar al menos un plan de cuotas.</span>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Entendido</button>
                </div>
            </div>

        @else

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
                                    <td>
                                        {!! $metodoPago->datosTarjeta->marca->nombre !!}
                                        ({!! $metodoPago->datosTarjeta->titular !!})
                                    </td>
                                    <td>${!! $metodoPago->importe !!}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No hay ningún método de pago seleccionado aún.</td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td>Importe total</td>
                                    <td>${!! $venta->suma_metodos_de_pago !!}</td>
                                </tr>
                            </tfooter>
                        </table>
                    </div>
                    <p class="panel panel-barra">Importe</p>
                    <ul class="list-unstyled listado">
                        <li class="list-group-item">
                            Importe total productos:
                            <span class="pull-right">${!! $venta->totalPorCuotas($venta->plan_cuotas) !!}</span>
                        </li>
                        <li class="list-group-item">
                            Total métodos de pago:
                            <span class="pull-right">${!! $venta->suma_metodos_de_pago !!}</span>
                        </li>
                    </ul>



                </div>
            </div>

            <div class="modal-footer">
                {!! Form::open(['url' => route('ventas.aceptar'), 'method' => 'put']) !!}

                @if($venta->diferenciaMetodosPagoSumaProductos($venta->plan_cuotas) > 0)

                    <div class="form-group text-left">
                        <i class="fa fa-exclamation-triangle text-warning"></i>
                        <span class="lead text-danger">ATENCIÓN. La suma de los métodos de pago es inferior al importe total de la venta.</span><br>
                        <span>La diferencia es de ${!! $venta->diferenciaMetodosPagoSumaProductos($venta->plan_cuotas) !!}</span>
                    </div>
                    <div class="form-group text-left">
                        <span class="text-warning">¿Desea aceptar esta venta de todos modos?</span>
                    </div>
                    <button type="submit" class="btn btn-warning pull-left">Aceptar de todos modos</button>

                @elseif($venta->diferencia_con_ajuste < 0)


                    <div class="form-group text-left">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span class="lead text-danger">ATENCIÓN. La suma de los métodos de pago es superior al importe total de la venta.</span><br>
                        <span>La diferencia es de ${!! $venta->diferenciaMetodosPagoSumaProductos() !!}</span>
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

        @endif
    </div>
</div>
