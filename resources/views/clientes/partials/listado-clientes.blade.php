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
                    @endif
                </td>
                <td>{!! $cliente->fecha_creado !!}</td>
                <td>{!! $cliente->fecha_editado !!}</td>
                <td class="text-center">
                    <a href="{{ route('clientes.show', $cliente->id) }}"><i class="fa fa-info-circle"></i> </a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
