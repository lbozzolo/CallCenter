@extends('clientes.base')

@section('titulo')

    <h2>Clientes / <span class="text-muted">Agregar nuevo cliente</span> </h2>

@endsection

@section('contenido')

    {!! Form::open(['method' => 'post', 'url' => route('clientes.store'), 'class' =>'form']) !!}


    <div class="col-lg-6 col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Datos personales</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('apellido', 'Apellido') !!}
                            {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('telefono', 'Teléfono') !!}
                            {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('celular', 'Celular') !!}
                            {!! Form::text('celular', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('dni', 'DNI') !!}
                            {!! Form::text('dni', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('referencia', 'Referencia') !!}
                            {!! Form::textarea('referencia', null, ['class' => 'form-control', 'rows' => '2']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('observaciones', 'Observaciones') !!}
                            {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '2']) !!}
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        {!! Form::label('contacto', 'Horario de contacto:') !!}
                    </div>
                    <div class="form-group col-xs-6">
                        {!! Form::label('from_date', 'Desde') !!}
                        {!! Form::time('from_date', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-xs-6">
                        {!! Form::label('to_date', 'Hasta') !!}
                        {!! Form::time('to_date', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('puntos', 'Puntos') !!}
                            {!! Form::number('puntos', null, ['class' => 'form-control', 'min' => '0', 'max' => '10000']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('estado', 'Estado') !!}
                            {!! Form::select('estado_id', $estados, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">Domicilio</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::label('calle', 'Calle') !!}
                            {!! Form::text('calle', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('numero', 'Número') !!}
                            {!! Form::number('numero', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('piso', 'Piso') !!}
                            {!! Form::number('piso', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('departamento', 'Departamento') !!}
                            {!! Form::text('departamento', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('codigo_postal', 'Código Postal') !!}
                            {!! Form::number('codigo_postal', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('entre_calles', 'Entre Calles') !!}
                    {!! Form::text('entre_calles', null, ['class' => 'form-control', 'placeholder' => 'ej: Av San Martín y Saavedra']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('provincia', 'Provincia') !!}
                    {!! Form::select('provincia', $provincias, null, ['class' => 'form-control select2', 'id' => 'provincia']) !!}
                </div>


                <div class="form-group" id="partidoDiv">
                    @if(isset($partidos))
                        {!! Form::label('partido', 'Partido', ['id' => 'partidoLabel']) !!}
                        {!! Form::select('partido', null, ['class' => 'form-control']) !!}
                    @endif
                </div>

                <div class="form-group" id="localidadDiv">
                    @if(isset($localidades))
                        {!! Form::label('localidad', 'Localidad', ['id' => 'localidadLabel']) !!}
                        {!! Form::select('localidad', null, ['class' => 'form-control']) !!}
                    @endif
                </div>

            </div>

        </div>

        {!! Form::submit('Agregar cliente', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('clientes.index') }}" class="btn btn-default">Cancelar</a>

    </div>

    {!! Form::close() !!}

@endsection

@section('js')

    <script>

        $('.select2').select2({});


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
