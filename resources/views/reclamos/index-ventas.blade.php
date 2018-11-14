@extends('reclamos.base')

@section('titulo')

    <h2>Reclamos <span class="text-muted">/ Ingresar-reclamo</span> </h2>

@endsection


@section('contenido')

    <div class="card card-default">
        <div class="card-header">
            <h3>Seleccione la venta a la que le asignará un reclamo.</h3>
        </div>
        <div class="card-body">

            @include('reclamos.partials.listado-ventas')

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