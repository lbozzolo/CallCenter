@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>CLIENTES</h2>
                <hr>

                <div class="col-lg-12">

                    <div class="panel-body">
                        <a href="{{ route('clientes.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar cliente</a>
                    </div>

                    <div>
                        @include('clientes.partials.listado-clientes')
                    </div>

                </div>

            </div>
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



        });



    </script>

@endsection
