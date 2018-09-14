<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-ventas" style="display: none">

    <table class="table table-vertical dataTable" id="table-ventas">

        <thead>
        <tr>
            <th>Id</th>
            <th>Estado</th>
            <th>Operador</th>
            <th>Cliente</th>
            <th>Productos</th>
            <th>Etapa</th>
            <th>Reclamos</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($ventas as $venta)

            <tr>
                <td>{!! $venta->id !!}</td>
                <td>
                    <label class="label label-default estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! $venta->estado->nombre !!}</label>
                </td>
                <td>{!! ($venta->user)? $venta->user->full_name : '' !!}</td>
                <td>{!! ($venta->cliente)? $venta->cliente->full_name : '' !!}</td>
                {{--<td>{!! ($venta->producto)? $venta->producto : '' !!}</td>--}}
                <td>
                @permission('ver.producto')
                    @if($venta->productos)
                        <ul>
                            @foreach($venta->productos as $producto)
                                <li><a href="{{ route('productos.show', $producto->id) }}">{!! $producto->nombre !!}</a></li>
                            @endforeach
                        </ul>
                    @endif
                @endpermission
                </td>
                <td class="text-center">{!! ($venta->etapa)? $venta->etapa->nombre : '-' !!}</td>
                <td class="text-center">{!! ($venta->reclamos)? $venta->reclamos->count() : '0' !!}</td>
                <td>{!! $venta->fecha_creado !!}</td>
                <td class="text-right">
                    <span class="text-primary" style="font-size: 1.1em">${!! $venta->importe_total !!}</span>
                </td>
                <td class="text-center">
                @permission('ver.venta')
                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-default btn-sm">detalles</a>
                @endpermission
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
