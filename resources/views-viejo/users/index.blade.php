@extends('users.base')

@section('titulo')

    <h2>Usuarios<span class="text-muted"> / Habilitados</span></h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                @permission('listado.usuario')
                    @include('users.partials.usuarios-habilitados')
                @endpermission
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')

    <script src="{{ asset('js/sin_foto.js') }}"></script>
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



        });



    </script>

@endsection
