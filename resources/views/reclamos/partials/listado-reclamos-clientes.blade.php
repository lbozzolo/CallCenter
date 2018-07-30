<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-reclamos-clientes" style="display: none">

    <table class="table table-vertical dataTable" id="table-reclamos-clientes">

        <thead>
        <tr>
            <th>Id</th>
            <th>Cliente</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Reclamos</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes as $cliente)

            <tr>
                <td>{!! $cliente->id !!}</td>
                <td>
                @permission('ver.cliente')
                    <a href="{{ route('clientes.show', $cliente->id) }}">
                        {!! $cliente->full_name !!}
                    </a>
                @endpermission
                </td>
                <td>{!! ($cliente->email)? $cliente->email : '---' !!}</td>
                <td>{!! ($cliente->dni)? $cliente->dni : '---' !!}</td>
                <td>
                    <a href="{{ route('reclamos.clientes', $cliente->id) }}">
                        ({!! ($cliente->reclamos)? count($cliente->reclamos) : '0' !!})
                    </a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
