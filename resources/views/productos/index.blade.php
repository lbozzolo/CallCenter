@extends('productos.base')

@section('titulo')

    <h2>
        Productos
        <span class="text-muted"> / {{ (Request::is('productos/inactivos'.'*') ? 'Inactivos' : 'Activos') }}</span>
    </h2>
    @permission('listado.producto')
    <ul class="list-inline">
        <li><a href="{{ route('productos.index') }}" class="{{ (Request::is('productos') ? 'navbar-item-selected' : '') }}">Activos</a></li>
        <li><a href="{{ route('productos.index.inactivos') }}" class="{{ (Request::is('productos/inactivos') ? 'navbar-item-selected' : '') }}">Inactivos</a></li>
        <li><a href="{{ route('productos.create') }}"><span class="text-primary"><i class="fa fa-plus"></i> Agregar</span></a></li>
    </ul>
    @endpermission

@endsection


@section('contenido')

    <div class="panel panel-default">
        <div class="panel-body">
        @permission('listado.producto')
            @include('productos.partials.listado-productos')
        @endpermission
        </div>
    </div>

@endsection


@section('js')

    <script>

        $(document).ready(function() {
            $('#table-productos').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando _PAGE_ de _PAGES_",
                    "emptyTable": "Sin datos disponibles",
                    "infoEmpty": "Sin registros",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "<i class='fa fa-search'></i> buscar",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            $("#div-table-productos").show();
            $(".overlay").hide();



        });



    </script>

@endsection
