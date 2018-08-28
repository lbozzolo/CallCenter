
{!! Form::open(['method' => 'post', 'url' => route('categorias.store'), 'class' => 'form']) !!}
<div id="main-content">
	<div class="row">
		<div class="col-md-12">
			<div class="card alert">
				<div class="card-header pr">
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
						{!! Form::select('parent_id', $parents,  null, ['class' => 'form-control  select2', 'placeholder' => '']) !!}
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Agregar subcategoría</button>
		</div>
	</div>
</div>
{!! Form::close() !!}