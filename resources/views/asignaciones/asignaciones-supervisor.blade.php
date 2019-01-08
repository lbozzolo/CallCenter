@extends('asignaciones.base')

@section('titulo')

    <h2>Mis Tareas</h2>
    <br>

@endsection

@section('contenido')

    <div class="tab-content">
        @permission('crear.asignacion')
        <div class="tab-pane active card" id="tab_1" style="margin-top: 0px">

            @include('asignaciones.partials.listado-operadores-para-supervisor')

        </div>
        @endpermission
    </div>

@endsection


@section('js')

    <script>

        $(document).ready(function() {


            $('#table-enable-users').DataTable({
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
            $("#div-table-enable-users").show();
            $(".overlay").hide();


            //=====================================================================


            $("#div-table-enable-datos").show();
            $("#listado-datos").show();
            $(".overlay").hide();


        });

    </script>


@endsection