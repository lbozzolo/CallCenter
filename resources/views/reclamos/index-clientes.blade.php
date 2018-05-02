@extends('base')

@section('content')

    <div class="row">

        <div class="container">

            <div class="content">
                <h2>
                    Reclamos
                    <span class="text-muted"> / Clientes</span>
                </h2>

                @include('reclamos.partials.navbar')

                <div class="col-lg-12">

                    <div>
                        @include('reclamos.partials.listado-reclamos-clientes')
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection


@section('js')

    <script>

        $(document).ready(function() {
            $('#table-reclamos-clientes').DataTable({
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
            $("#div-table-reclamos-clientes").show();
            $(".overlay").hide();



        });



    </script>

@endsection

