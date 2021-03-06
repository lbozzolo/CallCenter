<div class="card card-default">
    <div class="card-header">
        <h4>Venta #{!! $venta->id !!}<span class="label label-danger">cancelada</span></h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled listado">
            <li class="list-group-item"><strong>Cliente:</strong> {!! $venta->cliente->full_name !!}</li>
            <li class="list-group-item">
                <strong>{!! (count($venta->productos) > 1)? 'Productos:' : 'Producto:' !!}</strong>
                <ul class="list-inline panel panel-barra">
                    @foreach($venta->productos as $producto)
                        <li class="list-group-item">{!! $producto->nombre !!}</li>
                    @endforeach
                </ul>
            </li>
            <li class="list-group-item"><strong>Fecha:</strong> {!! $venta->fecha_creado !!}</li>
            <li class="list-group-item"><strong>Cancelación:</strong> {!! $venta->updateable->where('field', 'estado_id')->last()->fecha_creado !!}</li>
            <li class="list-group-item"><strong>Motivo:</strong> {!! $venta->updateable->where('field', 'estado_id')->last()->reason !!}</li>
            <li class="list-group-item"><strong>Cancelada por:</strong> {!! $venta->updateable->where('field', 'estado_id')->last()->author->fullname !!}</li>

           @if($venta->belongsToUser($venta->user_id))
            @permission('retomar.venta')
            <li class="list-group-item">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#retomarVenta"><i class="fa fa-rotate-right"></i> Retomar</button>
                <div class="modal fade col-lg-3 col-lg-offset-4" id="retomarVenta">
                    <div class="card">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Retomar venta</h4>

                        {!! Form::open(['url' => route('ventas.retomar'), 'method' => 'put']) !!}

                            <p>¿Desea retomar esta venta?</p>

                            {!! Form::hidden('venta_id', $venta->id) !!}
                            <button type="submit" class="btn btn-primary">Retomar venta</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                        {!! Form::close() !!}
                    </div>
                </div>
            </li>
            @endpermission
           @endif

        </ul>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>Timeline</h4>
    </div>
    <div class="card-body">

        @include('ventas.partials.listado-timeline')

    </div>
</div>