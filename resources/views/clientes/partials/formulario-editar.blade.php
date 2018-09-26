{!! Form::model($cliente, ['method' => 'put', 'url' => route('clientes.update', $cliente->id), 'class' =>'form']) !!}

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
    {!! Form::textarea('referencia', null, ['class' => 'form-control', 'rows' => '3']) !!}
</div>
<div class="form-group">
    {!! Form::label('horario_contacto', 'Horario de Contacto') !!}
    {!! Form::textarea('horario_contacto', null, ['class' => 'form-control', 'rows' => '3']) !!}
</div>
<div class="form-group">
    {!! Form::label('observaciones', 'Observaciones') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '3']) !!}
</div>
<div class="row">
    <div class="form-group col-xs-6">
        {!! Form::label('from_date', 'Desde') !!}
        {!! Form::text('from_date', null, ['class' => 'form-control datepicker']) !!}
    </div>
    <div class="form-group col-xs-6">
        {!! Form::label('to_date', 'Hasta') !!}
        {!! Form::text('to_date', null, ['class' => 'form-control datepicker']) !!}
    </div>
</div>
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

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title">Domicilio</span>
    </div>
    <div class="panel-body">
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
            {!! Form::text('barrio', ($cliente->domicilio)? $cliente->domicilio->barrio : null, ['class' => 'form-control', 'placeholder' => 'ej: Barrio Los Álamos']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('provincia', 'Provincia') !!}
            {!! Form::select('provincia', $provincias, ($cliente->domicilio)? $cliente->domicilio->provincia->id : null, ['class' => 'form-control select2', 'id' => 'provincia', 'placeholder' => '']) !!}
        </div>


        <div class="form-group" id="partidoDiv">
            @if(isset($partidos))
            {!! Form::label('partido', 'Partido', ['id' => 'partidoLabel']) !!}
            {!! Form::select('partido', $partidos, $cliente->domicilio->partido->id, ['class' => 'form-control', 'placeholder' => '']) !!}
            @endif
        </div>

        <div class="form-group" id="localidadDiv">
            @if(isset($localidades))
            {!! Form::label('localidad', 'Localidad', ['id' => 'localidadLabel']) !!}
            {!! Form::select('localidad', $localidades, $cliente->domicilio->localidad->id, ['class' => 'form-control', 'placeholder' => '']) !!}
            @endif
        </div>

    </div>
</div>




{!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}
{{--
<a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-default">Cerrar</a>
--}}

{!! Form::close() !!}