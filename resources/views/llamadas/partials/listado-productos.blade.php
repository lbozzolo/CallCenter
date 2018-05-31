<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-productos" style="display: none">

    <table class="table table-vertical dataTable" id="table-productos">

        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Descripcion</th>
            <th>Categorías</th>
            <th>Estado</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Última acción</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($productos as $producto)

            <tr>
                <td>{!! $producto->id !!}</td>
                <td>{!! $producto->nombre !!}</td>
                <td>{!! ($producto->marca)? $producto->marca->nombre : '' !!}</td>
                <td>{!! $producto->descripcion !!}</td>
                <td>
                    @foreach($producto->categorias as $categoria)
                        <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                    @endforeach
                </td>
                <td>
                    @if($producto->estado->slug == 'activo')
                        <label class="label label-success">{!! $producto->estado->nombre !!}</label>
                    @elseif($producto->estado->slug == 'inactivo')
                        <label class="label label-default">{!! $producto->estado->nombre !!}</label>
                    @endif
                </td>
                <td>
                    @if($producto->alerta_stock >= $producto->stock)
                        <span style="color: red" title="producto con bajo stock">{!! $producto->stock !!}</span>
                    @else
                        {!! $producto->stock !!}
                    @endif
                </td>
                <td>${!! $producto->precio !!}</td>
                <td>{!! $producto->fecha_editado !!}</td>
                <td class="text-center">
                    <a href="{{ route('llamadas.panel', ['idCliente' => $cliente->id, 'idProducto' => $producto->id]) }}" class="btn btn-primary btn-xs">seleccionar</a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
