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
                                <li class="list-group-item">Número de guía: {!! ($venta->numero_guia)? $venta->numero_guia : '<small class="text-muted">sin número de guía</small>' !!}</li>
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
                            <h3 class="card-title">Estado de la venta</h3>
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

                @include('ventas.partials.panel-productos')

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                @include('ventas.partials.panel-metodos-de-pago')

            </div>
        </div>



@endsection

@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>
    <script src="{{ asset('js/agregar-metodo-pago.js') }}"></script>
    <script src="{{ asset('js/edicion-metodo-pago-tarjeta-asociada.js') }}"></script>

    <script>

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

    </script>

@endsection

