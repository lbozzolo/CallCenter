{!! Form::open(['url' => route('updateables.entidad'), 'method' => 'get']) !!}
    <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-9">
        {!! Form::select('entidad', $entidades, null, ['class' => 'form-control select2b', 'placeholder' => '']) !!}
    </div>
    <div class="form-group col-lg-9 col-md-9 col-sm-8 col-xs-3">
        <button type="submit" class="btn btn-primary" style="margin-top: 4px">Aceptar</button>
    </div>
{!! Form::close() !!}