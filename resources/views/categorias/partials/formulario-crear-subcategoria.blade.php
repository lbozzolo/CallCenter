<h3>Agregar nueva subcategoria</h3>
{!! Form::open(['method' => 'post', 'url' => route('categorias.store'), 'class' => 'form']) !!}

{!! Form::hidden('subcategoria', true) !!}

<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('parent_id', 'Categoría padre') !!}
    {!! Form::select('parent_id', $parents,  null, ['class' => 'form-control', 'placeholder' => '']) !!}
</div>

{!! Form::submit('+ Agregar subcategoría', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}