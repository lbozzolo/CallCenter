
{!! Form::open(['method' => 'post', 'url' => route('marcas.store'), 'class' => 'form']) !!}

    <div class="form-group">
        {!! Form::label('nombre', 'Nombre') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('descripcion', 'Descripción') !!}
        {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
    </div>

    <button type="submit" class="btn btn-info">Agregar marca</button>

{!! Form::close() !!}