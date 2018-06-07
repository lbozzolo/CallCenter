@extends('llamadas.base')

@section('titulo')

    <h2>Llamadas<span class="text-muted"> / {!! $llamadas->title !!}</span></h2>

@endsection


@section('contenido')

    <div class="panel panel-default">
        <div class="panel-body">
            @include('llamadas.partials.listado-llamadas')
        </div>
    </div>

@endsection


@section('js')

    <script>

        $(document).ready(function() {
            $('#table-llamadas').DataTable({
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
            $("#div-table-llamadas").show();
            $(".overlay").hide();



        });

    </script>

@endsection

