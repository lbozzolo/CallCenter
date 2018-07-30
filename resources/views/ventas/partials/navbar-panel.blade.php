<ul class="list-unstyled list-inline">
    <li>
        Estado: <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
    </li>
    <li>
        Importe:
        <span class="text-primary">${!! $venta->importe_total !!}</span>
    </li>
    @if($venta->estado->slug != 'cancelada')
        <li>
            <button type="button" class="nonStyledButton" data-toggle="modal" data-target="#cierreVenta">
                <i class="fa fa-legal"></i>
                Legales
            </button>
        </li>
        @permission('aceptar.venta')
        <li>
            <button type="button" class="nonStyledButton" data-toggle="modal" data-target="#aceptarVenta">
                <i class="fa fa-check text-success"></i>
                Aceptar
            </button>
            <div class="modal fade" id="aceptarVenta">
                <div class="modal-dialog">
                    <div class="modal-content">
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
                            {!! Form::submit('Aceptar', ['class' => 'btn btn-success']) !!}
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </li>
        @endpermission
        @permission('cancelar.venta')
        <li>
            <button type="button" class="nonStyledButton" data-toggle="modal" data-target="#cancelarVenta">
                <i class="fa fa-ban text-danger"></i>
                Cancelar
            </button>
            <div class="modal fade" id="cancelarVenta">
                <div class="modal-dialog">
                    <div class="modal-content">
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
                            {!! Form::submit('Cancelar venta', ['class' => 'btn btn-danger']) !!}
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
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
            <div class="modal fade" id="retomarVenta">
                <div class="modal-dialog">
                    <div class="modal-content">
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
                            {!! Form::submit('Retomar venta', ['class' => 'btn btn-primary']) !!}
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </li>
        @endpermission
    @endif
</ul>

<div class="modal fade" id="cierreVenta">
    <div class="modal-dialog">
        <div class="modal-content">
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
</div>
