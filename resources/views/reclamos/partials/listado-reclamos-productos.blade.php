<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-reclamos-productos" style="display: none">

    <table class="table table-vertical dataTable" id="table-reclamos-productos">

        <thead>
        <tr>
            <th>Id</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Institución</th>
            <th>Reclamos</th>
        </tr>
        </thead>
        <tbody>

        @foreach($productos as $producto)

            <tr>
                <td>{!! $producto->id !!}</td>
                <td>
                    <a href="{{ route('productos.show', $producto->id) }}">
                        {!! $producto->nombre !!}
                    </a>
                </td>
                <td>{!! ($producto->marca)? $producto->marca->nombre : '---' !!}</td>
                <td>{!! ($producto->institucion)? $producto->institucion->nombre : '---' !!}</td>
                <td>
                    <a href="{{ route('reclamos.productos', $producto->id) }}">
                        ({!! ($producto->reclamos)? count($producto->reclamos) : '0' !!})
                    </a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>

