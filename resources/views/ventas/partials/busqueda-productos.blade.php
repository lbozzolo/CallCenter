<div class="panel" style="display: none" id="listadoProductos">
    <div class="panel-heading">
        <h4>Listado de productos</h4>
    </div>
    <div class="panel-body">
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
                    <th>Precio</th>
                    <th>Descripcion</th>
                    <th>Categorías</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($productos as $agregarProducto)

                    @if(!$venta->productos->contains($agregarProducto))
                    <tr>
                        <td>{!! $agregarProducto->id !!}</td>
                        <td>
                            <a href="{{ route('productos.show', $agregarProducto->id) }}" title="Info">{!! $agregarProducto->nombre !!}</a>
                        </td>
                        <td>{!! ($agregarProducto->marca)? $agregarProducto->marca->nombre : '' !!}</td>
                        <td>${!! $agregarProducto->precio !!}</td>
                        <td>{!! $agregarProducto->descripcion !!}</td>
                        <td>
                            @foreach($agregarProducto->categorias as $categoria)
                                <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                            @endforeach
                        </td>
                        <td>
                            @if($agregarProducto->alerta_stock >= $agregarProducto->stock)
                                <span style="color: red" title="producto con bajo stock">{!! $agregarProducto->stock !!}</span>
                            @else
                                {!! $agregarProducto->stock !!}
                            @endif
                        </td>
                        <td>
                            @if($agregarProducto->estado->slug == 'activo')
                                <label class="label label-success">{!! $agregarProducto->estado->nombre !!}</label>
                            @elseif($agregarProducto->estado->slug == 'inactivo')
                                <label class="label label-default">{!! $agregarProducto->estado->nombre !!}</label>
                            @endif
                        </td>
                        <td class="text-center">
                            @permission('crear.venta')
                            {!! Form::open(['url' => route('ventas.agregar.producto'), 'method' => 'POST']) !!}
                                {!! Form::hidden('producto_id', $agregarProducto->id) !!}
                                {!! Form::hidden('venta_id', $venta->id) !!}
                                <button type="submit" class="btn btn-primary btn-flat btn-sm">seleccionar</button>
                            {!! Form::close() !!}
                            @endpermission
                        </td>
                    </tr>
                    @endif

                @endforeach

                </tbody>
            </table>



        </div>

    </div>
</div>
