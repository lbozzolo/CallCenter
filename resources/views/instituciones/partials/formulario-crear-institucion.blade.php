
{!! Form::open(['method' => 'post', 'url' => route('instituciones.store'), 'class' => 'form']) !!}

<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
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
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('url', 'URL') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('responsable', 'Responsable') !!}
    {!! Form::text('responsable', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group panel-body" id="divEstado">
    {!! Form::label('estado_id', 'Activa') !!}
    {!! Form::radio('estado_id', $estados[0], true) !!}
    {!! Form::label('estado_id', 'Inactiva') !!}
    {!! Form::radio('estado_id', $estados[1], false) !!}
</div>

<button type="submit" class="btn btn-primary">Agregar Institución</button>

{!! Form::close() !!}