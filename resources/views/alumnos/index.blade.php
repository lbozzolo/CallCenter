@extends('clientes.base')

@section('titulo')

    <h2>Alumnos de COEFIX</h2>

@endsection

@section('contenido')

    <div class="card card-default">
        <div class="card-body">
            @permission('listado.cliente')
            @include('alumnos.partials.listado-alumnos')
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

