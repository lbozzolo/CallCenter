
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card alert">
                <div class="card-header pr">
                    <h4>Editar Noticia</h4>
                </div>

                {!! Form::model($noticia, ['method' => 'put', 'url' => route('noticias.update', $noticia->id), 'class' => 'form']) !!}

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('titulo', 'Titulo') !!}
                        {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción') !!}
                        {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{!! route('noticias.index') !!}" class="btn btn-default">Cancelar</a>

                {!! Form::close() !!}
                <br>
            </div>
        </div>
    </div>
</div>
