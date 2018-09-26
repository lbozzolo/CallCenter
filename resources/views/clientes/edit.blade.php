@extends('clientes.base')

@section('titulo')

    <h2>
        {!! $cliente->full_name !!}
        <span class="text-muted"> / Datos personales</span>
    </h2>

@endsection

@section('contenido')

    <div class="row">
        {!! Form::model($cliente, ['method' => 'put', 'url' => route('clientes.update', $cliente->id), 'class' =>'form']) !!}


        <div class="col-lg-6 col-md-6">


            <div class="card panel-default">
                <div class="card-heading">
                    <h3 class="card-title">Editar datos</h3>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('apellido', 'Apellido') !!}
                        {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('telefono', 'Teléfono') !!}
                        {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('celular', 'Celular') !!}
                        {!! Form::text('celular', null, ['class' => 'form-control']) !!}
                    </div>
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
                        {!! Form::textarea('referencia', null, ['class' => 'form-control', 'rows' => '4']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('observaciones', 'Observaciones') !!}
                        {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '4']) !!}
                    </div>
                    <div class="row">
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
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            {!! Form::label('puntos', 'Puntos') !!}
                            {!! Form::number('puntos', null, ['class' => 'form-control', 'min' => '0', 'max' => '10000']) !!}
                        </div>
                        <div class="form-group col-xs-6">
                            {!! Form::label('estado', 'Estado') !!}
                            {!! Form::select('estado_id', $estados, null, ['class' => 'form-control select2']) !!}
                        </div>
                    </div>

                </div>
            </div>



        </div>

        <div class="col-lg-6 col-md-6">

            <div class="card panel-default">
                <div class="card-heading">
                    <h3 class="card-title">Editar domicilio</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {!! Form::label('calle', 'Calle') !!}
                                {!! Form::text('calle', ($cliente->domicilio)? $cliente->domicilio->calle : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                {!! Form::label('numero', 'Número') !!}
                                {!! Form::number('numero', ($cliente->domicilio)? $cliente->domicilio->numero : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                {!! Form::label('piso', 'Piso') !!}
                                {!! Form::number('piso', ($cliente->domicilio)? $cliente->domicilio->piso : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                {!! Form::label('departamento', 'Departamento') !!}
                                {!! Form::text('departamento', ($cliente->domicilio)? $cliente->domicilio->departamento : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                {!! Form::label('codigo_postal', 'Código Postal') !!}
                                {!! Form::number('codigo_postal', ($cliente->domicilio)? $cliente->domicilio->codigo_postal : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('entre_calles', 'Entre Calles') !!}
                        {!! Form::text('entre_calles', ($cliente->domicilio)? $cliente->domicilio->entre_calles : null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('barrio', 'Barrio') !!}
                        {!! Form::text('barrio', ($cliente->domicilio)? $cliente->domicilio->barrio : null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('provincia', 'Provincia') !!}
                        {!! Form::select('provincia', $provincias, ($cliente->domicilio && $cliente->domicilio->provincia)? $cliente->domicilio->provincia->id : null, ['class' => 'form-control select2', 'id' => 'provincia', 'placeholder' => '']) !!}
                    </div>


                    <div class="form-group" id="partidoDiv">
                        @if(isset($partidos))
                            {!! Form::label('partido', 'Partido', ['id' => 'partidoLabel']) !!}
                            {!! Form::select('partido', $partidos, ($cliente->domicilio && $cliente->domicilio->partido)? $cliente->domicilio->partido->id : null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                        @endif
                    </div>

                    <div class="form-group" id="localidadDiv">
                        @if(isset($localidades))
                            {!! Form::label('localidad', 'Localidad', ['id' => 'localidadLabel']) !!}
                            {!! Form::select('localidad', $localidades, ($cliente->domicilio && $cliente->domicilio->localidad)? $cliente->domicilio->localidad->id : null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                        @endif
                    </div>

                </div>

            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-default">Cancelar</a>


        </div>


        {!! Form::close() !!}
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

