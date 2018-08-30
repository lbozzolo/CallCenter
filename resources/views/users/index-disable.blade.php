@extends('users.base')

@section('titulo')

    <h2>Usuarios<span class="text-muted"> / Deshabilitados</span></h2>

@endsection

@section('contenido')

    <div class="card panel-default">
        <div class="card-body">
        @permission('listado.usuario')
            @include('users.partials.usuarios-deshabilitados')
        @endpermission
        </div>
    </div>

@endsection


@section('js')

    <script>

        $(document).ready(function() {


            $('#table-disable-users').DataTable({
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
            $("#div-table-disable-users").show();
            $(".overlay").hide();

        });



    </script>

@endsection

