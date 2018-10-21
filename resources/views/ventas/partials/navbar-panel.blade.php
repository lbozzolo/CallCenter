<div class="row">
    <div class="col-lg-8">
        <ul class="list-inline panel" style="padding: 8px">
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
                    <div class="modal fade col-lg-3 col-lg-offset-4" id="aceptarVenta">
                        <div class="card">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Aceptar venta</h4>
                            </div>
                            {!! Form::open(['url' => route('ventas.aceptar'), 'method' => 'put']) !!}
                            <div class="modal-body">
                                <p>¿Desea aceptar esta venta?</p>
                            </div>
                            <div class="modal-footer">
                                {!! Form::hidden('venta_id', $venta->id) !!}
                                <button type="submit" class="btn btn-success pull-left">Aceptar</button>
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            </div>
                            {!! Form::close() !!}
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
            @else
                @permission('retomar.venta')
                <li>
                    <button type="button" class="nonStyledButton" data-toggle="modal" data-target="#retomarVenta">
                        <i class="fa fa-rotate-right text-primary"></i>
                        Retomar
                    </button>
                    <div class="modal fade col-lg-3 col-lg-offset-4" id="retomarVenta">
                        <div class="card">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Retomar venta</h4>
                            </div>
                            {!! Form::open(['url' => route('ventas.retomar'), 'method' => 'put']) !!}
                            <div class="modal-body">
                                <p>¿Desea retomar esta venta?</p>
                            </div>
                            <div class="modal-footer">
                                {!! Form::hidden('venta_id', $venta->id) !!}
                                <button type="submit" class="btn btn-success pull-left">Retomar venta</button>
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
