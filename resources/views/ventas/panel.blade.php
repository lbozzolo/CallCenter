@extends('ventas.base')

@section('titulo')

    <h2>
        Ventas<span class="text-muted"> / Panel / Operador: {!! Auth::user()->full_name !!}</span>
        <span class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</span>
    </h2>

@endsection

@section('contenido')


        @if($venta->estado->slug == 'cancelada')


            <div class="card card-default">
                <div class="card-body">
                    <ul class="list-unstyled listado">
                        <li class="list-group-item"><strong>Cliente:</strong> {!! $venta->cliente->full_name !!}</li>
                        <li class="list-group-item">
                            <strong>{!! (count($venta->productos) > 1)? 'Productos:' : 'Producto:' !!}</strong>
                            <ul>
                                @foreach($venta->productos as $producto)
                                    <li>{!! $producto->nombre !!}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item"><strong>Fecha:</strong> {!! $venta->fecha_creado !!}</li>
                        <li class="list-group-item"><strong>Cancelación:</strong> {!! $venta->updateable->where('field', 'estado_id')->last()->fecha_creado !!}</li>
                        <li class="list-group-item"><strong>Motivo:</strong> {!! $venta->updateable->where('field', 'estado_id')->last()->reason !!}</li>
                        @permission('retomar.venta')
                        <li class="list-group-item">
                            <button type="button" class="nonStyledButton" data-toggle="modal" data-target="#retomarVenta">
                                <i class="fa fa-rotate-right text-primary"></i>
                                Retomar
                            </button>
                            <div class="modal fade col-lg-3 col-lg-offset-4" id="retomarVenta">
                                <div class="card">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Retomar venta</h4>
                                    </div>
                                    {!! Form::open(['url' => route('ventas.retomar'), 'method' => 'put']) !!}
                                    <div class="modal-body">
                                        <p>¿Desea retomar esta venta?</p>
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::hidden('venta_id', $venta->id) !!}
                                        <button type="submit" class="btn btn-primary pull-left">Retomar venta</button>
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </li>
                        @endpermission
                    </ul>
                </div>
            </div>

        @else


        @include('ventas.partials.navbar-panel')

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                @permission('editar.cliente')
                <li class="active"><a href="#tab_1" data-toggle="tab">Métodos de pago</a></li>
                @endpermission
                <li><a href="#tab_2" data-toggle="tab">Productos</a></li>
                @permission('editar.venta')
                <li><a href="#tab_3" data-toggle="tab">Datos del cliente</a></li>
                <li><a href="#tab_4" data-toggle="tab">Tarjetas asociadas</a></li>
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

                <div class="tab-pane card" id="tab_2" style="margin-top: 0px">

                    @include('ventas.partials.panel-productos')

                </div>

                @permission('editar.venta')
                <div class="tab-pane card" id="tab_3" style="margin-top: 0px">

                    @include('ventas.partials.panel-cliente')

                </div>
                <div class="tab-pane card" id="tab_4" style="margin-top: 0px">

                    @include('ventas.partials.panel-tarjetas-asociadas')

                </div>
                @endpermission
            </div>
        </div>


        @endif

@endsection


@section('js')

    <script src="{{ asset('js/tarjetas-de-credito.js') }}"></script>
    <script src="{{ asset('js/provincias-partidos-localidades.js') }}"></script>
    <script src="{{ asset('js/estados-ventas.js') }}"></script>
    <script src="{{ asset('js/edicion-metodo-pago-tarjeta-asociada.js') }}"></script>
    <script src="{{ asset('js/agregar-metodo-pago.js') }}"></script>

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

