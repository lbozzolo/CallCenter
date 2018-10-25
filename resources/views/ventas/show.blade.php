@extends('ventas.base')

@section('titulo')

    <h2>Ventas<span class="text-muted"> / Datos</span> </h2>

@endsection


@section('contenido')

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <h3>
                            <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
                            Venta #{!! $venta->id !!}
                            <small class="text-muted"> / operador: {!! $venta->user->full_name !!}</small>
                        </h3>
                    </div>
                    <div class="col-lg-3 col-md-12 text-right">
                        <span class="text-primary" style="font-size: 2.5em">${!! $venta->importe_total !!}</span>
                        @if($venta->has_cuotas)
                            <div class="text-muted">
                                {!! $venta->has_cuotas->cuota_cantidad !!} cuotas de <span class=" text-primary">${!! $venta->valor_cuota !!}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-6">

                <div class="col-12">
                    <div class="card card-default" style="height: 310px">
                        <div class="card-header">
                            <h3 class="card-title">Información general</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled listado">
                                <li class="list-group-item">Operador: {!! $venta->user->full_name !!}</li>
                                <li class="list-group-item">
                                    Cliente: {!! $venta->cliente->full_name !!}
                                    <a href="{{ route('clientes.show', $venta->cliente->id) }}" class="btn btn-default btn-xs pull-right">ver</a>
                                </li>
                                <li class="list-group-item">Fecha de venta: {!! $venta->fecha_creado !!}</li>
                                <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                                <li class="list-group-item">Número de guía: {!! $venta->numero_guia !!}</li>
                                @permission('ver.reclamos.venta')
                                <li class="list-group-item">
                                    <span style="padding: 10px 5px;"><a href="{!! route('ventas.reclamos', $venta->id) !!}" style="color: cyan">Reclamos ( {!! $venta->reclamos->count() !!} )</a></span>
                                </li>
                                @endpermission
                            </ul>
                        </div>

                    </div>

                </div>


            </div>

            <div class="col-lg-6">
                @permission('editar.venta')
                <div class="col-12">
                    <div class="card card-default" style="height: 310px">
                        <div class="card-header">
                            <h3 class="card-title">Editar venta</h3>
                        </div>
                        <div class="card-body">
                            <p>Marcar esta venta como...</p>

                            {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                            <div class="form-group">
                                <div class="input-group input-group">
                                    {!! Form::select('estado_id', $estados, $venta->estado_id, ['class' => 'form-control select2', 'id' => 'selectEstados']) !!}
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flag">Aplicar</button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('motivo', 'Motivo') !!}
                                {!! Form::text('motivo', null, ['id' => 'cancelacion', 'class' => 'form-control', 'placeholder' => 'De ser necesario, describa aquí el motivo del cambio de estado']) !!}
                                <small class="text-warning">* El motivo es obligatorio sólo en el caso de cancelar la venta</small>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
                @endpermission
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="list-unstyled list-inline">
                            <li><h3>Productos</h3></li>
                            <li>
                                <button class="nonStyledButton" style="color:cyan" id="botonNuevoProducto"><i class="fa fa-plus"></i> Agregar</button>
                                <button class="btn btn-default" id="botonNuevoProductoCancelar" style="display: none">Cancelar</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        @include('ventas.partials.busqueda-productos')

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background-color: gray">
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Descripción</th>
                                    <th>Categorías</th>
                                    <th>Medida</th>
                                    <th>Precio</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($venta->productos as $producto)
                                    <tr>
                                        <td>{!! ucwords($producto->nombre) !!}</td>
                                        <td>{!! ucWords($producto->marca->nombre) !!}</td>
                                        <td>{!! ($producto->descripcion)? $producto->descripcion : '' !!}</td>
                                        <td>
                                            @foreach($producto->categorias as $categoria)
                                                <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                                            @endforeach
                                        </td>
                                        <td>
                                            {!! ($producto->cantidad_medida)? $producto->cantidad_medida : '' !!}
                                            {!! ($producto->unidadMedida)? $producto->unidadMedida->nombre : '' !!}
                                        </td>
                                        <td>${!! $producto->precio !!}</td>
                                        <td class="text-center" style="width: 130px">

                                            @if($producto->prospecto != '' && $producto->prospecto != null)
                                                <button type="button" class="btn btn-default btn-flat btn-sm" data-target="#verProspecto{{ $producto->id }}" data-toggle="modal" title="Prospecto (Componenetes)"><i class="fa fa-file-text-o"></i> </button>
                                            @endif
                                            @permission('editar.venta')
                                            <button type="button" class="btn btn-warning btn-flat btn-sm" data-target="#editarObservaciones{{ $producto->id }}" data-toggle="modal" title="Modos de Uso (observaciones)"><i class="fa fa-book"></i> </button>
                                            @endpermission
                                            @permission('quitar.producto.venta')
                                            <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#quitarProducto{{ $producto->id }}" title="Quitar Producto"><i class="fa fa-trash-o"></i> </button>
                                            @endpermission

                                            @permission('editar.venta')
                                            <div class="modal fade text-left col-lg-6 col-lg-offset-3" id="editarObservaciones{{ $producto->id }}">
                                                <div class="card">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Editar Observaciones / Modos de uso</h4>
                                                    </div>
                                                    {!! Form::model($venta, ['method' => 'put', 'url' => route('ventas.editar.modos', $producto->id)]) !!}
                                                    <div class="modal-body">

                                                        {!! Form::hidden('venta_id', $venta->id) !!}
                                                        {!! Form::textarea('observaciones', $producto->pivot->observaciones, ['class' => 'form-control', 'rows' => '9']) !!}

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                            @endpermission
                                            @if($producto->prospecto != '' && $producto->prospecto != null)


                                                <div class="modal fade text-left col-lg-6 col-lg-offset-3" id="verProspecto{{ $producto->id }}">
                                                    <div class="card">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Prospecto</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="noticia" style="max-height:600px; overflow: scroll">
                                                                {!! $producto->prospecto !!}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                            @permission('quitar.producto.venta')
                                            <div class="modal fade text-left col-lg-3 col-lg-offset-9" id="quitarProducto{{ $producto->id }}">
                                                <div class="card">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title text-danger"><i class="fa fa-exclamation-triangle"></i> Quitar producto</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Está seguro que desea quitar el producto "{!! $producto->nombre !!}" de esta venta?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::open(['method' => 'DELETE', 'url' => route('ventas.quitar.producto')]) !!}
                                                        {!! Form::hidden('producto_id', $producto->id) !!}
                                                        {!! Form::hidden('venta_id', $venta->id) !!}
                                                        <button type="submit" class="btn btn-danger pull-left">Quitar</button>
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">Subtotal</td>
                                    <td>${!! $venta->suma_subtotal_productos !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="5">IVA (21%)</td>
                                    <td>${!! $venta->suma_productos_IVA !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="5">Total</td>
                                    <td>${!! $venta->suma_total_productos !!}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="list-unstyled list-inline">
                            <li><h3>Métodos de pago</h3></li>
                            <li><button class="nonStyledButton" style="color:cyan" id="botonNuevoMetodo"><i class="fa fa-plus"></i> Agregar</button> </li>
                            <li class="pull-right">
                                @if($venta->diferencia < 0)
                                    <span class="text-danger" style="font-size: 1.2em; cursor: default" title="Diferencia con la suma total de productos">$ {!! $venta->diferencia !!}</span>
                                @else
                                    <span class="text-success" style="font-size: 1.2em; cursor: default" title="Diferencia con la suma total de productos">$ {!! $venta->diferencia !!}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        @include('ventas.partials.agregar-metodo-pago')

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background-color: gray">
                                    <th>Método</th>
                                    <th>Tarjeta</th>
                                    <th>Banco</th>
                                    <th>Nº Tarjeta</th>
                                    <th>Código</th>
                                    <th>Titular</th>
                                    <th>Fecha expiración</th>
                                    <th>Importe</th>
                                    <th>Interés</th>
                                    <th>Descuento</th>
                                    <th>IVA (21%)</th>
                                    <th>Cuotas</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($venta->metodoPagoVenta as $metodoPagoVenta)

                                    @if($metodoPagoVenta->metodoPago->isCardMethod())

                                        {{--TARJETA DE CRÉDITO O DE DÉBITO--}}
                                        <tr>
                                            <td>{!! $metodoPagoVenta->metodoPago->nombre !!}</td>
                                            <td>{!! $metodoPagoVenta->datosTarjeta->marca->nombre !!}</td>
                                            <td>{!! $metodoPagoVenta->datosTarjeta->banco->nombre !!}</td>
                                            <td>{!! $metodoPagoVenta->datosTarjeta->card_number !!}</td>
                                            <td>{!! $metodoPagoVenta->datosTarjeta->security_number !!}</td>
                                            <td>{!! $metodoPagoVenta->datosTarjeta->titular !!}</td>
                                            <td>{!! $metodoPagoVenta->datosTarjeta->expiration_date !!}</td>
                                            <td>${!! $metodoPagoVenta->importe !!}</td>
                                            <td class="text-center">
                                                @if($metodoPagoVenta->formaPago)
                                                    {!! ($metodoPagoVenta->formaPago->interes != 0)? $metodoPagoVenta->formaPago->interes .' %'  : '-' !!}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($metodoPagoVenta->formaPago)
                                                    {!! ($metodoPagoVenta->formaPago->descuento != 0)? $metodoPagoVenta->formaPago->descuento .' %'  : '-' !!}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>${!! $metodoPagoVenta->IVA !!}</td>
                                            <td class="text-center">
                                                {!! ($metodoPagoVenta->formaPago)? $metodoPagoVenta->formaPago->cuota_cantidad.' x ' : '-' !!}
                                                {!! ($metodoPagoVenta->formaPago)? '$'.$metodoPagoVenta->valor_cuota : '' !!}
                                            </td>
                                            <td class="text-center">${!! $metodoPagoVenta->importe_mas_promocion_mas_iva !!}</td>
                                            <td>
                                                <button type="button" title="Eliminar método de pago" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#eliminar{!! $metodoPagoVenta->id !!}" style="border: none">
                                                    eliminar
                                                </button>
                                                <div class="modal fade col-lg-3 col-lg-offset-9" id="eliminar{!! $metodoPagoVenta->id !!}">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Eliminar Método de pago</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="text-danger">¿Desea eliminar este método de pago?</p>
                                                        </div>
                                                        <div class="card-footer">

                                                            {!! Form::open(['url' => route('ventas.quitar.metodopago', $metodoPagoVenta->id), 'method' => 'delete']) !!}
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

                                    @else

                                        {{--EFECTIVO--}}
                                        <tr>
                                            <td>{!! $metodoPagoVenta->metodoPago->nombre !!}</td>
                                            <td class="text-center">--</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td>${!! $metodoPagoVenta->importe !!}</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">${!! $metodoPagoVenta->IVA !!}</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">${!! $metodoPagoVenta->importe_mas_promocion_mas_IVA !!}</td>
                                            <td>
                                                <button type="button" title="Eliminar método de pago" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#eliminar{!! $metodoPagoVenta->id !!}" style="border: none">
                                                    eliminar
                                                </button>
                                                <div class="modal fade col-lg-3 col-lg-offset-9" id="eliminar{!! $metodoPagoVenta->id !!}">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Eliminar Método de pago</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="text-danger">¿Desea eliminar este método de pago?</p>
                                                        </div>
                                                        <div class="card-footer">

                                                            {!! Form::open(['url' => route('ventas.quitar.metodopago', $metodoPagoVenta->id), 'method' => 'delete']) !!}
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

                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <span class="text-left">Todavía no se ha cargado ningún método de pago</span>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfooter>
                                    {{--<tr>--}}
                                    {{--<td colspan="12">Subtotal</td>--}}
                                    {{--<td>${!! $venta->subtotal !!}</td>--}}
                                    {{--<td>--}}
                                    {{--@if($venta->diferencia < 0)--}}
                                    {{--<span class="text-danger" title="Diferencia con la suma total de productos" style="cursor: default">$ {!! $venta->diferencia !!}</span>--}}
                                    {{--@else--}}
                                    {{--<span class="text-success" title="Diferencia con la suma total de productos" style="cursor: default">$ {!! $venta->diferencia !!}</span>--}}
                                    {{--@endif--}}
                                    {{--</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<td colspan="12">IVA (21%)</td>--}}
                                    {{--<td>${!! $venta->iva !!}</td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <td colspan="9">Total</td>
                                        <td colspan="3" class="text-center">

                                            <span class="text-muted">AJUSTE ACTUAL: $ {!! $venta->ajuste !!}</span>

                                        </td>
                                        <td>${!! $venta->importe_total !!}</td>
                                        <td>

                                            @if($venta->ajuste == 0.00)

                                                <button type="button" title="Ajustar" class="pull-right btn btn-warning btn-flat" data-toggle="modal" data-target="#ajustar{!! $venta->id !!}" style="border: none">
                                                    ajustar
                                                </button>
                                                <div class="modal fade col-lg-3 col-lg-offset-4 text-left" id="ajustar{!! $venta->id !!}">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Ajustar venta</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="text-danger">Ingrese el número que desea fijar como importe final de la compra.</p>
                                                            <span class="text-muted">(Importe actual: {!! $venta->importe_total !!})</span>
                                                        </div>
                                                        <div class="card-footer">

                                                            {!! Form::open(['url' => route('ventas.ajustar', $venta->id), 'method' => 'put']) !!}
                                                            <div class="form-group">
                                                                {!! Form::hidden('importe_actual', $venta->importe_total) !!}
                                                                {!! Form::number('ajuste') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Ajustar</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            </div>
                                                            {!! Form::close() !!}

                                                        </div>
                                                    </div>
                                                </div>

                                            @else

                                                <button type="button" title="Quitar ajuste" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#quitarAjuste{!! $venta->id !!}">quitar ajuste</button><br>

                                                <div class="modal fade col-lg-3 col-lg-offset-4 text-left" id="quitarAjuste{!! $venta->id !!}">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Quitar ajuste de venta</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="text-danger">¿Desea quitar el ajuste hecho a esta venta?</p>
                                                            <span class="text-muted">(Ajuste actual: $ {!! $venta->ajuste !!})</span>
                                                        </div>
                                                        <div class="card-footer">

                                                            {!! Form::open(['url' => route('ventas.quitar.ajuste', $venta->id), 'method' => 'put']) !!}
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-danger">Quitar</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            </div>
                                                            {!! Form::close() !!}

                                                        </div>
                                                    </div>
                                                </div>

                                            @endif

                                        </td>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>



@endsection

@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>

    <script>

        /*$('.select2').select2();*/
        $('.datepicker').datepicker({
            format: 'd/mm/yyyy'
        });

        // Agregar método de pago

        $('#botonNuevoProducto').click(function () {
            $('#botonNuevoProducto').hide();
            $('#botonNuevoProductoCancelar').show();
            $('#listadoProductos').show();
        });

        $('#botonNuevoProductoCancelar').click(function () {
            $('#botonNuevoProducto').show();
            $('#botonNuevoProductoCancelar').hide();
            $('#listadoProductos').hide();
        });

        $('#botonNuevoMetodo').click(function () {
            $('#botonNuevoMetodo').hide();
            $('#nuevoMetodo').show();
        });

        $('#selectMetodo').change(function () {
            var selected = $('#selectMetodo option:selected').text();
            if(selected === 'Tarjeta de crédito'){
                $('#selectTarjetaDebito').hide();
                $('#selectCuotas').show();
                $('#selectTarjetaCredito').show();
            }
            if(selected === 'Tarjeta de débito'){
                $('#selectTarjetaCredito').hide();
                $('#selectTarjetaDebito').show();
            }
            if(selected === 'Efectivo'){
                $('#selectCredito').val('');
                $('#selectDebito').val('');
                $('#cuotas').val('');
                $('#selectTarjetaCredito').hide();
                $('#selectTarjetaDebito').hide();
                $('#selectCuotas').hide();
            }
        });

        $('#botonNuevaTarjeta').click(function () {
            $('#botonNuevaTarjeta').hide();
            $('#nuevaTarjeta').show();
        });

        $('#cancelarAgregarMetodoPago').click(function () {
            $('#selectMetodo').val('');
            $('#selectCredito').val('');
            $('#selectDebito').val('');
            $('#inputImporte').val('');
            $('#cuotas').val('');
            $('#selectTarjetaCredito').hide();
            $('#selectTarjetaDebito').hide();
            $('#selectCuotas').hide();
            $('#botonNuevoMetodo').show()
            $('#nuevoMetodo').hide();
        });

        $('#cancelarAsociarTarjeta').click(function () {
            $('#marcaCredito').val('');
            $('#banco').val('');
            $('#numeroTarjeta').val('');
            $('#codigoSeguridad').val('');
            $('#titular').val('');
            $('#fechaExpiracion').val('');
            $('#botonNuevaTarjeta').show()
            $('#nuevaTarjeta').hide();
        });

        $(document).ready(function() {
            $('#table-productos').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando _PAGE_ de _PAGES_",
                    "emptyTable": "Sin datos disponibles",
                    "infoEmpty": "Sin registros",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "<i class='fa fa-search'></i> buscar",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            $("#div-table-productos").show();
            $(".overlay").hide();
        });


        // if($('#metodoPago option:selected').html() === 'Tarjeta de crédito'){
        //     $('#conTarjeta').show();
        //     $('#conCredito').show();
        //     //$('.select2').select2();
        // }
        //
        // if($('#metodoPago option:selected').html() === 'Tarjeta de débito'){
        //     $('#conTarjeta').show();
        //     $('#conDebito').show();
        //     //$('.select2').select2();
        // }
        //
        // $('#metodoPago').change(function () {
        //
        //     if($('#metodoPago option:selected').html() === 'Tarjeta de crédito' || $('#metodoPago option:selected').html() === 'Tarjeta de débito'){
        //
        //         $('#conTarjeta').show();
        //         //$('.select2').select2();
        //
        //         if($('#metodoPago option:selected').html() === 'Tarjeta de crédito'){
        //             $('#marcaDebito').val('');
        //             $('#conDebito').hide();
        //             $('#conCredito').show();
        //         }
        //         if($('#metodoPago option:selected').html() === 'Tarjeta de débito'){
        //             $('#marcaCredito').val('');
        //             $('#conCredito').hide();
        //             $('#conDebito').show();
        //         }
        //
        //     }else{
        //
        //         $('#conTarjeta').hide();
        //         $('.inputConTarjeta').val('');
        //         $('#marcaCredito').val('');
        //         $('#conCredito').hide();
        //         $('#marcaDebito').val('');
        //         $('#conDebito').hide();
        //
        //     }
        //
        // });


    </script>

@endsection

