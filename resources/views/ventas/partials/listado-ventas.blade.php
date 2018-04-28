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
            <th>Producto</th>
            <th>Etapa</th>
            <th>Fecha</th>
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
                <td>{!!  ($venta->producto)?$venta->producto->nombre : '' !!}</td>
                <td class="text-center">{!! ($venta->etapa)? $venta->etapa->nombre : '//' !!}</td>
                <td>{!! $venta->fecha_creado !!}</td>
                <td class="text-center">
                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-default btn-sm">detalles</a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
