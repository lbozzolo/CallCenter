@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            {!! $cliente->full_name !!}
                            <span class="text-muted"> / Datos personales</span>
                        </h2>
                        @include('clientes.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="col-lg-6 col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="list-group-item">Nombre: {!! $cliente->nombre !!}</li>
                                        <li class="list-group-item">Apellido: {!! $cliente->apellido !!}</li>
                                        <li class="list-group-item">Dirección: {!! $cliente->direccion !!}</li>
                                        <li class="list-group-item">Teléfono: {!! $cliente->telefono !!}</li>
                                        <li class="list-group-item">Celular: {!! $cliente->celular !!}</li>
                                        <li class="list-group-item">Email: {!! $cliente->email !!}</li>
                                        <li class="list-group-item">DNI: {!! $cliente->dni !!}</li>
                                        <li class="list-group-item">Referencia: {!! $cliente->referencia !!}</li>
                                    </ul>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="list-group-item">Observaciones: {!! $cliente->observaciones !!}</li>
                                        <li class="list-group-item">Puntos: {!! $cliente->puntos !!}</li>
                                        <li class="list-group-item">Estado: {!! $cliente->estado->nombre !!}</li>
                                        <li class="list-group-item">Fecha de alta: {!! $cliente->fecha_creado !!}</li>
                                        <li class="list-group-item">Fecha de última acción: {!! $cliente->fecha_editado !!}</li>
                                        <li>
                                            <a href="{{ route('clientes.edit', $cliente->id) }}"><i class="fa fa-edit"></i> editar</a>
                                        </li>
                                    </ul>
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

