@extends('llamadas.base')

@section('titulo')

    <h2>Llamadas<span class="text-muted"> / realizar llamada</span></h2>

@endsection


@section('contenido')

    <div class="panel panel-default">
        <div class="panel-body">

            <nav class="navbar navbar-default">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <div class="row">
                        <ul class="nav navbar-nav col-lg-12">
                            <li class="col-lg-4 text-center"><a href="{{ route('llamadas.seleccion.cliente') }}">1. Cambiar cliente <span class="glyphicon glyphicon-user"></span> </a></li>
                            <li class="col-lg-4 text-center"><a href="{{ route('llamadas.seleccion.producto', $cliente->id) }}">2. Cambiar producto <i class="fa fa-briefcase"></i> </a> </li>
                            <li class="col-lg-4 text-center active"><a href="">3. Panel de llamada <i class="fa fa-phone-square"></i> </a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="panel panel-body small">
                <ul class="list-unstyled list-inline pull-right">
                    <li><a href="{{ route('llamadas.agregar.producto') }}"><i class="fa fa-plus"></i> agregar producto</a></li>
                    <li><a href="{{ route('llamadas.seleccion.cliente') }}" class="text-success"><i class="fa fa-check"></i> concretar venta</a></li>
                </ul>
            </div>


            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6">

                    <div class="panel panel-default"  style="max-height: 500px; overflow: scroll; overflow-x: hidden">
                        <div class="panel-heading">
                            <span class="panel-title">Buscar producto</span>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <form class="form-horizontal">
                                            <div class="col-lg-12">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-sm-8">
                                                            <div class="input-group input-group-sm">
                                                                {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'txt_valor']) !!}
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-info btn-flat" id="btn_search">
                                                                        <i class="fa fa-search"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br class="clearfix" />
                                                </fieldset>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row">

                                    </div>
                                    <div class="row" id="div-table-resultados">
                                        <div class="text-center">
                                            <i class="fa fa-refresh fa-spin" style="display: none; font-size: 2em" id="cargando"></i>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="panel panel-info">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="tbl-resultados">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nombre</th>
                                                                <th>Marca</th>
                                                                <th>Precio</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="sinresultados">
                                        <div class="col-lg-12">
                                            <span class="text-muted">Sin resultados.</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">

                    <div id="listado">

                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    @include('llamadas.partials.panel-producto')
                </div>

                <div class="col-lg-3">
                    @include('llamadas.partials.panel-cliente')
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    @include('llamadas.partials.panel-cierre-venta')
                </div>

                {{--<div class="col-lg-2 col-md-2 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Acciones</h4>
                        </div>
                        <div class="panel-body">
                            Contenido...
                        </div>
                    </div>
                </div>--}}

            </div>

        </div>
    </div>

@endsection


@section('js')

    <script type="text/javascript">

        $(document).ready(function() {

            $('#div-table-resultados').hide();
            $('#sinresultados').hide();

            $("#btn_search").click(function( ev ){

                $('#cargando').show();
                ev.preventDefault();
                var token = $("input[name*='_token']").val();
                var valor = $("#txt_valor").val();
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

                if(data.length > 0)
                {
                    $.each(data, function(i, d) {

                        var id = d.id;
                        html =  '<tr>';
                        html += '<td>' + d.id + '</td>';
                        html += '<td><em class="icon-layers"></em> ' + d.nombre + '</td>';
                        html += '<td><em class="icon-layers"></em> ' + d.marca.nombre + '</td>';
                        html += '<td>$' + d.precio + '</td>';
                        html += '<td>' + '<button type="button" class="agregar_a_lista btn btn-primary btn-xs" data-id="' + d.id + '" data-nombre="' + d.nombre + '" data-marca="' + d.marca.nombre + '" data-precio="' + d.precio + '" data-stock="' + d.stock + '" data-descripcion="' + d.descripcion + '">agregar</button>' + '</td>';
                        html += '</tr>';
                        table.append(html);
                    });
                    $('#sinresultados').hide();
                    $('#div-table-resultados').show();

                    $('.agregar_a_lista').click(function () {

                        var html;
                        var producto_id = $(this).attr('data-id');
                        var producto_nombre = $(this).attr('data-nombre');
                        var producto_marca = $(this).attr('data-marca');
                        var producto_precio = $(this).attr('data-precio');
                        var producto_stock = $(this).attr('data-stock');
                        var producto_descripcion = $(this).attr('data-descripcion');
                        var listado = $('#listado');
                        if(!listado.is(':visible')){
                            listado.show();
                        }

                        html = '<div class="panel panel-default" id="producto' + producto_id + '">';

                            //Panel heading
                            html += '<div class="panel-heading" style="cursor: pointer" data-toggle="collapse" data-target="#collapseProducto' + producto_id + '" aria-expanded="false" aria-controls="collapseCategoria">';
                                html += '<button type="button" class="quitar_de_la_lista nonStyledButton pull-right" data-id="' + producto_id + '"><i class="fa fa-close"></i></button>';
                                html += '<h3 class="panel-title">Producto: ' + producto_nombre + '(' + producto_marca + ') <i class="fa fa-caret-down"></i></h3>';
                            html += '</div>';

                            //Panel body
                            html += '<div class="panel-body collapse" id="collapseProducto' + producto_id + '" aria-labelledby="headingOne" data-parent="#accordion">';

                                html += '<div>';
                                    html += '<span class="text-info pull-right" style="font-size: 2em">$ ' + producto_precio + '</span>';
                                    html += '<small class="label label-default">stock: ' + producto_stock + '</small>';
                                    html += '<h4>' + producto_nombre + ', ' + producto_marca + '</h4>';
                                html += '</div>';

                                html += '<div><strong>Descripción</strong><br>' + producto_descripcion + '</div>';

                                html += '<div class="panel">';
                                    html += '<div>';
                                        html += '<form style="display: inline-block">';
                                            html += '<input type="hidden" name="productoId" value="' + producto_id + '">';
                                            html += '<button type="button" class="prospecto nonStyledButton btn-xs" data-id="' + producto_id + '"><span class="text-primary">Prospecto</span>';
                                        html += '</form>';
                                    html += '</div>';
                                    html += '<button type="button" id="close_prospecto' + producto_id + '" style="display: none" class="close_prospecto nonStyledButton pull-right" data-id="' + producto_id + '"><i class="fa fa-caret-up"></i></button>';
                                    html += '<div id="prospecto-div' + producto_id + '" class="panel-body"></div>';
                                html += '</div>';

                            html += '</div>';

                        html += '</div>';

                        // Agregado de producto a listado de productos
                        $('#ningunProductoSeleccionado').hide();
                        listado.append(html);


                        $('.prospecto').click(function(ev){

                            ev.preventDefault();
                            var productoId = $("input[name*='productoId']").val();
                            var prospectoDiv = $('#prospecto-div' + productoId);

                            $.ajax({
                                method: 'GET',
                                url: 'productos/prospecto',
                                dataType: 'json',
                                data: {
                                    producto_id : productoId
                                }
                            }).done(ResultadoProspecto);

                            function ResultadoProspecto(data){

                                prospectoDiv.empty();
                                prospectoDiv.prev().show();
                                prospectoDiv.append(data);

                            }

                            var botonCloseProspecto = $('#close_prospecto' + productoId);

                            botonCloseProspecto.click(function () {
                                prospectoDiv.empty();
                                $(this).hide();
                            });

                        });


                        // Quitar producto de listado de productos
                        $('.quitar_de_la_lista').click(function () {
                            $('#producto' + $(this).attr('data-id')).remove();
                            if($('#listado').children().length === 0){
                                $('#listado').hide();
                                $('#ningunProductoSeleccionado').show();
                            }
                        });

                    });


                }else{

                    $('#div-table-resultados').hide();
                    $('#sinresultados').show();

                }




            }


        });



    </script>

@endsection



