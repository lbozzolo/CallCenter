
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card alert">
                <div class="card-header pr">
                    <h4>Editar Noticia</h4>
                </div>

                {!! Form::model($noticia, ['method' => 'put', 'url' => route('noticias.update'), 'class' => 'form']) !!}

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('nombre', 'Titulo') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción') !!}
                        {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                

                <div class="form-group panel-body" id="divEstado">
                    {!! Form::label('estado_id', 'Activa') !!}
                    {!! Form::radio('estado_id', $estados[0], true) !!}
                    {!! Form::label('estado_id', 'Inactiva') !!}
                    {!! Form::radio('estado_id', $estados[1], false) !!}
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="#" class="btn btn-default">Cancelar</a>

                {!! Form::close() !!}
                <br>
            </div>
        </div>
    </div>
</div>
