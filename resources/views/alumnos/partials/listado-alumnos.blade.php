<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-clientes" style="display: none;">

    <table class="table table-vertical dataTable" id="table-clientes">

        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th class="text-center">Cursos activos</th>
            <th class="text-center">Cursos inactivos</th>
            <th class="text-center">Notificado</th>
            <th class="text-center">Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($clientes as $cliente)

            <tr>
                <td>{!! $cliente->id !!}</td>
                <td>{!! $cliente->full_name !!}</td>
                <td>{!! ($cliente->dni)? $cliente->dni : "<span class='label label-danger'>sin dni</span><i class='fa fa-exclamation-circle'></i>" !!}</td>
                <td class="text-center">
                    {!! $cliente->cursosActivos()->count() !!}
                </td>
                <td class="text-center">
                    {!! ($cliente->cursosInactivos()->count() > 0)? "<span class='label label-warning'>".$cliente->cursosInactivos()->count()."</span>" : $cliente->cursosInactivos()->count() !!}
                </td>
                <td class="text-center">
                    @if($cliente->notificado)
                        <i class="fa fa-check text-success"></i>
                        @else
                        <i class="fa fa-close text-danger"></i>
                    @endif
                </td>
                <td style="text-align: center">
                    @permission('ver.cliente')
                    <a href="{{ route('alumnos.cursos', $cliente->id) }}" class="btn btn-primary btn-xs" title="Cursos comprados"><i class="fa fa-book"></i> </a>
                    @elsepermission
                    <button class="btn btn-default btn-xs" disabled>detalles</button>
                    @endpermission

                    @permission('ver.updateable')
                    <a href="{{ route('updateables.entidad.show', ['entity' => $cliente->getClass(), 'id' => $cliente->id]) }}" class="btn btn-updateable btn-xs" title="movimientos"><i class="fa fa-info-circle"></i> </a>
                    @endpermission
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
