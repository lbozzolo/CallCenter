@extends('ventas.base')

@section('titulo')

    <h2>Ventas<span class="text-muted">/ Seleccionar-producto</span></h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Cliente: {!! $cliente->full_name !!} - Seleccione un producto para vender</h3>
                            </div>
                            <div class="panel-body">
                                @include('ventas.partials.listado-productos')
                            </div>
                        </div>
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

