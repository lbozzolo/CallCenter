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
    {!! Form::label('direccion', 'Dirección') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
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
    <div class="form-group col-xs-6">
        {!! Form::label('puntos', 'Puntos') !!}
        {!! Form::number('puntos', null, ['class' => 'form-control', 'min' => '0', 'max' => '10000']) !!}
    </div>
    <div class="form-group col-xs-6">
        {!! Form::label('estado', 'Estado') !!}
        {!! Form::select('estado_id', $estados, null, ['class' => 'form-control']) !!}
    </div>
</div>



{!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}
<a href="{{ route('clientes.index') }}" class="btn btn-default">Cerrar</a>

{!! Form::close() !!}