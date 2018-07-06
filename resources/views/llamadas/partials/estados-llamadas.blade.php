@if($llamada->resultado->slug == 'rellamar')
    <label class="label label-warning">{!! $llamada->resultado->nombre !!}</label>
@elseif($llamada->resultado->slug == 'venta')
    <label class="label label-success">{!! $llamada->resultado->nombre !!}</label>
@elseif($llamada->resultado->slug == 'no.venta')
    <label class="label label-default">{!! $llamada->resultado->nombre !!}</label>
@elseif($llamada->resultado->slug == 'nuevo')
    <label class="label label-primary">{!! $llamada->resultado->nombre !!}</label>
@elseif($llamada->resultado->slug == 'no.responde')
    <label class="label label-info">{!! $llamada->resultado->nombre !!}</label>
@elseif($llamada->resultado->slug == 'dato.erroneo')
    <label class="label label-danger">{!! $llamada->resultado->nombre !!}</label>
@endif