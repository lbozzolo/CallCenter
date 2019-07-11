@extends('ventas.base')

@section('titulo')

    <h2>
        Ventas<span class="text-muted"> / Panel / Operador: {!! Auth::user()->full_name !!}</span>
        <span class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}" title="#{!! $venta->id !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</span>
    </h2>

@endsection

@section('contenido')


        @if($venta->estado->slug == 'cancelada')

            @include('ventas.partials.venta-cancelada')

        @else

        @include('ventas.partials.panel-venta')

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                @permission('editar.cliente')
                <li class="active"><a href="#tab_1" data-toggle="tab">Métodos de pago</a></li>
                @endpermission
                @permission('editar.venta')
                <li><a href="#tab_3" data-toggle="tab">Tarjetas asociadas</a></li>
                <li><a href="#tab_4" data-toggle="tab">Datos del cliente</a></li>
                @endpermission
            </ul>
            <div class="tab-content">
                @permission('editar.cliente')
                <div class="tab-pane active card" id="tab_1" style="margin-top: 0px">

                    @if(count($venta->productos) > 0)

                        @include('ventas.partials.panel-metodos-de-pago')

                    @else

                        <div class="card">
                            <div class="card-header">
                                <span class="text-warning">Todavía no puede agregar métodos de pago ya que aún no hay ningún producto seleccionado en esta venta.</span>
                            </div>
                        </div>

                    @endif

                </div>
                @endpermission


                @permission('editar.venta')
                <div class="tab-pane card" id="tab_3" style="margin-top: 0px">

                    @include('ventas.partials.panel-tarjetas-asociadas')


                </div>
                <div class="tab-pane card" id="tab_4" style="margin-top: 0px">

                    @include('ventas.partials.panel-cliente')

                </div>
                @endpermission
            </div>
        </div>

        <div class="card panel panel-barra">

            @include('ventas.partials.cobrar-venta')

        </div>

        @include('ventas.partials.navbar-panel')


        @endif

@endsection

@section('js')

    <script src="{{ asset('js/tarjetas-de-credito.js') }}"></script>
    <script src="{{ asset('js/provincias-partidos-localidades.js') }}"></script>
    <script src="{{ asset('js/estados-ventas.js') }}"></script>
    <script src="{{ asset('js/edicion-metodo-pago-tarjeta-asociada.js') }}"></script>
    <script src="{{ asset('js/agregar-metodo-pago.js') }}"></script>

    <script>

        $('.select2').select2({
            multiple: true
        });

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

