
{!! Form::open(['method' => 'post', 'url' => route('noticias.store'), 'class' => 'form']) !!}

<div class="form-group">
    {!! Form::label('nombre', 'Título') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('descripcion', 'Descripcion') !!}
	{!! Form::textarea('descripcion', null, ['id'=>'ckeditor', 'class'=>'form-control', 'rows'=>'30', 'cols'=>'80']) !!}

</div>

<div class="form-group">
    
</div>

<div class="form-group">
    
</div>

<div class="form-group">
    
</div>

<div class="form-group panel-body" id="divEstado">
    
</div>

<button type="submit" class="btn btn-primary">Agregar Noticia</button>




{!! Form::close() !!}