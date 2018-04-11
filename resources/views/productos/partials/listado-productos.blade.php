<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-clientes" style="display: none">

    <table class="table table-vertical dataTable" id="table-clientes">

        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Estado</th>
            <th>Fecha de alta</th>
            <th>Última acción</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($productos as $producto)

            <tr>
                <td>{!! $producto->id !!}</td>
                <td>{!! $producto->full_name !!}</td>
                <td>{!! $producto->email !!}</td>
                <td>{!! $producto->dni !!}</td>
                <td>
                    @if($producto->estado->slug == 'nuevo')
                        <label class="label label-success">{!! $producto->estado->nombre !!}</label>
                    @elseif($producto->estado->slug == 'frecuente')
                        <label class="label label-default">{!! $producto->estado->nombre !!}</label>
                    @endif
                </td>
                <td>{!! $producto->fecha_creado !!}</td>
                <td>{!! $producto->fecha_editado !!}</td>
                <td class="text-center">
                    <a href="{{ route('clientes.show', $producto->id) }}"><i class="fa fa-info-circle"></i> </a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
