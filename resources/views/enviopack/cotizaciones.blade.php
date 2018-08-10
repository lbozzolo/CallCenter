@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Enviopack / <span class="text-muted">Cotizaciones</span></h2>
                        @include('enviopack.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4">

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <ul class="nav nav-pills" role="tablist" id="tab-lista">
                                    <li class="nav-item active">
                                        <a class="nav-link active" id="vendedor-tab" data-toggle="tab" href="#vendedor" role="tab" aria-controls="vendedor" aria-selected="true">Vendedor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="comprador-tab" data-toggle="tab" href="#comprador" role="tab" aria-controls="comprador" aria-selected="false">Comprador</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent" style="padding: 10px 0px">
                                    <div class="tab-pane active" id="vendedor" role="tabpanel" aria-labelledby="vendedor-tab">

                                        <div class="panel panel-default">
                                            <div class="panel-body">

                                                {!! Form::open(['url' => '../ws/cotizaciones/cotizacion', 'method' => 'get', 'class' => 'form', 'id' => 'formCotizacion']) !!}
                                                <div class="form-group">
                                                    {!! Form::label('provincia', 'Provincia*') !!}
                                                    {!! Form::select('provincia', $provincias, null, ['id' => 'select-provincia', 'class' => 'form-control select2', 'placeholder' => '']) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('codigo_postal', 'Código Postal*') !!}
                                                    {!! Form::text('codigo_postal', null, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('peso', 'Peso*') !!}
                                                    {!! Form::text('peso', null, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('paquetes', 'Paquetes (alto x ancho x largo)') !!}
                                                    {!! Form::text('paquetes', null, ['class' => 'form-control', 'placeholder' => 'ej: 20x3x5']) !!}
                                                    <small class="text-muted">Si es más de un paquete ingresarlo separado por comas</small>
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('direccion_envio', 'Dirección Envío') !!}
                                                    {!! Form::text('direccion_envio', null, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::submit('Consultar', ['class' => 'btn btn-info btn-flag btn-consulta-cotizacion', 'id' => 'btn-consulta-cotizacion']) !!}
                                                </div>
                                                {!! Form::close() !!}

                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="comprador" role="tabpanel" aria-labelledby="comprador-tab">

                                        <div class="panel panel-default">
                                            <div class="panel-body">

                                                {!! Form::open(['url' => '../ws/cotizaciones/comprador', 'method' => 'get', 'class' => 'form', 'id' => 'formCotizacionComprador']) !!}
                                                <div class="form-group">
                                                    {!! Form::label('provincia', 'Provincia*') !!}<br>
                                                    {!! Form::select('provincia', $provincias, null, ['id' => 'select-provincia-comprador', 'class' => 'form-control select2', 'placeholder' => '', 'style' => 'width: 100%']) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('codigo_postal', 'Código Postal*') !!}
                                                    {!! Form::text('codigo_postal', null, ['class' => 'form-control', 'id' => 'codigo-postal-comprador']) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('peso', 'Peso*') !!}
                                                    {!! Form::text('peso', null, ['class' => 'form-control', 'id' => 'peso-comprador']) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('paquetes', 'Paquetes (alto x ancho x largo)') !!}
                                                    {!! Form::text('paquetes', null, ['class' => 'form-control', 'id' => 'paquetes-comprador']) !!}
                                                    <small class="text-muted">Si es más de un paquete ingresarlo separado por comas</small>
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('correo', 'Correo') !!}
                                                    {!! Form::select('correo', $correos, null, ['class' => 'form-control', 'id' => 'correo-comprador']) !!}
                                                    {{--{!! Form::text('correo', null, ['class' => 'form-control', 'id' => 'correo-comprador']) !!}--}}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('direccion_envio', 'Dirección Envío') !!}
                                                    <div class="checkbox">
                                                        <label>{!! Form::checkbox('direccion_envio', '1920', false, ['id' => 'direccion-envio-comprador']) !!}Ramos Mejía</label>
                                                        {{--{!! Form::text('direccion_envio', null, ['class' => 'form-control', 'id' => 'direccion-envio-comprador']) !!}--}}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::submit('Consultar', ['class' => 'btn btn-info btn-flag btn-consulta-cotizacion', 'id' => 'btn-consulta-cotizacion']) !!}
                                                </div>
                                                {!! Form::close() !!}

                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>
                    <div class="col-lg-8 col-md-8">



                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Resultados de la consulta</h3>
                            </div>
                            <div class="panel-body">
                                <div class="overlay text-center" style="display: none; padding: 100px">
                                    Aguarde un momento por favor...<br>
                                    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
                                </div>
                                <div id="errores" style="display: none">
                                    <ul class="list-unstyled"></ul>
                                </div>
                                <table id="tbl-resultados" class="table table-bordered" style="display: none">
                                    <thead>
                                    <tr>
                                        <th>Correo</th>
                                        <th>Despacho</th>
                                        <th>Modalidad</th>
                                        <th>Promesa</th>
                                        <th>Desde / Hasta</th>
                                        <th>Servicio</th>
                                        <th>Valor</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                                <table id="tbl-resultados-comprador" class="table table-bordered" style="display: none">
                                    <caption id="tbl-resultados-comprador-caption"></caption>
                                    <thead>
                                    <tr>
                                        <th>Anómalos</th>
                                        <th>Cumple</th>
                                        <th>Modalidad</th>
                                        <th>Promesa</th>
                                        <th>Desde / Hasta</th>
                                        <th>Servicio</th>
                                        <th>Valor</th>
                                        <th>Sucursal</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('js/enviopack.js') }}"></script>
    <script>

        $('.select2').select2();

       /* $('#comprador-tab').click(function(){
            $('#select-provincia-comprador').attr('class', 'form-control select2')
            $('.select2').select2();
        });*/

        /*$(document).ready(function(){

            $('#vendedor-tab').attr('class', 'nav-link active');

        });*/

    </script>

@endsection
