@extends('base')

@section('content')

    <div class="row">

        <div class="container">

            <div class="content">
                <h2>PRODUCTOS {{ (Request::is('productos/inactivos'.'*') ? 'INACTIVOS' : 'ACTIVOS') }}</h2>

                @include('productos.partials.navbar')

                <div class="col-lg-12">
                    <div>
                        @include('productos.partials.listado-productos')
                    </div>

                </div>

            </div>
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
