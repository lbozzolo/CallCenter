{!! Form::model($venta->cliente, ['method' => 'put', 'url' => route('clientes.update', $venta->cliente->id), 'class' =>'form']) !!}

<div class="col-lg-6 col-md-6">

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

</div>
<div class="col-lg-6 col-md-6">

    <div class="row">
        <div class="form-group col-xs-6">
            {!! Form::label('puntos', 'Puntos') !!}
            {!! Form::number('puntos', null, ['class' => 'form-control', 'min' => '0', 'max' => '10000']) !!}
        </div>
        <div class="form-group col-xs-6">
            {!! Form::label('estado', 'Estado') !!}
            {!! Form::select('estado_id', $estados, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="card card-default">
        <div class="card-heading">
            <span class="card-title">Domicilio</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        {!! Form::label('calle', 'Calle') !!}
                        {!! Form::text('calle', ($venta->cliente->domicilio)? $venta->cliente->domicilio->calle : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        {!! Form::label('numero', 'Número') !!}
                        {!! Form::number('numero', ($venta->cliente->domicilio)? $venta->cliente->domicilio->numero : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        {!! Form::label('piso', 'Piso') !!}
                        {!! Form::number('piso', ($venta->cliente->domicilio)? $venta->cliente->domicilio->piso : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        {!! Form::label('departamento', 'Departamento') !!}
                        {!! Form::text('departamento', ($venta->cliente->domicilio)? $venta->cliente->domicilio->departamento : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        {!! Form::label('codigo_postal', 'Código Postal') !!}
                        {!! Form::number('codigo_postal', ($venta->cliente->domicilio)? $venta->cliente->domicilio->codigo_postal : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('entre_calles', 'Entre Calles') !!}
                {!! Form::text('entre_calles', ($venta->cliente->domicilio)? $venta->cliente->domicilio->entre_calles : null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('provincia', 'Provincia') !!}
                {!! Form::select('provincia', $provincias, ($venta->cliente->domicilio)? $venta->cliente->domicilio->provincia->id : null, ['class' => 'form-control select2', 'id' => 'provincia', 'placeholder' => '']) !!}
            </div>


            <div class="form-group" id="partidoDiv">
                @if(isset($partidos))
                    {!! Form::label('partido', 'Partido', ['id' => 'partidoLabel']) !!}
                    {!! Form::select('partido', $partidos, ($venta->cliente->domicilio && $venta->cliente->domicilio->partido) ? $venta->cliente->domicilio->partido->id : null, ['class' => 'form-control', 'placeholder' => '']) !!}
                @endif
            </div>

            <div class="form-group" id="localidadDiv">
                @if(isset($localidades))
                    {!! Form::label('localidad', 'Localidad', ['id' => 'localidadLabel']) !!}
                    {!! Form::select('localidad', $localidades, ($venta->cliente->domicilio && $venta->cliente->domicilio->localidad)? $venta->cliente->domicilio->localidad->id : null, ['class' => 'form-control', 'placeholder' => '']) !!}
                @endif
            </div>

        </div>
    </div>

</div>


{!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}

    <a href="{{ route('ventas.card', $venta->id) }}" class="btn btn-default">Cancelar</a>

{!! Form::close() !!}