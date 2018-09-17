<ul class="list-inline">

@permission('listado.llamada')
    <li><a href="{{ route('llamadas.index') }}" class="{{ (Request::is('llamadas/salientes'.'*') ? 'navbar-item-selected' : '') }}">Salientes</a></li>
    <li><a href="{{ route('llamadas.index.entrantes') }}" class="{{ (Request::is('llamadas/entrantes'.'*') ? 'navbar-item-selected' : '') }}">Entrantes</a></li>
    <li><a href="{{ route('llamadas.index.reclamos') }}" class="{{ (Request::is('llamadas/reclamos'.'*') ? 'navbar-item-selected' : '') }}">Reclamos</a></li>
@endpermission

@permission('crear.venta')
    <li><a href="{{ route('ventas.seleccion.cliente') }}" class="{{ (Request::is('llamadas/llamar'.'*') ? 'navbar-item-selected' : '') }} btn btn-default btn-sm"><i class="fa fa-phone-square text-success"></i> Llamar</a></li>
@endpermission
</ul>
