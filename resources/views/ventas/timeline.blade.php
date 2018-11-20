@extends('ventas.base')

@section('css')

    <style type="text/css">

        .dark .timeline::before {
            background-color: dimgray;
        }
        .timeline:before {
            top: 50px;
            bottom: 70px;
        }
        .listado-timeline li {
            background-color: slategray;
            padding: 5px 10px;
            border-radius: 3px;
        }

    </style>

@endsection

@section('titulo')

    <h2>Timeline de la venta</h2>

@endsection

@section('contenido')


            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="card card-default">
                        <div class="card-body">

                            <ul class="timeline">

                                @foreach($updateable as $item)
                                    @if($item->action == 'create')
                                        <li>
                                            <div class="timeline-badge success"><i class="glyphicon glyphicon-check"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">
                                                        Se generó la venta
                                                        <label class="label label-default estadoVentas" data-estado="iniciada">iniciada</label>
                                                    </h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'update' && $item->field == 'estado_id' && $item->related_model_type == null)
                                        <li>
                                            <div class="timeline-badge warning"><i class="fa fa-random"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">
                                                        Se cambió el estado de la venta a
                                                        <label class="label label-default estadoVentas" data-estado="{!! $item->estadoVenta->getSlug($item->updated_value) !!}">{!! $item->estadoVenta->getName($item->updated_value) !!}</label>
                                                    </h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    @if($item->reason)
                                                        <ul class="list-inline listado-timeline">
                                                            <li>Motivo: <span class="text-primary">{!! $item->reason !!}</span></li>
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'update' && $item->field == 'ajuste')
                                        <li>
                                            <div class="timeline-badge default"><i class="fa fa-edit"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">Se realizó un ajuste la venta</h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>Valor de ajuste: ${!! $item->updated_value !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'delete' && $item->field == 'ajuste')
                                        <li>
                                            <div class="timeline-badge danger"><i class="fa fa-remove"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">Se quitó ajuste de la venta</h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>Ajuste quitado: ${!! $item->former_value !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'update' && ($item->field == 'etapa_id' || $item->field == 'promocion_id'))
                                        <li>
                                            <div class="timeline-badge default"><i class="fa fa-edit"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">Se editó la venta</h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>Valor anterior: ${!! $item->former_value !!}</li>
                                                        <li>Valor nuevo: ${!! $item->updated_value !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'update' && ($item->field == 'numero_guia'))
                                        <li>
                                            <div class="timeline-badge default"><i class="fa fa-edit"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">Se editó el número de guía de la venta</h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        @if($item->former_value)
                                                        <li>Valor anterior: {!! $item->former_value !!}</li>
                                                        @endif
                                                        <li>Valor nuevo: {!! $item->updated_value !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'update' && $item->related_model_type == 'producto' && $item->field == 'observaciones')
                                        <li>
                                            <div class="timeline-badge default"><i class="fa fa-edit"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">Se editaron las observaciones de la venta</h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>Id: #{!! $item->related_model_id !!}</li>
                                                        <li>Nombre: {!! ($item->producto)? $item->producto->nombre : '-' !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'add' && $item->related_model_type == 'reclamo')
                                        <li>
                                            <div class="timeline-badge info"><i class="fa fa-plus"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">
                                                        Se inició un Reclamo
                                                    </h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>Id: #{!! $item->related_model_id !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'update' && $item->related_model_type == 'reclamo' && $item->field == 'responsable_id')
                                        <li>
                                            <div class="timeline-badge default"><i class="fa fa-edit"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">Se derivó un reclamo de la venta</h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>Id: #{!! $item->related_model_id !!}</li>
                                                        <li>Responsable: {!! $item->responsable->fullname !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'update' && $item->related_model_type == 'reclamo' && $item->field == 'estado_id')
                                        <li>
                                            <div class="timeline-badge default"><i class="fa fa-edit"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">Se cambió el estado de un reclamo de la venta</h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>Id: #{!! $item->related_model_id !!}</li>
                                                        <li>
                                                            Estado:
                                                            @if($item->updated_value == 1)
                                                                <span class="label label-success">abierto</span>
                                                            @else
                                                                <span class="label label-danger">cerrado</span>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'update' && $item->related_model_type == 'reclamo' && $item->field == 'solucionado')
                                        <li>
                                            <div class="timeline-badge default"><i class="fa fa-edit"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">Se cambió el estado de "solucionado" de un reclamo</h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>Id: #{!! $item->related_model_id !!}</li>
                                                        <li>
                                                            Estado:
                                                            @if($item->updated_value == 1)
                                                                <span class="label label-success">solucionado</span>
                                                            @else
                                                                <span class="label label-warning">sin solución</span>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'delete' && $item->related_model_type == 'reclamo')
                                        <li>
                                            <div class="timeline-badge danger"><i class="fa fa-trash"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">
                                                        Se eliminó un reclamo
                                                    </h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>#{!! $item->related_model_id !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'add' && $item->related_model_type == 'producto')
                                        <li>
                                            <div class="timeline-badge info"><i class="fa fa-plus"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">
                                                        Se agregó un Producto
                                                    </h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>#{!! $item->related_model_id !!}</li>
                                                        <li>Nombre: {!! ($item->producto)? $item->producto->nombre : '' !!}</li>
                                                        <li>Marca: {!! ($item->producto && $item->producto->marca)? $item->producto->marca->nombre : '' !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'delete' && $item->related_model_type == 'producto')
                                        <li>
                                            <div class="timeline-badge danger"><i class="fa fa-remove"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">
                                                        Se quitó un Producto
                                                    </h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>#{!! $item->related_model_id !!}</li>
                                                        <li>Nombre: {!! ($item->producto)? $item->producto->nombre : '' !!}</li>
                                                        <li>Marca: {!! ($item->producto && $item->producto->marca)? $item->producto->marca->nombre : '' !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'add' && $item->related_model_type == 'metodoPagoVenta')
                                        <li>
                                            <div class="timeline-badge info"><i class="fa fa-plus"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">
                                                        Se agregó un Método de Pago
                                                    </h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>#{!! $item->related_model_id !!}</li>
                                                        @if($item->metodoPagoVenta)
                                                            <li>Tipo: {!! $item->metodoPagoVenta->metodoPago->nombre !!}</li>
                                                        @else
                                                            <li><small class="text-warning">método de pago eliminado</small></li>
                                                        @endif
                                                        <li>Importe: ${!! $item->updated_value !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'update' && $item->related_model_type == 'metodoPagoVenta' && $item->field == 'importe')
                                        <li>
                                            <div class="timeline-badge default"><i class="fa fa-edit"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">
                                                        Se editó un Método de Pago
                                                    </h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>#{!! $item->related_model_id !!}</li>
                                                        <li>Valor anterior: ${!! $item->former_value !!}</li>
                                                        <li>Nuevo valor: ${!! $item->updated_value !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($item->action == 'delete' && $item->related_model_type == 'metodoPagoVenta')
                                        <li>
                                            <div class="timeline-badge danger"><i class="fa fa-trash"></i></div>
                                            <div class="timeline-panel" style="background-color: #404a6b">
                                                <div class="timeline-heading">
                                                    <p class="pull-right">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                        <small> {!! $item->fecha_creado !!}</small> -
                                                        <small> {!! $item->hora_created !!} hs</small>
                                                    </p>
                                                    <h4 style="color: white!important;">
                                                        Se eliminó un Método de Pago
                                                    </h4>
                                                    <span class="text-muted">por {!! $item->author->fullname !!}</span>
                                                    <ul class="list-inline listado-timeline">
                                                        <li>#{!! $item->related_model_id !!}</li>
                                                        @if($item->reason)
                                                            <li>
                                                                Motivo:
                                                                <span class="text-primary">{!! $item->reason !!}</span>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Información general de la venta #{!! $venta->id !!}</h3>
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
                            </ul>
                        </div>

                    </div>

                </div>
            </div>



@endsection

@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>

@endsection

