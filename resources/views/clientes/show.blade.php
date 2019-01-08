@extends('clientes.base')

@section('titulo')

    <h2>
        Clientes /
        {!! $cliente->full_name !!}
        <span class="text-muted"> / Datos personales</span>
    </h2>

@endsection

@section('contenido')


    <div class="row">
        <div class="col-lg-12">

            <div class="card alert">
                <div class="card-heading">

                    <ul class="list-unstyled list-inline">
                        <li>
                            <h3 class="card-title"> <span class="text-info">{!! $cliente->email !!}</span></h3>
                        </li>
                        <li>
                            @if($cliente->estado->slug == 'nuevo')
                                <span class="label label-warning">{!! $cliente->estado->nombre !!}</span>
                            @else
                                <span class="label label-default pull-right" style="background-color: rgb(8, 142, 83);">{!! $cliente->estado->nombre !!}</span>
                            @endif
                        </li>
                        @if(!$cliente->dni)
                            <li>
                                <span class="label label-danger pull-right">sin dni</span>
                            </li>
                        @endif
                        <li class="pull-right">
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        </li>
                    </ul>

                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled listado">
                                <li class="list-group-item">
                                    Contacto
                                    <div>
                                        @if($cliente->telefono)
                                            <span><i class="fa fa-phone"></i> {!! $cliente->telefono !!}</span>
                                        @endif
                                        @if($cliente->celular)
                                            <span><i class="fa fa-mobile"></i> {!! $cliente->celular !!}</span>
                                        @endif
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div>DNI</div>
                                    {!! ($cliente->dni)? $cliente->dni : '<small class="text-muted">No hay DNI espeficifado</small>' !!}
                                </li>
                                <li class="list-group-item">
                                    CUIT<br>
                                    {!! ($cliente->cuit)? $cliente->cuit : '<small class="text-muted">sin datos</small>' !!}
                                </li>
                                <li class="list-group-item">
                                    CUIL<br>
                                    {!! ($cliente->cuil)? $cliente->cuil : '<small class="text-muted">sin datos</small>' !!}
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled listado">
                                <li class="list-group-item">
                                    <div>Horario de contacto</div>
                                    @if($cliente->from_date != $cliente->to_date)
                                        <div>
                                            De <strong>{!! $cliente->horario_desde !!}</strong>
                                            a <strong>{!! $cliente->horario_hasta !!}</strong>
                                        </div>
                                    @else
                                        <small class="text-muted">No hay horario especificado</small>
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <div>Dirección</div>

                                    @if($cliente->address == '')
                                        <small class="text-muted">No hay una dirección registrada</small>
                                    @endif
                                    <div>
                                        {!! $cliente->address !!}
                                        @if($cliente->domicilio && $cliente->domicilio->codigo_postal)
                                            - (CP {!! $cliente->domicilio->codigo_postal !!})
                                        @endif
                                    </div>
                                    <div>
                                        @if($cliente->domicilio)
                                            <span class="text-info">
                                            {!! ($cliente->domicilio->localidad)? $cliente->domicilio->localidad->localidad.',' : '' !!}
                                            {!! ($cliente->domicilio->partido)? $cliente->domicilio->partido->partido : '' !!}
                                            {!! ($cliente->domicilio->provincia)? '('.$cliente->domicilio->provincia->provincia.')' : '' !!}
                                            </span>
                                        @endif
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Referencia<br>
                                    {!! ($cliente->referencia)? $cliente->referencia : '<small class="text-muted">sin datos</small>' !!}
                                </li>
                                <li class="list-group-item">
                                    Observaciones<br>
                                    {!! ($cliente->observaciones)? $cliente->observaciones : '<small class="text-muted">sin datos</small>' !!}
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>

            </div>

        </div>

        <div class="col-lg-12">

            @include('clientes.partials.tarjetas-asociadas')

        </div>

    </div>





@endsection

@section('js')


    <script src="{{ asset('js/edicion-metodo-pago-tarjeta-asociada.js') }}"></script>
    <script>

        $( window ).load(function() {

            $('.datepicker').datepicker({
                format: "mm/yyyy",
                viewMode: "months",
                minViewMode: "months"
            });

            $( '#provincia' ).change(function( event ) {
                event.preventDefault();

                $('#partido').remove();
                $('#partidoLabel').remove();
                $('#localidad').remove();
                $('#localidadLabel').remove();

                var form = $( this );
                $.ajax({
                    type: 'GET',
                    url: 'address/partidos',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function( resp ) {

                        renderPartidosSelect(resp);

                        $( '#partido' ).change(function( event ) {
                            event.preventDefault();

                            $('#localidad').remove();
                            $('#localidadLabel').remove();

                            var form = $( this );
                            $.ajax({
                                type: 'GET',
                                url: 'address/localidades',
                                data: form.serialize(),
                                dataType: 'json',
                                success: function( loc ) {
                                    renderLocalidadesSelect(loc);
                                }
                            });
                        });

                        function renderLocalidadesSelect(loc) {

                            var html = '<label for="localidades" id="localidadLabel">Localidad</label>';
                            html += '<select name="localidad" class="form-control" id="localidad">';
                            for(var i = 0; i < loc.length; i++){
                                html += '<option value="' + loc[i].id + '">' + loc[i].localidad + '</option>';
                            }
                            html += '</select>';

                            $('#localidadDiv').append(html);
                        }


                    }
                });
            });


            function renderPartidosSelect(resp) {

                var html = '<label for="partidos" id="partidoLabel">Partido</label>';
                html += '<select name="partido" class="form-control" id="partido">';
                for(var i = 0; i < resp.length; i++){
                    html += '<option value="' + resp[i].id + '">' + resp[i].partido + '</option>';
                }
                html += '</select>';

                $('#partidoDiv').append(html);
            }

            $('#botonNuevaTarjeta').click(function () {
                $('#botonNuevaTarjeta').hide();
                $('#nuevaTarjeta').show();
            });

            $('#cancelarAsociarTarjeta').click(function () {
                $('#marcaCredito').val('');
                $('#banco').val('');
                $('#numeroTarjeta').val('');
                $('#codigoSeguridad').val('');
                $('#titular').val('');
                $('#fechaExpiracion').val('');
                $('#botonNuevaTarjeta').show()
                $('#nuevaTarjeta').hide();
            });

        });




    </script>

@endsection

