@extends('ventas.base')

@section('titulo')

    <h2>
        Ventas
        <span class="text-muted">/ Panel / Operador: {!! Auth::user()->full_name !!}</span>
    </h2>
    <hr>

@endsection

@section('contenido')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">

                        @include('ventas.partials.navbar-panel')

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        @if($venta->estado->slug == 'cancelada')

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <ul class="list-unstyled">
                                            <li>
                                                <strong>Cliente:</strong> {!! $venta->cliente->full_name !!}
                                            </li>
                                            <li>
                                                <strong>{!! (count($venta->productos) > 1)? 'Productos:' : 'Producto:' !!}</strong>
                                                <ul>
                                                    @foreach($venta->productos as $producto)
                                                        <li>{!! $producto->nombre !!}</li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li>
                                                <strong>Fecha:</strong> {!! $venta->fecha_creado !!}
                                            </li>
                                            <li>
                                                <strong>Cancelación:</strong> {!! $venta->updateable->where('field', 'estado_id')->last()->fecha_creado !!}
                                            </li>
                                            <li>
                                                <strong>Motivo:</strong> {!! $venta->updateable->where('field', 'estado_id')->last()->reason !!}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        @else

                        <div class="panel panel-default">
                            <div class="panel-heading" style="cursor: pointer" data-toggle="collapse" data-target="#collapseCliente" aria-expanded="false" aria-controls="collapseCliente">
                                <div class="row">
                                    <div class="col-lg-11"><h3 class="panel-title">Datos cliente <span class="text-primary">{!! $venta->cliente->full_name !!}</span> </h3></div>
                                    <div class="col-lg-1 text-right"><i class="fa fa-caret-down"></i></div>
                                </div>
                            </div>
                            <div class="panel-body collapse" id="collapseCliente" aria-labelledby="headingOne" data-parent="#accordion">

                                <div class="row">

                                    @include('ventas.partials.panel-cliente')

                                </div>

                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" style="cursor: pointer" data-toggle="collapse" data-target="#collapseProductos" aria-expanded="false" aria-controls="collapseProductos">
                                <div class="row">
                                    <div class="col-lg-11"><h3 class="panel-title">Productos</h3></div>
                                    <div class="col-lg-1 text-right"><i class="fa fa-caret-down"></i></div>
                                </div>
                            </div>
                            <div class="panel-body collapse" id="collapseProductos" aria-labelledby="headingOne" data-parent="#accordion">

                                @include('ventas.partials.panel-productos')

                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" style="cursor: pointer" data-toggle="collapse" data-target="#collapseDatosTarjeta" aria-expanded="false" aria-controls="collapseDatosTarjeta">
                                <div class="row">
                                    <div class="col-lg-11"><h3 class="panel-title">Datos de tarjeta</h3></div>
                                    <div class="col-lg-1 text-right"><i class="fa fa-caret-down"></i></div>
                                </div>
                            </div>
                            <div class="panel-body collapse" id="collapseDatosTarjeta" aria-labelledby="headingOne" data-parent="#accordion">

                                @include('ventas.partials.formulario-datos-tarjeta')

                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('js')

    <script src="{{ asset('js/tarjetas-de-credito.js') }}"></script>
    <script src="{{ asset('js/provincias-partidos-localidades.js') }}"></script>
    <script src="{{ asset('js/estados-ventas.js') }}"></script>

    <script>

        $(document).ready(function() {

            $('#div-table-resultados').hide();
            $('#sinresultados').hide();

            $("#producto_valor").keypress(function(ev) {
                if(ev.which == 13) {
                    $('#cargando').show();
                    ev.preventDefault();
                    var token = $("input[name*='_token']").val();
                    var valor = $("#producto_valor").val();
                    $('#tbl-resultados tbody').empty();

                    $.ajax({
                        method: 'GET',
                        url: 'productos/buscar',
                        headers: {"X-CSRF-TOKEN": token},
                        dataType: 'json',
                        data: {
                            valor: valor
                        }

                    }).done(ResultadoSearch);
                }
            });


            $("#search").click(function( ev ){


                $('#cargando').show();
                ev.preventDefault();
                var token = $("input[name*='_token']").val();
                var valor = $("#producto_valor").val();
                $('#tbl-resultados tbody').empty();

                $.ajax({
                    method: 'GET',
                    url: 'productos/buscar',
                    headers: {"X-CSRF-TOKEN": token},
                    dataType: 'json',
                    data: {
                        valor: valor
                    }

                }).done(ResultadoSearch);

            });

            function ResultadoSearch(data)
            {

                $('#cargando').hide();
                var html;
                var table = $('#tbl-resultados tbody');

                if(data.length > 0) {
                    $.each(data, function (i, d) {

                        var id = d.id;
                        html = '<tr>';
                        html += '<td>' + d.id + '</td>';
                        html += '<td><em class="icon-layers"></em> ' + d.nombre + '</td>';
                        if(d.marca){
                            html += '<td><em class="icon-layers"></em> ' + d.marca.nombre + '</td>';
                        }else{
                            html += '<td><em class="icon-layers"></em>--</td>';
                        }
                        html += '<td>$' + d.precio + '</td>';
                        html += '<td>';
                        html += '<input name="venta_id" type="hidden" value="{{ $venta->id }}">';
                        html += '<input name="producto_id" type="hidden" value="' + d.id + '">';
                        html += '<button type="submit" id="agregar_producto" class="btn btn-primary btn-xs">agregar</button>';
                        html += '</td>';
                        html += '</tr>';
                        table.append(html);
                    });
                    $('#sinresultados').hide();
                    $('#div-table-resultados').show();

                }else{

                    $('#div-table-resultados').hide();
                    $('#sinresultados').show();

                }

            }

        });

    </script>

@endsection

