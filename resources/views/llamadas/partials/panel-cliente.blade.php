{{--<div class="card card-default">
    <div class="card-heading">
        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-edit"></i> editar</a>
        <h4 class="card-title">
            Cliente:
            <span class="text-info">{!! $cliente->full_name !!}</span>
        </h4>
    </div>
    <div class="card-body">
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
</div>--}}


<div class="card card-default">
    <div class="card-heading">
        {{--<a href="{{ route('clientes.edit', $cliente->id) }}" title="editar" class="pull-right"><i class="fa fa-edit"></i></a>--}}

        <button type="button" title="editar cliente" class="nonStyledButton pull-right" data-toggle="modal" data-target="#editarCliente{!! $cliente->id !!}" >
            <i class="fa fa-edit text-primary"></i>
        </button>
        <div class="modal fade" id="editarCliente{!! $cliente->id !!}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-edit "></i> Editar cliente</h4>
                    </div>
                    <div class="modal-body">
                        @include('clientes.partials.formulario-editar')
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>--}}
                    </div>
                </div>
            </div>
        </div>

        <h4 class="card-title">Cliente:</h4>
    </div>
    <div class="card-body">
        <h4>{!! $cliente->full_name !!}</h4>
        <small>DNI: {!! $cliente->dni !!}</small>
        @if($cliente->puntos)
            <div class="pull-right">
                <span class="text-info" style="font-size: 2em">{!! $cliente->puntos !!}</span>
                <small>pts</small>
            </div>
        @endif
        <div>
            <div>Alta: {!! $cliente->fecha_creado !!}</div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <strong>Contacto telefónico</strong>
                @if($cliente->telefono)
                    <div><i class="fa fa-phone"></i> {!! $cliente->telefono !!}</div>
                @endif
                @if($cliente->celular)
                    <div><i class="fa fa-mobile"></i> {!! $cliente->celular !!}</div>
                @endif
                <hr>
                <strong>Dirección</strong>
                @if($cliente->address == '')
                    <small class="text-muted">No hay una dirección registrada</small>
                @endif
                <div>
                    {!! $cliente->address !!}
                    @if($cliente->domicilio && $cliente->domicilio->codigo_postal)
                        <span>(CP {!! $cliente->domicilio->codigo_postal !!})</span>
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
            </div>
        </div>

    </div>
</div>
