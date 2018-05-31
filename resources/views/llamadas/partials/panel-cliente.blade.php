<div class="panel panel-default">
    <div class="panel-heading">
        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-edit"></i> editar</a>
        <h4 class="panel-title">
            Cliente:
            <span class="text-info">{!! $cliente->full_name !!}</span>
        </h4>
    </div>
    <div class="panel-body">
        <div class="col-lg-3 col-md-3 col-sm-4">
            <div><strong>Correo</strong> {!! $cliente->email !!}</div>
            <div><strong>DNI</strong> {!! $cliente->dni !!}</div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4">
            @if($cliente->telefono)
                <div><strong>Tel.</strong> {!! $cliente->telefono !!}</div>
            @endif
            @if($cliente->celular)
                <div><strong>Cel.</strong> {!! $cliente->celular !!}</div>
            @endif
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4">
            <strong>Dirección</strong>
            @if($cliente->address != '')
                <div>{!! $cliente->address !!}</div>
            @else
                <div>--</div>
            @endif
            @if($cliente->domicilio)
                <span class="text-info">
                    {!! ($cliente->domicilio->localidad)? $cliente->domicilio->localidad->localidad.',' : '' !!}
                    {!! ($cliente->domicilio->partido)? $cliente->domicilio->partido->partido : '' !!}
                    {!! ($cliente->domicilio->provincia)? '('.$cliente->domicilio->provincia->provincia.')' : '' !!}
                </span>
            @endif
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4">
            <div><strong>Fecha de alta</strong> {!! $cliente->fecha_creado !!}</div>
            <div><strong>Compras</strong> {!! count($cliente->ventas) !!}</div>
        </div>
    </div>
</div>
{{--
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Cliente</h3>
    </div>
    <div class="panel-body">
        <h4>{!! $cliente->full_name !!}</h4>
        <ul class="list-unstyled">
            @if($cliente->puntos)
                <li class="list-group-item">
                    <div>
                        <span class="text-info" style="font-size: 2em">{!! $cliente->puntos !!}</span>
                        <small>pts</small>
                    </div>
                </li>
            @endif
            <li class="list-group-item">
                <div>Fecha de alta: {!! $cliente->fecha_creado !!}</div>
                <div>Última edición: {!! $cliente->fecha_editado !!}</div>
            </li>
            <li class="list-group-item">
                <strong>Contacto</strong>
                @if($cliente->telefono)
                    <div><i class="fa fa-phone"></i> {!! $cliente->telefono !!}</div>
                @endif
                @if($cliente->celular)
                    <div><i class="fa fa-mobile"></i> {!! $cliente->celular !!}</div>
                @endif
            </li>
            <li class="list-group-item">DNI: {!! $cliente->dni !!}</li>
            <li class="list-group-item">
                <strong>Dirección</strong>
                @if($cliente->address == '')
                    <small class="text-muted">No hay una dirección registrada</small>
                @endif
                <div>
                    {!! $cliente->address !!}
                    @if($cliente->domicilio && $cliente->domicilio->codigo_postal)
                        - (CP {!! $cliente->domicilio->codigo_postal !!})
                    @endif
                </div>
                <div>
                    @if($cliente->domicilio)
                        <span class="text-info">
                            {!! ($cliente->domicilio->localidad)? $cliente->domicilio->localidad->localidad.',' : '' !!}
                            {!! ($cliente->domicilio->partido)? $cliente->domicilio->partido->partido : '' !!}
                            {!! ($cliente->domicilio->provincia)? '('.$cliente->domicilio->provincia->provincia.')' : '' !!}
                        </span>
                    @endif
                </div>
            </li>
        </ul>
    </div>
</div>--}}
