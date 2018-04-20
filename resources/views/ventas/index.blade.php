@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>VENTAS</h2>
                <hr>

                <div class="col-lg-12">

                    <div>
                        @include('ventas.partials.listado-ventas')
                    </div>

                </div>

            </div>
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

