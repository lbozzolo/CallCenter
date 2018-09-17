
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card alert">
                <div class="card-header pr">
                    <h4>Editar institución</h4>
                </div>

                {!! Form::model($institucion, ['method' => 'put', 'url' => route('instituciones.update'), 'class' => 'form']) !!}

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripcion') !!}
                        {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('direccion', 'Dirección') !!}
                        {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('telefono', 'Teléfono') !!}
                        {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('url', 'URL') !!}
                        {!! Form::text('url', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('responsable', 'Responsable') !!}
                        {!! Form::text('responsable', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group panel-body" id="divEstado">
                    {!! Form::label('estado_id', 'Activa') !!}
                    {!! Form::radio('estado_id', $estados[0], true) !!}
                    {!! Form::label('estado_id', 'Inactiva') !!}
                    {!! Form::radio('estado_id', $estados[1], false) !!}
                </div>

                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('instituciones.index') }}" class="btn btn-default">Cancelar</a>

                {!! Form::close() !!}
                <br>
            </div>
        </div>
    </div>
</div>
