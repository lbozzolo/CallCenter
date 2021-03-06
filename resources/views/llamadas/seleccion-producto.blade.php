@extends('llamadas.base')

@section('titulo')

    <h2>Llamadas<span class="text-muted"> / realizar llamada</span></h2>

@endsection


@section('contenido')

    <div class="card card-default">
        <div class="card-body">

            <nav class="navbar navbar-default">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <div class="row">
                        <ul class="nav navbar-nav col-lg-12">
                            <li class="col-lg-4 text-center"><a href="{{ route('llamadas.seleccion.cliente') }}">1. Cambiar cliente</a></li>
                            <li class="col-lg-4 text-center active"><a href="{{ route('llamadas.seleccion.producto', $cliente->id) }}">2. Seleccionar producto</a></li>
                            <li class="col-lg-4 text-center disabled"><a href="">3. card de llamada</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            {{--<div>
                @include('llamadas.partials.card-cliente')
            </div>--}}

            <div class="card card-default">
                <div class="card-heading">
                    <h3 class="card-title">Seleccione un producto</h3>
                </div>
                <div class="card-body">
                @permission('listado.producto')
                    @include('llamadas.partials.listado-productos')
                @endpermission
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
