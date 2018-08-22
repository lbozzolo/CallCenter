<div class="formularioFoto" style="display: none; margin: 5px">


    {!! Form::open(['url' => route('imagenes.store'), 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">

    </div>
    <div class="input-group input-group-sm">
        {!! Form::file('img', ['class' => 'form-control inputImage']) !!}
        <span class="input-group-btn">
                                                {!! Form::submit('Subir', ['class' => 'btn btn-info btn-flag']) !!}
                                            </span>
    </div>

    {!! Form::close() !!}

</div>
