
<button type="button" class="btn btn-success btn-outline btn-flat @if(!$venta->metodoPagoVenta->count()) disabled @endif" data-toggle="modal" data-target="#aceptarVenta">
    <i class="fa fa-check text-success"></i>
    Aceptar venta
</button>
<div class="modal fade col-lg-5 col-lg-offset-4" id="aceptarVenta">
    <div class="card">

{{--        @if(!$venta->plan_cuotas || $venta->totalPorCuotas($venta->plan_cuotas) <= 0 || $venta->metodoPagoVenta->count() == 0 || count($productosVenta) == 0 || !$venta->cobrada)--}}
        @if(!$venta->canAccept())

            <div class="card">
                <div class="card-body">
                    <div class="panel panel-body">
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                        <span class="text-warning lead">ATENCION. No se puede aceptar la venta.</span>
                    </div>

                    <p class="lead">¿Por qué?</p>
                    <ul>
                        @if(!$venta->plan_cuotas)
                            <li>- No ha seleccionado un plan de cuotas aún.</li>
                        @endif
                        @if($venta->totalPorCuotas($venta->plan_cuotas) <= 0)
                            <li>- El importe de la venta es igual a cero.</li>
                        @endif
                        @if($venta->metodoPagoVenta->count() == 0)
                            <li>- No hay ningún método de pago seleccionado.</li>
                        @endif
                        @if(count($productosVenta) == 0)
                            <li>- No hay productos cargados.</li>
                        @endif
                        @if(!$venta->cobrada)
                            <li>- La venta no ha sido marcada como cobrada.</li>
                        @endif
                    </ul>
                </div>
                <div class="card ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Entendido <i class="fa fa-thumbs-up"></i></button>
                </div>
            </div>

        @else

            <div class="card">
                <div class="card-body">


                    <p class="lead">Cliente: {!! $venta->cliente->fullname !!}</p>
                    <p class="panel panel-barra" style="margin-bottom: 0px">Productos</p>
                    <ul class="list-unstyled listado">
                        @forelse($productosVenta as $group)
                            @foreach($group->groupBy('id') as $producto)
                            <li class="list-group-item" style="background-color: gray">
                                <span class="text-warning" style="border: 1px solid orange; border-radius: 15px; padding: 2px 7px">{!! $producto->count() !!} un</span>
                                {!! $producto->first()->nombre !!}, {!! $producto->first()->marca->nombre !!}
                                (${!! $producto->first()->precio !!})
                                <span class="pull-right">
                                    ${!! $producto->first()->precioMasInteresCuota($venta->plan_cuotas, $producto->count()) !!}
                                    {{--${!! number_format($producto->first()->precio * $producto->count(), 2, ',', '.') !!}--}}
                                </span>
                            </li>
                            @endforeach
                        @empty
                            <li class="list-group-item">No hay ningún producto cargado</li>
                        @endforelse
                        <li class="list-group-item">
                            Gastos de envío:
                            <span class="pull-right">${!! $venta->gastosEnvioFormatted(null, $venta->envio) !!}</span>
                        </li>
                        <li class="list-group-item" style="border-top: 2px solid white!important;">
                            Total:
                            <span class="pull-right">
                                ${!! $venta->subtotalProductosMasGastosEnvio($venta->plan_cuotas) !!}
{{--                                ${!! number_format($venta->sumaTotalProductos($venta->plan_cuotas), 2, ',', '.') !!}--}}
                            </span>
                        </li>
                    </ul>
                    <p class="panel panel-barra" style="margin-bottom: 0px">Métodos de pago</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <tbody>
                            @forelse($venta->metodoPagoVenta as $metodoPago)
                                <tr>
                                    <td>
                                        {!! $metodoPago->datosTarjeta->marca->nombre !!}
                                        ({!! $metodoPago->datosTarjeta->titular !!})
                                    </td>
                                    <td>${!! $metodoPago->importe_formatted !!}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No hay ningún método de pago seleccionado aún.</td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Importe total</td>
                                    <td class="text-right">${!! $venta->suma_metodos_de_pago !!}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <p class="panel panel-barra" style="margin-bottom: 0px">Importes totales</p>
                    <ul class="list-unstyled listado">
                        <li class="list-group-item">
                            Total productos + gastos de envío
                            @if($venta->ajuste) ( + AJUSTE = <span class="text-warning">${!! $venta->ajuste !!}</span> )  @endif
                            <span class="pull-right">${!! $venta->totalPorCuotas($venta->plan_cuotas) !!}</span>
                        </li>
                        <li class="list-group-item">
                            Total métodos de pago
                            <span class="pull-right">${!! $venta->suma_metodos_de_pago !!}</span>
                        </li>
                    </ul>



                </div>
            </div>

            <div class="modal-footer">
                {!! Form::open(['url' => route('ventas.aceptar'), 'method' => 'put']) !!}

                @if($venta->statusIs('rechazada'))

                    <div class="form-group text-left bg-danger" style="padding: 10px">
                        <i class="fa fa-exclamation-triangle text-warning"></i>
                        <span>ATENCIÓN. Esta venta fue rechazada por auditoría.</span><br>
                        @if($venta->motivo)
                            <span>Motivo: {!! $venta->motivo !!}</span>
                        @endif
                        <div class="text-warning" style="padding: 10px">¿Desea aceptar esta venta de todos modos?</div>
                        <div>
                            <button type="submit" class="btn btn-warning " style="margin-right: 3px">Aceptar de todos modos</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>

                @else

                    @if($venta->diferenciaMetodosPagoSumaProductos($venta->plan_cuotas) > 0)

                        <div class="form-group text-left bg-danger" style="padding: 10px">
                            <i class="fa fa-exclamation-triangle text-warning"></i>
                            <span>ATENCIÓN. La suma de los métodos de pago es inferior al importe total de la venta.</span><br>
                            <span>La diferencia es de ${!! $venta->diferenciaMetodosPagoSumaProductos($venta->plan_cuotas) !!}</span>
                            <div class="text-warning" style="padding: 10px">¿Desea aceptar esta venta de todos modos?</div>
                            <div>
                                <button type="submit" class="btn btn-warning " style="margin-right: 3px">Aceptar de todos modos</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>

                    @elseif($venta->diferenciaMetodosPagoSumaProductos($venta->plan_cuotas) < 0)

                        <div class="form-group text-left bg-danger" style="padding: 10px">
                            <i class="fa fa-exclamation-triangle"></i>
                            <span>ATENCIÓN. La suma de los métodos de pago es superior al importe total de la venta.</span><br>
                            <span>La diferencia es de ${!! $venta->diferenciaMetodosPagoSumaProductos($venta->plan_cuotas) !!}</span>
                            <div class="text-warning" style="padding: 10px">¿Desea aceptar esta venta de todos modos?</div>
                            <div>
                                <button type="submit" class="btn btn-warning " style="margin-right: 3px">Aceptar de todos modos</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>

                    @else

                        <div class="form-group text-left">
                            <span class="text-warning">¿Desea aceptar esta venta?</span>
                        </div>
                        <button type="submit" class="btn btn-primary pull-left">Aceptar</button>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    @endif

                @endif


                {!! Form::hidden('venta_id', $venta->id) !!}


                {!! Form::close() !!}
            </div>

        @endif
    </div>
</div>
