@extends('ventas.base')

@section('titulo')

    <h2>Ventas<span class="text-muted"> / Datos</span> </h2>

@endsection


@section('contenido')

    @if($venta->estado->slug == 'cancelada')

        @include('ventas.partials.venta-cancelada')

    @else

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
                        <span class="text-primary" style="font-size: 2.5em">${!! $venta->totalPorCuotas($venta->plan_cuotas) !!}</span>
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
                    <div class="card card-default" style="min-height: 310px">
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
                                @permission('ver.reclamos.venta')
                                <li class="list-group-item">
                                    <span style="padding: 10px 5px;"><a href="{!! route('ventas.reclamos', $venta->id) !!}" style="color: cyan">Reclamos ( {!! $venta->reclamos->count() !!} )</a></span>
                                </li>
                                @endpermission
                            </ul>
                            @permission('editar.numero.guia')
                            <ul class="panel panel-barra" style="margin: 0px">
                                <li>
                                    Número de guía:
                                    {!! ($venta->numero_guia)? $venta->numero_guia : '<small class="text-muted">sin número de guía</small>' !!}
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
                            @endpermission
                        </div>

                    </div>

                </div>


            </div>

            <div class="col-lg-6">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body text-right">

                            @include('ventas.partials.acciones-con-venta')

                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::user()->is('admin|superadmin'))
            <div class="col-lg-6">

                    @permission('editar.venta')
                    <div class="col-12">
                        <div class="card card-default" >
                            <div class="card-header">
                                <ul class="list-inline">
                                    <li><h3 class="card-title">Estado de la venta</h3></li>
                                    @permission('ver.timeline.venta')
                                    <li><a href="{{ route('ventas.timeline', $venta->id) }}" style="color: cyan">Ver Timeline</a></li>
                                    @endpermission
                                </ul>

                            </div>
                            <div class="card-body">

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
                                    {!! Form::label('motivo', 'Motivo') !!}
                                    {!! Form::text('motivo', null, ['id' => 'cancelacion', 'class' => 'form-control', 'placeholder' => 'De ser necesario, describa aquí el motivo del cambio de estado']) !!}
                                    <small class="text-warning">* El motivo es obligatorio sólo en el caso de cancelar la venta</small>
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
                        </div>
                    </div>
                    @endpermission

            </div>
            @endif

        </div>

        <div class="row">
            <div class="col-lg-12">

                @include('ventas.partials.panel-venta')

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                @include('ventas.partials.panel-metodos-de-pago')

            </div>
        </div>

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

