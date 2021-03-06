<div class="row">
    <div class="col-lg-8">
        <ul class="list-inline panel panel-barra">
            @if($venta->estado->slug != 'cancelada')
                <li>
                    <button type="button" class="btn btn-info btn-outline btn-flat" data-toggle="modal" data-target="#cierreVenta">LEGALES</button>
                </li>
                @permission('aceptar.venta')
                @if($venta->statusIs('iniciada') || $venta->statusIs('programada'))
                <li>
                    @include('ventas.partials.aceptar-venta')
                </li>
                @endif
                @endpermission
                @permission('programar.venta')
                @if(!$venta->statusIs('programada'))
                <li>
                    <button type="button" class="btn btn-warning btn-outline btn-flat" data-toggle="modal" data-target="#programarVenta">
                        <i class="fa fa-clock-o"></i>
                        Programar venta
                    </button>
                    <div class="modal fade col-lg-5 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="programarVenta">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Programar venta</h4>

                                {!! Form::open(['url' => route('ventas.programar'), 'method' => 'put']) !!}
                                <div class="form-group">
                                    <p>¿Desea programar esta venta?</p>
                                    {!! Form::text('motivo', null, ['class' => 'form-control', 'placeholder' => 'Describa aquí el motivo de la cancelación']) !!}
                                    <small class="text-warning">* El motivo es obligatorio</small>
                                </div>

                                <div class="form-group">
                                    {!! Form::hidden('venta_id', $venta->id) !!}
                                    <button type="submit" class="btn btn-warning ">Programar venta</button>
                                    <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </li>
                @endif
                @endpermission
                <li>
                    <button type="button" class="btn btn-danger btn-outline btn-flat" data-toggle="modal" data-target="#cancelarVenta">
                        <i class="fa fa-ban"></i>
                        Cancelar venta
                    </button>
                    <div class="modal fade col-lg-3 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="cancelarVenta">
                        <div class="card">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Cancelar venta</h4>

                            {!! Form::open(['url' => route('ventas.cancelar'), 'method' => 'put']) !!}
                            <div class="form-group">
                                <p>¿Desea cancelar esta venta?</p>
                                {!! Form::text('motivo', null, ['class' => 'form-control', 'placeholder' => 'Describa aquí el motivo de la cancelación']) !!}
                                <small class="text-warning">* El motivo es obligatorio</small>
                            </div>

                            <div class="form-group">
                                {!! Form::hidden('venta_id', $venta->id) !!}
                                <button type="submit" class="btn btn-danger ">Cancelar venta</button>
                                <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </li>
            @endif
            {{--<li>--}}
                {{--<span class="text-primary" style="font-size: 1.5em">${!! $venta->totalPorCuotas($venta->plan_cuotas) !!}</span>--}}
            {{--</li>--}}
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
