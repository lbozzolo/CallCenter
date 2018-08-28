@extends('ventas.base')

@section('titulo')

    <h2>Ventas<span class="text-muted">/ Llamar / Seleccionar-cliente</span></h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-default">
                            <div class="card-heading">
                                <h3 class="card-title">Seleccione un cliente</h3>
                            </div>
                            <div class="card-body">
                            @permission('listado.cliente')
                                @include('ventas.partials.listado-clientes')
                            </div>
                            @endpermission
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

