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
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($productos as $producto)

            <tr>
                <td>{!! $producto->id !!}</td>
                <td>
                    <a href="{{ route('productos.show', $producto->id) }}" style="color: cyan">{!! $producto->nombre !!}</a>
                </td>
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
                <td class="text-center">
                @permission('crear.venta')
                    {!! Form::open(['url' => route('ventas.crear'), 'method' => 'post']) !!}

                        {!! Form::hidden('id_cliente', $cliente->id) !!}
                        {!! Form::hidden('id_producto', $producto->id) !!}
                        <button type="submit" class="btn btn-primary btn-xs">seleccionar</button>

                    {!! Form::close() !!}
                @endpermission

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
