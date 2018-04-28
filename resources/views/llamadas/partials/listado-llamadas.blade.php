<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-llamadas" style="display: none">

    <table class="table table-vertical dataTable" id="table-llamadas">

        <thead>
        <tr>
            <th>Id</th>
            <th>Operador</th>
            <th>Cliente</th>
            <th>Resultado</th>
            <th class="text-center">Venta</th>
            <th>Archivo</th>
            <th>Observaciones</th>
            <th>Fecha</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($llamadas as $llamada)

            <tr>
                <td>{!! $llamada->id !!}</td>
                <td>
                @if($llamada->user)
                    <a href="{{ route('users.profile', $llamada->user->id) }}">{!! $llamada->user->full_name !!}</a>
                @endif
                </td>
                <td>
                @if($llamada->cliente)
                    <a href="{{ route('clientes.show', $llamada->cliente->id) }}">{!! $llamada->cliente->nombre !!}</a>
                @endif
                </td>
                <td>
                @if($llamada->resultado)
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
                @endif
                </td>
                <td class="text-center">
                    @if($llamada->venta)
                        #{!! $llamada->venta->id !!}
                        <a href="{{ route('ventas.show', $llamada->venta->id) }}"><i class="fa fa-info-circle"></i> </a>
                    @endif
                    {{--{!! ($llamada->venta)? $llamada->venta->id : '<small class="text-muted">//</small>' !!}--}}
                </td>
                <td><a href="">{!! $llamada->url !!}</a></td>
                <td>{!! $llamada->observaciones !!}</td>
                <td>{!! $llamada->fecha_creado !!}</td>
                <td class="text-center">

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
