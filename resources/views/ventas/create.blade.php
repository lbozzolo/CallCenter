@extends('ventas.base')

@section('titulo')

    <h2>Ventas<span class="text-muted">/ Llamar / Seleccionar-cliente</span></h2>

@endsection

@section('contenido')

    <div class="card card-default">
        <div class="alert alert-warning bg-warning text-center">
            <span class="lead "><i class="fa fa-arrow-down pull-left"></i> Seleccione un cliente <i class="fa fa-arrow-down pull-right"></i></span>
        </div>
        <div class="card-body">
        @permission('listado.cliente')
            @include('ventas.partials.listado-clientes')
        @endpermission
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

