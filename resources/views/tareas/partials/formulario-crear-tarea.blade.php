
{!! Form::open(['method' => 'post', 'url' => route('noticias.store'), 'class' => 'form']) !!}

    <div class="form-group">
        {!! Form::label('titulo', 'Título') !!}
        {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('descripcion', 'Descripción') !!}
        {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-info">Agregar</button>
    </div>


{!! Form::close() !!}
