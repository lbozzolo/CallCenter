@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>USUARIOS deshabilitados</h2>
                <hr>

                <div class="col-lg-12">

                    <div class="panel-body">
                        <a href="{{ route('users.index') }}" class="btn btn-default">Habilitados</a>
                        <a href="{{ route('users.index.disable') }}" class="btn btn-default">Deshabilitados</a>
                    </div>

                    <div>
                        @include('users.partials.usuarios-deshabilitados')
                    </div>


                </div>

            </div>
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
                    "search": "<i class='fa fa-search'></i>",
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

