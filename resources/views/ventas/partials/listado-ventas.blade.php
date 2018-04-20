<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-ventas" style="display: none">

    <table class="table table-vertical dataTable" id="table-ventas">

        <thead>
        <tr>
            <th>Id</th>
            <th>Operador</th>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Estado</th>
            <th>Método de pago</th>
            <th>Forma de pago</th>
            <th>Etapa</th>
            <th>Promoción</th>
            <th>Fecha</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($ventas as $venta)

            <tr>
                <td>{!! $venta->id !!}</td>
                <td>{!! $venta->user->full_name !!}</td>
                <td>{!! $venta->cliente->full_name !!}</td>
                <td>{!! $venta->producto->nombre !!}</td>
                <td>
                    <label class="label label-default estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! $venta->estado->nombre !!}</label>
                </td>
                <td class="text-center">{!! ($venta->metodoPago)? $venta->metodoPago->nombre : '//' !!}</td>
                <td class="text-center">{!! ($venta->formaPago)? $venta->formaPago->nombre : '//' !!}</td>
                <td class="text-center">{!! ($venta->etapa)? $venta->etapa->nombre : '//' !!}</td>
                <td class="text-center">{!! ($venta->promocion)? $venta->promocion->nombre : '//' !!}</td>
                <td>{!! $venta->fecha_creado !!}</td>
                <td class="text-center">
                    <a href="{{ route('ventas.show', $venta->id) }}"><i class="fa fa-info-circle"></i> </a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
