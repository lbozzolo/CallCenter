<h3>Agregar nueva categoria</h3>
{!! Form::open(['method' => 'post', 'url' => route('categorias.store'), 'class' => 'form']) !!}

{!! Form::hidden('subcategoria', false) !!}

<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('+ Agregar categoría', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}