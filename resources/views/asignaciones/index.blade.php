@extends('asignaciones.base')

@section('titulo')

    <h2>Asignaciones de Tareas</h2>
    <br>

@endsection

@section('contenido')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            @permission('crear.asignacion')
            <li class="active"><a href="#tab_1" data-toggle="tab">Asignar</a></li>
            @endpermission
            @permission('listado.asignacion')
            <li><a href="#tab_2" data-toggle="tab"><span class="text-danger">Reasignaciones ({!! count($reasignaciones) !!})</span></a></li>
            <li><a href="#tab_3" data-toggle="tab">Asignaciones actuales</a></li>
            <li><a href="#tab_4" data-toggle="tab">Asignaciones históricas</a></li>
            @endpermission
        </ul>
        <div class="tab-content">
            @permission('crear.asignacion')
            <div class="tab-pane active card" id="tab_1" style="margin-top: 0px">

                @if(isset($datos))

                    @include('asignaciones.partials.listado-operadores')

                @else

                    @include('asignaciones.partials.listado-clientes')

                @endif

            </div>
            @endpermission
            @permission('listado.asignacion')
            <div class="tab-pane card" id="tab_2" style="margin-top: 0px">

                @include('asignaciones.partials.listado-reasignaciones')

            </div>
            <div class="tab-pane card" id="tab_3" style="margin-top: 0px">

                @include('asignaciones.partials.listado-asignaciones-actuales')

            </div>
            <div class="tab-pane card" id="tab_4" style="margin-top: 0px">

                @include('asignaciones.partials.listado-historico')

            </div>
            @endpermission
        </div>
    </div>


@endsection


@section('js')

    <script>


        $(document).ready(function() {


            $('#table-clientes').DataTable({
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
            $("#div-table-clientes").show();
            $(".overlay").hide();


            //=====================================================================


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


            //=====================================================================


            $('#table-asignaciones-actuales').DataTable({
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


            //=====================================================================


            $('#table-asignaciones-historicas').DataTable({
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
            }).order([0, 'desc']).draw();


        });



    </script>


@endsection