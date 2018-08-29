@extends('pagos.base')

@section('titulo')

    <h2>Formas de pago</h2>

@endsection


@section('contenido')

    <div class="row">
        <div class="col-md-4">
            @permission('crear.forma.de.pago')
            <div class="card alert">
                <div class="card-header pr">
                    <h4>Nueva forma de pago</h4>
                </div>
                {!! Form::open(['url' => route('formas.pago.store'), 'method' => 'post']) !!}
                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('tarjeta_id', 'Tarjeta') !!}
                        {!! Form::select('tarjeta_id', $marcasTarjetas, null, ['class' => 'form-control  select2', 'placeholder' => '', 'style' => 'color: white']) !!}
                    </div>
                </div>
                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('cuota_cantidad', 'Cuotas') !!}
                        {!! Form::select('cuota_cantidad', $cuotas, null, ['class' => 'form-control  select2', 'style' => 'color: white']) !!}
                    </div>
                </div>
                
                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('interes', 'Interés (%)') !!}
                        {!! Form::number('interes', null, ['class' => 'form-control', 'max' => '100', 'min' => '0']) !!}
                    </div>
                </div>
                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('descuento', 'Descuento (%)') !!}
                        {!! Form::number('descuento', null, ['class' => 'form-control', 'max' => '100', 'min' => '00']) !!}
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Agregar Tarjeta</button>
                
            </div>
            {!! Form::close() !!}
        </div>
        @endpermission

        @permission('editar.forma.de.pago')
            @if(isset($formaEdit))

            @include('pagos.partials.formulario-edit')

            @endif
        @endpermission


        @permission('listado.forma.de.pago')
        <div class="col-md-8">
            <div class="card alert">
                <h4>Todas las Tarjetas</h4>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>Tarjeta</th>
                                    <th>Cuotas</th>
                                    <th>Interés</th>
                                    <th>Descuento</th>
                                    <th>Opciones</th>
                                    <th>Usos</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tarjetas as $tarjeta)
                                @foreach($tarjeta->formasPago as $formasPago)
                                    <tr>
                                        <td align="center">{!! $tarjeta->nombre !!}</td>
                                        <td align="center">{!! $formasPago->cuota_cantidad !!}</td>
                                        <td align="center">{!! ($formasPago->interes)? $formasPago->interes.'%' : '--' !!}</td>
                                        <td align="center">{!! ($formasPago->descuento)? $formasPago->descuento.'%' : '--' !!}</td>
                                        <td align="center">
                                            <a href="{{ route('formas.pago.edit', $formasPago->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <button type="button" title="ELIMINAR" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#eliminarPago{!! $formasPago->id !!}" {!! (count($formasPago->ventas) > 0)? 'disabled' : '' !!} >
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <div class="modal fade col-lg-3 col-lg-offset-9" id="eliminarPago{!! $formasPago->id !!}">
                                                <div class="card">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar Forma de pago</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Desea eliminar forma de pago?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::open(['method' => 'delete', 'url' => route('formas.pago.destroy', $formasPago->id)]) !!}
                                                        <button type="submit" title="ELIMINAR" class="btn btn-danger" data-toggle="modal" data-target="#eliminarPago{!! $formasPago->id !!}" >
                                                            Eliminar
                                                        </button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td >
                                            <button type="button" title="ver usos" class="btn btn-default btn-xs" data-toggle="modal" data-target="#usos{!! $formasPago->id !!}" style="width: 35px" >
                                                {!! count($formasPago->ventas) !!}
                                            </button>
                                            <div class="modal fade col-lg-6 col-lg-offset-3" id="usos{!! $formasPago->id !!}">
                                                    <div class="card">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
        @endpermission

                </div>
            </div>
        </div>
    </div>

@endsection

