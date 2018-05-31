@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Llamadas<span class="text-muted"> / realizar llamada</span></h2>
                        @include('llamadas.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <nav class="navbar navbar-default">
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                        <div class="row">
                                            <ul class="nav navbar-nav col-lg-12">
                                                <li class="col-lg-4 text-center"><a href="{{ route('llamadas.seleccion.cliente') }}">1. Cambiar cliente</a></li>
                                                <li class="col-lg-4 text-center active"><a href="{{ route('llamadas.seleccion.producto', $cliente->id) }}">2. Seleccionar producto</a></li>
                                                <li class="col-lg-4 text-center disabled"><a href="">3. Panel de llamada</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>

                                <div>
                                    @include('llamadas.partials.panel-cliente')
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Seleccione un producto</h3>
                                    </div>
                                    <div class="panel-body">

                                        @include('llamadas.partials.listado-productos')

                                    </div>
                                </div>

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
