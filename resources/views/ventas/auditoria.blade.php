@extends('ventas.base')

@section('titulo')

    <h2>Auditoría<span class="text-muted"> / Ventas para auditar</span></h2>

@endsection

@section('contenido')

    <div class="card card-default">
        <div class="card-body">
            @permission('listado.venta')
            @include('ventas.partials.listado-ventas')
            @endpermission
        </div>
    </div>

@endsection


@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>
    <script>

        $(document).ready(function() {
            $('#table-ventas').DataTable({
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
            $("#div-table-ventas").show();
            $(".overlay").hide();

        });

    </script>

@endsection

