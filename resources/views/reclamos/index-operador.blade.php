@extends('base')

@section('content')

    <h2>Reclamos<span class="text-muted"> / Operador / Todos</span></h2>

    <div class="row">
        <div class="col-lg-12">

            <ul class="list-inline panel panel-barra">
                @permission('listado.reclamo')
                <li><a href="{{ route('reclamos.index.operador') }}" class="{{ (Request::is('reclamos/ventas/operador/listado') ? 'navbar-item-selected' : '') }}">Abiertos</a></li>
                <li><a href="{{ route('reclamos.index.operador', 'cerrado') }}" class="{{ (Request::is('reclamos/ventas/operador/listado/cerrado') ? 'navbar-item-selected' : '') }}">Cerrados</a></li>
                @endpermission
            </ul>

            <div class="card card-default">
                <div class="card-body">
                    @permission('listado.reclamo')
                    @include('reclamos.partials.listado-reclamos')
                    @endpermission
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')

    <script>

        $(document).ready(function() {
            $('#table-reclamos').DataTable({
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

            $("#div-table-reclamos").show();
            $(".overlay").hide();

        });

    </script>

@endsection