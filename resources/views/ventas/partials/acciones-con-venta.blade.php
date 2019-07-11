@if(Auth::user()->is('auditor|superadmin') && $venta->statusIs('auditable'))

    <p>Marcar esta venta como</p>
    <div style="display: inline-block;">
        <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#confirmarVenta">
            <label class="label estadoVentas" data-estado="confirmada">CONFIRMADA</label>
        </button>
        <div class="modal fade col-lg-3 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="confirmarVenta">
            <div class="card text-left">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmar venta</h4>

                <div class="card card-body">
                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                    <div class="form-group">
                        <p>¿Desea confirmar esta venta?</p>
                        {!! Form::hidden('estado_id', 4) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        <button type="submit" class="btn btn-primary ">Aceptar</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <div style="display: inline-block;">
        <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#rechazarVenta">
            <label class="label estadoVentas" data-estado="rechazada">RECHAZADA</label>
        </button>
        <div class="modal fade col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="rechazarVenta">
            <div class="card text-left">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Rechazar venta</h4>

                <div class="card card-body">
                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                    <div class="form-group">
                        <p>¿Desea rechazar esta venta?</p>
                        {!! Form::hidden('estado_id', 5) !!}
                        {!! Form::text('motivo', null, ['class' => 'form-control', 'placeholder' => 'Describa aquí el motivo de rechazo']) !!}
                        <small class="text-warning">* El motivo es obligatorio</small>
                    </div>

                    <div class="form-group">
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        <button type="submit" class="btn btn-danger ">Rechazar venta</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

@endif

@if(Auth::user()->is('facturacion|superadmin') && $venta->statusIs('confirmada'))

    <p>Marcar esta venta como</p>
    <div style="display: inline-block;">
        <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#marcarComoFacturada">
            <label class="label estadoVentas" data-estado="facturada">FACTURADA</label>
        </button>
        <div class="modal fade col-lg-3 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="marcarComoFacturada">
            <div class="card text-left">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Marcar venta como facturada</h4>

                <div class="card card-body">
                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                    <div class="form-group">
                        <p>¿Desea marcar esta venta como FACTURADA?</p>
                        {!! Form::hidden('estado_id', 7) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        <button type="submit" class="btn btn-primary ">Aceptar</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <div style="display: inline-block;">
        <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#marcarComoAuditable">
            <label class="label estadoVentas" data-estado="auditable">AUDITABLE</label>
        </button>
        <div class="modal fade col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="marcarComoAuditable">
            <div class="card text-left">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Marcar venta como auditable</h4>

                <div class="card card-body">
                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                    <div class="form-group">
                        <p>¿Desea marcar esta venta como AUDITABLE?</p>
                        {!! Form::hidden('estado_id', 3) !!}
                        {!! Form::text('motivo', null, ['class' => 'form-control', 'placeholder' => 'Describa aquí el motivo.']) !!}
                        <small class="text-warning">* El motivo es obligatorio</small>
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        <button type="submit" class="btn btn-primary ">Aceptar</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <div style="display: inline-block;">
        <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#marcarComoCancelada">
            <label class="label estadoVentas" data-estado="cancelada">CANCELADA</label>
        </button>
        <div class="modal fade col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="marcarComoCancelada">
            <div class="card text-left">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cancelar venta</h4>

                <div class="card card-body">
                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                    <div class="form-group">
                        <p>¿Desea cancelar esta venta?</p>
                        {!! Form::hidden('estado_id', 2) !!}
                        {!! Form::text('motivo', null, ['class' => 'form-control', 'placeholder' => 'Describa aquí el motivo de cancelación.']) !!}
                        <small class="text-warning">* El motivo es obligatorio</small>
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        <button type="submit" class="btn btn-primary ">Aceptar</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

@endif

@if(Auth::user()->is('logistica|superadmin') && $venta->statusIs('facturada'))

    <p>Marcar esta venta como</p>
    <div style="display: inline-block;">
        <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#marcarComoEnviada">
            <label class="label estadoVentas" data-estado="enviada">ENVIADA</label>
        </button>
        <div class="modal fade col-lg-3 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="marcarComoEnviada">
            <div class="card text-left">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Marcar venta como enviada</h4>

                <div class="card card-body">
                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                    <div class="form-group">
                        <p>¿Desea marcar esta venta como ENVIADA?</p>
                        {!! Form::hidden('estado_id', 8) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        <button type="submit" class="btn btn-primary ">Aceptar</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

@endif

@if(Auth::user()->is('logistica|superadmin') && $venta->statusIs('enviada'))
    <p>Marcar esta venta como</p>
    <div style="display: inline-block;">

        <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#marcarComoEntregada">
            <label class="label estadoVentas" data-estado="entregado">ENTREGADA</label>
        </button>
        <div class="modal fade col-lg-3 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="marcarComoEntregada">
            <div class="card text-left">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title">Marcar esta venta como entregada</h4>
                <div class="card card-body">

                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                    <div class="form-group">
                        <p>¿Desea marcar esta venta como ENTREGADA?</p>
                        {!! Form::hidden('estado_id', 9) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        <button type="submit" class="btn btn-primary ">Aceptar</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <div style="display: inline-block;">
        <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#marcarComoNoEntregada">
            <label class="label estadoVentas" data-estado="noentregado">NO ENTREGADA</label>
        </button>
        <div class="modal fade col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3" id="marcarComoNoEntregada">
            <div class="card text-left">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Marcar esta venta como NO entregada</h4>

                <div class="card card-body">
                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                    <div class="form-group">
                        <p>¿Desea marcar esta venta como NO ENTREGADA?</p>
                        {!! Form::hidden('estado_id', 10) !!}
                        {!! Form::text('motivo', null, ['class' => 'form-control', 'placeholder' => 'Describa aquí el motivo por el cual no se entregó']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        <button type="submit" class="btn btn-primary ">Aceptar</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <div style="display: inline-block;">
        <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#marcarComoDevuelta">
            <label class="label estadoVentas" data-estado="devuelto">DEVUELTA</label>
        </button>
        <div class="modal fade col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3" id="marcarComoDevuelta">
            <div class="card text-left">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Marcar como devuelta</h4>

                <div class="card card-body">
                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                    <div class="form-group">
                        <p>¿Desea marcar esta venta como DEVUELTA?</p>
                        {!! Form::hidden('estado_id', 11) !!}
                        {!! Form::text('motivo', null, ['class' => 'form-control', 'placeholder' => 'Describa aquí el motivo por el cual fue devuelta']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        <button type="submit" class="btn btn-primary ">Aceptar</button>
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

@endif