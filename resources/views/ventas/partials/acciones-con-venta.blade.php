@if(Auth::user()->is('auditor|superadmin'))

    <div style="display: inline-block; margin-right: 10px">
        {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
        {!! Form::hidden('estado_id', 4) !!}
        <button type="submit" class="btn btn-primary">Confirmar esta venta</button>
        {!! Form::close() !!}
    </div>
    <div style="display: inline-block;">
        {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
        {!! Form::hidden('estado_id', 5) !!}
        <button type="submit" class="btn btn-danger">Rechazar esta venta</button>
        {!! Form::close() !!}
    </div>

@endif

@if(Auth::user()->is('facturacion'))

    <div style="display: inline-block; margin-right: 10px">
        {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
        {!! Form::hidden('estado_id', 4) !!}
        <button type="submit" class="btn btn-primary">Autorizar</button>
        {!! Form::close() !!}
    </div>
    <div style="display: inline-block;">
        {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
        {!! Form::hidden('estado_id', 5) !!}
        <button type="submit" class="btn btn-danger">Rechazar</button>
        {!! Form::close() !!}
    </div>

@endif