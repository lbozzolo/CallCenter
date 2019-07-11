@extends('ventas.base')

@section('titulo')

    <h2>Ventas<span class="text-muted"> / Información</span> </h2>

@endsection

@section('css')

    <style type="text/css">

        .timeline h4 {
            font-size: 1em;
        }

    </style>

@endsection

@section('contenido')

    @if($venta->estado->slug == 'cancelada')

        @include('ventas.partials.venta-cancelada')

    @else

        <div class="card" style="{!! ($venta->cobrada)? 'border-top: 1px solid #1de9b6' : 'border-top: 1px solid orangered;' !!}">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <h3>
                            <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
                            Venta #{!! $venta->id !!}
                            <small class="text-muted"> / operador: {!! $venta->user->full_name !!}</small>
                        </h3>
                        @if($venta->motivo)
                            Motivo: <span class="text-danger"> {!! $venta->motivo !!}</span>
                        @endif
                        {{--@if($venta->statusIs('iniciada') || $venta->statusIs('rechazada'))--}}
                        @if($venta->estado->isInArray(['iniciada','rechazada']))

                            @permission('cancelar.venta')
                            <div style="margin-top: 15px">
                                <button type="button" class="btn btn-danger btn-outline btn-flat" data-toggle="modal" data-target="#cancelarVenta">
                                    <i class="fa fa-ban"></i>
                                    Cancelar venta
                                </button>
                                <div class="modal fade col-lg-6 col-lg-offset-3" id="cancelarVenta">
                                    <div class="card card-body">

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Cancelar venta</h4>

                                        <div class="card card-body">
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
                                </div>
                                @permission('aceptar.venta')

                                @include('ventas.partials.aceptar-venta')

                                @endpermission
                            </div>
                            @endpermission


                        @endif
                    </div>
                    <div class="col-lg-4 col-md-12 text-right">

                        <span class="text-primary" style="font-size: 2.5em">${!! $venta->totalPorCuotas($venta->plan_cuotas) !!}</span>
                        @if($venta->has_cuotas)
                            <div class="text-muted">
                                {!! $venta->has_cuotas->cuota_cantidad !!} cuotas de <span class=" text-primary">${!! $venta->valor_cuota !!}</span>
                            </div>
                        @endif
                        @if(!$venta->cobrada)
                            <span class="text-warning" title="Venta pendiente de cobro"><i class="fa fa-exclamation-triangle fa-2x"></i> </span>
                        @else
                            <span class="text-success" title="Venta cobrada"><i class="fa fa-check fa-2x"></i> </span>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-6">

                <div class="col-12">
                    <div class="card card-default" style="min-height: 310px">
                        <div class="card-header">
                            <h3 class="card-title">Información general</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled listado">
                                {{--@if($venta->estado->slug != 'iniciada' && $venta->estado->slug != 'noentregado')--}}
                                @if($venta->estado->isInArray(['auditable', 'confirmada', 'rechazada', 'facturada', 'enviada']))
                                <li class="list-group-items">
                                    <div class="panel-body text-center">
                                        @if($venta->totalPorCuotas($venta->plan_cuotas) > 0)

                                            @include('ventas.partials.acciones-con-venta')

                                        @endif
                                    </div>
                                </li>
                                @endif
                                <li class="list-group-item">Operador: {!! $venta->user->full_name !!}</li>
                                <li class="list-group-item">
                                    Cliente: {!! $venta->cliente->full_name !!}
                                    <a href="{{ route('clientes.show', $venta->cliente->id) }}" class="btn btn-default btn-xs pull-right">ver</a>
                                </li>
                                <li class="list-group-item">Fecha de venta: {!! $venta->fecha_creado !!}</li>
                                <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                                @permission('ver.reclamos.venta')
                                <li class="list-group-item">
                                    <span style="padding: 10px 5px;"><a href="{!! route('ventas.reclamos', $venta->id) !!}" style="color: cyan">Reclamos ( {!! $venta->reclamos->count() !!} )</a></span>
                                </li>
                                @endpermission
                                @permission('editar.venta')
                                <li class="list-group-item panel panel-barra">

                                    @include('ventas.partials.cobrar-venta')

                                </li>
                                @endpermission
                            </ul>
                            {{--@permission('editar.numero.guia')--}}
                            {{--<ul class="panel panel-barra" style="margin: 0px">--}}
                                {{--<li>--}}
                                    {{--Número de guía:--}}
                                    {{--{!! ($venta->numero_guia)? $venta->numero_guia : '<small class="text-muted">sin número de guía</small>' !!}--}}
                                    {{--{!! Form::model($venta, ['url' => route('ventas.numero.guia', $venta->id), 'method' => 'post']) !!}--}}

                                    {{--<div class="input-group margin">--}}
                                        {{--{!! Form::text('numero_guia', $venta->numero_guia, ['class' => 'form-control']) !!}--}}
                                        {{--<span class="input-group-btn">--}}
                                          {{--<button type="button" class="btn btn-info btn-flat" style="padding: 9px 5px" data-target="#guardarNumeroGuia" data-toggle="modal">Guardar</button>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}

                                    {{--<div class="modal fade col-lg-3 col-lg-offset-9" id="guardarNumeroGuia">--}}
                                        {{--<div class="card">--}}
                                            {{--<div class="modal-header">--}}
                                                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                                {{--<h4 class="modal-title">Guardar Número de guía</h4>--}}
                                            {{--</div>--}}
                                            {{--<div class="modal-body">--}}
                                                {{--<p>¿Desea guardar el número de guía?</p>--}}
                                            {{--</div>--}}
                                            {{--<div class="modal-footer">--}}
                                                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>--}}
                                                {{--<button type="submit" class="btn btn-primary">Aceptar</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--{!! Form::close() !!}--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            {{--@endpermission--}}



                        </div>

                    </div>

                </div>

                @if(Auth::user()->is('admin|superadmin'))
                    <div class="col-lg-12 panel panel-barra" style="margin-top: 8px">

                        @permission('editar.venta')

                        <div class="panel panel-barra">
                            @permission('cambiar.estado.venta')
                            <p>Marcar esta venta como...</p>

                            {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                            <div class="form-group">
                                <div class="input-group input-group">
                                    {!! Form::select('estado_id', $estados, $venta->estado_id, ['class' => 'form-control select2b', 'id' => 'selectEstados']) !!}
                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-primary btn-flag">Aplicar</button>
                                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::text('motivo', null, ['id' => 'cancelacion', 'class' => 'form-control', 'placeholder' => 'De ser necesario, describa aquí el motivo del cambio de estado']) !!}
                            </div>
                            {!! Form::close() !!}

                            @elsepermission

                            <p>
                                Esta venta se encuentra en estado
                                <span class="h1 label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</span>.
                                Usted no tiene los pemisos requeridos para cambiar su estado.
                            </p>

                            @endpermission
                        </div>

                        @endpermission

                    </div>
                @endif


            </div>


            <div class="col-lg-6" >

                <div class="card card-default">
                    <a href="{{ route('ventas.timeline', $venta->id) }}" class="pull-right" style="color: cyan">
                        <i class="fa fa-file-text"></i>
                        Timeline completo
                    </a>
                    <h3>Timeline de la venta</h3>
                    <div class="card-body" style="height: 455px; overflow: scroll">
                        @include('ventas.partials.listado-timeline')
                    </div>
                </div>

            </div>

            {{--@if(Auth::user()->is('admin|superadmin'))--}}
            {{--<div class="col-lg-6">--}}

                    {{--@permission('editar.venta')--}}
                    {{--<div class="col-12">--}}
                        {{--<div class="card card-default" >--}}
                            {{--<div class="card-header">--}}
                                {{--<ul class="list-inline">--}}
                                    {{--<li><h3 class="card-title">Estado de la venta</h3></li>--}}
                                    {{--@permission('ver.timeline.venta')--}}
                                    {{--<li><a href="{{ route('ventas.timeline', $venta->id) }}" style="color: cyan">Ver Timeline</a></li>--}}
                                    {{--@endpermission--}}
                                {{--</ul>--}}

                            {{--</div>--}}
                            {{--<div class="card-body">--}}

                                {{--@permission('cambiar.estado.venta')--}}
                                {{--<p>Marcar esta venta como...</p>--}}

                                {{--{!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}--}}
                                {{--<div class="form-group">--}}
                                    {{--<div class="input-group input-group">--}}
                                        {{--{!! Form::select('estado_id', $estados, $venta->estado_id, ['class' => 'form-control select2b', 'id' => 'selectEstados']) !!}--}}
                                        {{--<span class="input-group-btn">--}}
                                        {{--<button type="submit" class="btn btn-primary btn-flag">Aplicar</button>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--{!! Form::label('motivo', 'Motivo') !!}--}}
                                    {{--{!! Form::text('motivo', null, ['id' => 'cancelacion', 'class' => 'form-control', 'placeholder' => 'De ser necesario, describa aquí el motivo del cambio de estado']) !!}--}}
                                    {{--<small class="text-warning">* El motivo es obligatorio sólo en el caso de cancelar o rechazar la venta</small>--}}
                                {{--</div>--}}
                                {{--{!! Form::close() !!}--}}

                                {{--@elsepermission--}}

                                {{--<p>--}}
                                    {{--Esta venta se encuentra en estado--}}
                                    {{--<span class="h1 label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</span>.--}}
                                    {{--Usted no tiene los pemisos requeridos para cambiar su estado.--}}
                                {{--</p>--}}

                                {{--@endpermission--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--@endpermission--}}

            {{--</div>--}}
            {{--@endif--}}

        </div>

        <div class="row">
            <div class="col-lg-12">

                @include('ventas.partials.panel-venta')

            </div>
        </div>

        @if($venta->productos->count())
        <div class="row" style="margin-bottom: 10px">
            <div class="col-lg-12">

                @include('ventas.partials.panel-metodos-de-pago')

            </div>
        </div>
        @endif

        @can('alter', $venta)
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                @permission('editar.venta')
                <li class="active"><a href="#tab_1" data-toggle="tab">Tarjetas asociadas</a></li>
                <li><a href="#tab_2" data-toggle="tab">Datos del cliente</a></li>
                @endpermission
            </ul>
            <div class="tab-content">

                <div class="tab-pane active card" id="tab_1" style="margin-top: 0px">

                    @include('ventas.partials.panel-tarjetas-asociadas')

                </div>
                <div class="tab-pane card" id="tab_2" style="margin-top: 0px">

                    @include('ventas.partials.panel-cliente')

                </div>

            </div>
        </div>
        @endcan

    @endif



@endsection

@section('js')

    <script src="{{ asset('js/tarjetas-de-credito.js') }}"></script>
    <script src="{{ asset('js/provincias-partidos-localidades.js') }}"></script>
    <script src="{{ asset('js/estados-ventas.js') }}"></script>
    <script src="{{ asset('js/agregar-metodo-pago.js') }}"></script>
    <script src="{{ asset('js/edicion-metodo-pago-tarjeta-asociada.js') }}"></script>

    <script>

        $('.select2').select2({
            multiple: true
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

    </script>

@endsection

