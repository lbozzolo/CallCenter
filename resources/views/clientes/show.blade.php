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

            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($cliente->estado->slug == 'nuevo')
                        <label class="label label-success pull-right">{!! $cliente->estado->nombre !!}</label>
                    @else
                        <label class="label label-default pull-right">{!! $cliente->estado->nombre !!}</label>
                    @endif

                    <h3 class="panel-title">{!! $cliente->full_name !!}</h3>
                    <span class="text-info">{!! $cliente->email !!}</span>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <ul class="list-unstyled">
                                <li class="list-group-item">
                                    @if($cliente->puntos)
                                        <div class="pull-right">
                                            <span class="text-info" style="font-size: 2em">{!! $cliente->puntos !!}</span>
                                            <small>pts</small>
                                        </div>
                                    @endif
                                    <div>Fecha de alta <i class="fa fa-arrow-right"></i> {!! $cliente->fecha_creado !!}</div>
                                    <div>Última edición <i class="fa fa-arrow-right"></i> {!! $cliente->fecha_editado !!}</div>
                                </li>
                                <li class="list-group-item">
                                    <strong>Contacto</strong>
                                    @if($cliente->telefono)
                                        <div><i class="fa fa-phone"></i> {!! $cliente->telefono !!}</div>
                                    @endif
                                    @if($cliente->celular)
                                        <div><i class="fa fa-mobile"></i> {!! $cliente->celular !!}</div>
                                    @endif
                                </li>
                                <li class="list-group-item">DNI: {!! $cliente->dni !!}</li>
                                <li class="list-group-item">
                                    <div>Horario de contacto:</div>
                                    @if($cliente->from_date != $cliente->to_date)
                                    <div>
                                        De <strong>{!! $cliente->from_date !!}</strong>
                                        a <strong>{!! $cliente->to_date !!}</strong>
                                    </div>
                                    @else
                                        <small class="text-muted">No hay horario especificado</small>
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <strong>Dirección</strong>
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
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <ul class="list-unstyled">
                                <li class="list-group-item">
                                    <strong>Referencia</strong><br>
                                    {!! ($cliente->referencia)? $cliente->referencia : '<small class="text-muted">sin datos</small>' !!}
                                </li>
                                <li class="list-group-item">
                                    <strong>Observaciones</strong><br>
                                    {!! ($cliente->observaciones)? $cliente->observaciones : '<small class="text-muted">sin datos</small>' !!}
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


@endsection

@section('js')


    <script>

        $( window ).load(function() {


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


        });




    </script>

@endsection

