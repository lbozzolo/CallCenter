@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Clientes</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                            @permission('crear.cliente')
                                <a href="{{ route('clientes.create') }}" class="btn btn-primary" title="Agregar un nuevo cliente"><i class="fa fa-user-plus"></i> </a>
                                <a href="{{ route('clientes.importacion') }}" class="btn btn-info" title="Importar clientes desde excel"><i class="fa fa-download"></i> </a>
                                <a href="{{ route('clientes.download.excel') }}" style="padding: 0px 20px">
                                    <i class="fa fa-file-excel-o"></i> descargar excel
                                </a>
                            @endpermission
                            </div>
                            <div class="panel-body">
                            @permission('listado.cliente')
                                @include('clientes.partials.listado-clientes')
                            @endpermission
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

