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
            <th>Compras</th>
            <th>Llamadas</th>
            <th>Alta</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes as $cliente)

            <tr>
                <td>{!! $cliente->id !!}</td>
                <td>{!! $cliente->full_name !!}</td>
                <td>{!! $cliente->email !!}</td>
                <td>{!! $cliente->dni !!}</td>
                <td>
                    @if($cliente->estado->slug == 'nuevo')
                        <label class="label label-success">{!! $cliente->estado->nombre !!}</label>
                    @elseif($cliente->estado->slug == 'frecuente')
                        <label class="label label-default">{!! $cliente->estado->nombre !!}</label>
                    @elseif($cliente->estado->slug == 'deshabilitado')
                        <label class="label label-danger">{!! $cliente->estado->nombre !!}</label>
                    @endif
                </td>
                <td class="text-center">
                @permission('ver.compras.cliente')
                    <a href="{{ route('clientes.compras', $cliente->id) }}">
                        {!! $cliente->ventas->count() !!}
                    </a>
                @endpermission
                </td>
                <td>//</td>
                <td>{!! $cliente->fecha_creado !!}</td>
                <td class="text-center">
                @permission('crear.venta')
                    <a href="{{ route('ventas.crear', $cliente->id) }}" class="btn btn-sm btn-primary">seleccionar</a>
                @endpermission
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
