@if(!$venta->cobrada)

    <div class="text-danger">Esta venta está pendiente de cobro</div>

    @permission('marcar.venta.como.cobrada')
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#marcarComoCobrada">Marcar como COBRADA</button>
    <div class="modal fade col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="marcarComoCobrada">
        <div class="card text-left">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Marcar esta venta como Cobrada</h4>

            <div class="card card-body">
                {!! Form::open(['url' => route('ventas.cambiar.cobrada', $venta->id), 'method' => 'put']) !!}
                <div class="form-group">
                    <p>¿Desea marcar esta venta como COBRADA?</p>
                    {!! Form::text('numero_transaccion', ($venta->numero_transaccion)? $venta->numero_transaccion :null, ['style' => 'width: 100%; border: 1px solid #262c3f; padding: 5px 10px', 'placeholder' => 'Ingrese el número de transacción', 'autocomplete' => 'off']) !!}
                    <span class="text-danger">* campo obligatorio</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary ">Aceptar</button>
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                </div>

                {!! Form::close() !!}
            </div>

        </div>
    </div>
    @endpermission

@else

    <div style="margin-bottom: 5px">
        <span class="text-success">Venta COBRADA</span> -
        <span class="text-warning">Nº de TRANSACCIÓN: {!! $venta->numero_transaccion !!}</span>
    </div>

    @permission('marcar.venta.como.cobrada')
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#deshacerCobrada">Marcar como NO COBRADA</button>
    <div class="modal fade col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3" id="deshacerCobrada">
        <div class="card text-left">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Marcar esta venta como NO Cobrada</h4>

            <div class="card card-body">
                {!! Form::open(['url' => route('ventas.cambiar.cobrada', $venta->id), 'method' => 'put']) !!}
                <div class="form-group">
                    <p>¿Desea marcar esta venta como NO COBRADA?</p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary ">Aceptar</button>
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                </div>

                {!! Form::close() !!}
            </div>

        </div>
    </div>
    @endpermission

@endif