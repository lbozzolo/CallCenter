<ul class="list-unstyled">

    <li class="list-group-item">
        <small class="text-muted">Cliente</small><br>
        {!! $llamada->cliente->full_name !!}
    </li>
    <li class="list-group-item">
        <small class="text-muted">Receptor de la llamada</small><br>
        {!! $llamada->user->full_name !!}
    </li>
    <li class="list-group-item">
        <small class="text-muted">Resultado</small><br>
        {!! $llamada->resultado->nombre !!}
    </li>

    <li class="list-group-item">
        <small class="text-muted">Tipo de llamada</small><br>
        {!! config('sistema.llamadas.TIPO_LLAMADA.'.$llamada->tipo_llamada) !!}
    </li>
    <li class="list-group-item">
        <small class="text-muted">Audio</small><br>
        {!! $llamada->url !!}
    </li>
    <li class="list-group-item">
        <small class="text-muted">Observaciones</small><br>
        {!! $llamada->observaciones !!}
    </li>

</ul>