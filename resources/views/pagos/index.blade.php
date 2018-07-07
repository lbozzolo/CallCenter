@extends('pagos.base')

@section('titulo')

    <h2>Formas de pago</h2>

@endsection


@section('contenido')

    <div class="row">

        <div class="col-lg-6">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Nueva forma de pago</h3>
                </div>
                <div class="panel-body">

                    {!! Form::open(['url' => route('formas.pago.store'), 'method' => 'post']) !!}

                        <div class="form-group">
                            {!! Form::label('tarjeta_id', 'Tarjeta') !!}
                            {!! Form::select('tarjeta_id', $marcasTarjetas, null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('cuota_cantidad', 'Cuotas') !!}
                                    {!! Form::select('cuota_cantidad', $cuotas, null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('interes', 'Interés (%)') !!}
                                    {!! Form::number('interes', null, ['class' => 'form-control', 'max' => '100', 'min' => '0']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('descuento', 'Descuento (%)') !!}
                                    {!! Form::number('descuento', null, ['class' => 'form-control', 'max' => '100', 'min' => '00']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Agregar <i class="fa fa-angle-double-right"></i></button>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>

            @if(isset($formaEdit))

                @include('pagos.partials.formulario-edit')

            @endif


        </div>

        <div class="col-lg-6">
            <table class="table">
                <thead>
                <tr>
                    <th>Tarjeta</th>
                    <th class="text-center">Cuotas</th>
                    <th class="text-center">Interés</th>
                    <th class="text-center">Descuento</th>
                    <th class="text-center">Opciones</th>
                    <th class="text-center">Usos</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tarjetas as $tarjeta)
                    @foreach($tarjeta->formasPago as $formasPago)
                        <tr>
                            <td>{!! $tarjeta->nombre !!}</td>
                            <td class="text-center">{!! $formasPago->cuota_cantidad !!}</td>
                            <td class="text-center">{!! ($formasPago->interes)? $formasPago->interes.'%' : '--' !!}</td>
                            <td class="text-center">{!! ($formasPago->descuento)? $formasPago->descuento.'%' : '--' !!}</td>
                            <td class="text-center">

                                <a href="{{ route('formas.pago.edit', $formasPago->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>

                                <button type="button" title="ELIMINAR" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#eliminarPago{!! $formasPago->id !!}" {!! (count($formasPago->ventas) > 0)? 'disabled' : '' !!} >
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                <div class="modal fade" id="eliminarPago{!! $formasPago->id !!}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar Forma de pago</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Desea eliminar forma de pago?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                {!! Form::open(['method' => 'delete', 'url' => route('formas.pago.destroy', $formasPago->id)]) !!}
                                                <button type="submit" title="ELIMINAR" class="btn btn-danger" data-toggle="modal" data-target="#eliminarPago{!! $formasPago->id !!}" >
                                                    Eliminar
                                                </button>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </td>
                            <td>
                                <button type="button" title="ver usos" class="btn btn-default btn-xs" data-toggle="modal" data-target="#usos{!! $formasPago->id !!}" style="width: 35px" >
                                    {!! count($formasPago->ventas) !!}
                                </button>
                                <div class="modal fade" id="usos{!! $formasPago->id !!}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Listado de usos</h4>
                                            </div>
                                            <div class="modal-body">
                                                @if(count($formasPago->ventas))
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Cliente</th>
                                                                <th>Productos</th>
                                                                <th>Opciones</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($formasPago->ventas as $venta)
                                                                <tr>
                                                                    <td>#{!! $venta->id !!}</td>
                                                                    <td class="text-left">{!! $venta->cliente->full_name !!}</td>
                                                                    <td class="text-left">
                                                                        @if($venta->productos)
                                                                            <ul>
                                                                                @foreach($venta->productos as $producto)
                                                                                    <li class="text-left">
                                                                                        <a href="{{ route('productos.show', $producto->id) }}">{!! $producto->nombre !!}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </td>
                                                                    <td><a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-xs btn-default">ver</a></td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <span>No hay ventas que utilicen esta forma de pago</span>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>

            </table>
        </div>

    </div>

@endsection