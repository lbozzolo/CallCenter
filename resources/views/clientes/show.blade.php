@extends('clientes.base')

@section('titulo')

    <h2>
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
                                <span class="label label-success">{!! $cliente->estado->nombre !!}</span>
                            @else
                                <span class="label label-default pull-right">{!! $cliente->estado->nombre !!}</span>
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
                                    Referencia<br>
                                    {!! ($cliente->referencia)? $cliente->referencia : '<small class="text-muted">sin datos</small>' !!}
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
            <div class="card">
                <div class="card-header">
                    <ul class="list-unstyled list-inline">
                        <li><h3>Tarjetas asociadas</h3></li>
                        <li><button class="nonStyledButton" style="color:cyan" id="botonNuevaTarjeta"><i class="fa fa-plus"></i> Agregar</button> </li>
                    </ul>
                </div>
                <div class="card-body">

                    <div class="panel" id="nuevaTarjeta" style="display:none;">
                        <div class="panel-heading">
                            <h4 class="panel-title" style="color:white">Nueva Tarjeta</h4>
                        </div>
                        <div class="panel-body">

                            @include('clientes.partials.formulario-datos-tarjeta')

                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background-color: gray">
                                    <th>Tarjeta</th>
                                    <th>Banco</th>
                                    <th>Nº Tarjeta</th>
                                    <th>Código</th>
                                    <th>Titular</th>
                                    <th>Fecha expiración</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($cliente->hasCard('credito') || $cliente->hasCard('debito'))
                                @foreach($cliente->datosTarjeta as $tarjeta)
                                    <tr>
                                        <td>{!! $tarjeta->marca->nombre !!}</td>
                                        <td>{!! $tarjeta->banco->nombre !!}</td>
                                        <td>{!! $tarjeta->card_number !!}</td>
                                        <td>{!! $tarjeta->security_number !!}</td>
                                        <td>{!! $tarjeta->titular !!}</td>
                                        <td>{!! $tarjeta->expiration_date !!}</td>
                                        <td>
                                            <button type="button" title="Eliminar tarjeta" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#eliminarTarjeta{!! $tarjeta->id !!}" style="border: none">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <div class="modal fade col-lg-2 col-lg-offset-10" id="eliminarTarjeta{!! $tarjeta->id !!}">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Eliminar Tarjeta</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="text-danger">¿Desea eliminar esta tarjeta?</p>
                                                    </div>
                                                    <div class="card-footer">

                                                        {!! Form::open(['url' => route('clientes.eliminar.tarjeta', $tarjeta->id), 'method' => 'delete']) !!}
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        </div>
                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <span class="text-muted">No hay ninguna tarjeta asociada a este cliente</span><br>
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>





@endsection

@section('js')


    <script>

        $( window ).load(function() {

            $('.datepicker').datepicker();

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

