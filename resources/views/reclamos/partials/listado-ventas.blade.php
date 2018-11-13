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
            <th>Fecha</th>
            <th>Importe</th>
            <th>Reclamos</th>
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
                <td>{!! $venta->fecha_creado !!}</td>
                <td class="text-right">
                    <span class="text-primary" style="font-size: 1.1em">${!! $venta->importe_total !!}</span>
                </td>
                <td class="text-center">
                    @permission('ver.reclamos.venta')
                    <a href="{!! route('ventas.reclamos', $venta->id) !!}" style="color:cyan">{!! ($venta->reclamos)? $venta->reclamos->count() : '0' !!}</a>
                    @endpermission
                </td>
                <td class="text-center">
                    @permission('crear.reclamo')
                    <a href="{{ route('reclamos.create', $venta->id) }}" class="btn btn-primary btn-sm">Iniciar reclamo</a>
                    @endpermission

                    @permission('ver.venta')
                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-success btn-sm" title="Ver detalles de la venta"><i class="fa fa-eye"></i> </a>
                    @endpermission
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
