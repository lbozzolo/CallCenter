@extends('sucursales.base')

@section('titulo')

    <h2>Sucursales</h2>

@endsection

@section('contenido')

    <div class="card">
        <div class="card-header">
            <a href="{!! route('sucursales.create') !!}" class="btn btn-primary">Nueva sucursal</a>
        </div>
    </div>
    <div class="card card-default">

        <div class="card-body">

            @include('sucursales.partials.listado-sucursales')

        </div>
    </div>

@endsection


@section('js')

    <script>

        $(document).ready(function() {
            $('#table-sucursales').DataTable({
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

            $("#div-table-reclamos").show();
            $(".overlay").hide();

        });

    </script>

@endsection

