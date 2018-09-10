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
            @if($llamadas->title != 'Reclamos')
                <th class="text-center">Venta</th>
            @else
                <th class="text-center">Reclamo</th>
            @endif
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
                @permission('ver.usuario')
                    @if($llamada->user)
                        <a href="{{ route('users.profile', $llamada->user->id) }}">{!! $llamada->user->full_name !!}</a>
                    @endif
                @elsepermission
                        {!! $llamada->user->full_name !!}
                @endpermission
                </td>
                <td>
                @permission('ver.cliente')
                    @if($llamada->cliente)
                        <a href="{{ route('clientes.show', $llamada->cliente->id) }}">{!! $llamada->cliente->nombre !!}</a>
                    @endif
                @elsepermission
                    {!! $llamada->cliente->nombre !!}
                @endpermission
                </td>
                <td>
                @if($llamada->resultado)
                    @include('llamadas.partials.estados-llamadas')
                @endif
                </td>
                <td class="text-center">

                @permission('ver.venta')
                    @if($llamada->venta_id)
                        #{!! $llamada->venta_id !!}
                        <a href="{{ route('ventas.show', $llamada->venta_id) }}"><i class="fa fa-info-circle"></i> </a>
                    @endif
                @endpermission

                @permission('ver.reclamo')
                    @if($llamada->reclamo_id)
                        #{!! $llamada->reclamo_id !!}
                        <a href="{{ route('reclamos.show', $llamada->reclamo_id) }}"><i class="fa fa-info-circle"></i> </a>
                    @endif
                @endpermission


                </td>
                <td><a href="">{!! $llamada->url !!}</a></td>
                <td>{!! $llamada->observaciones !!}</td>
                <td>{!! $llamada->fecha_creado !!}</td>
                <td class="text-center">
                    <a href="{{ route('llamadas.show', $llamada->id) }}" class="btn btn-default btn-xs">detalles</a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
