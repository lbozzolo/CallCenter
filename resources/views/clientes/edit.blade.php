@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>Editar perfil de {!! $cliente->full_name !!}</h2>
                <hr>
                <div class="col-lg-6 col-md-6">
                    {!! Form::model($cliente, ['method' => 'put', 'url' => route('clientes.update', $cliente->id), 'class' =>'form']) !!}

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('apellido', 'Apellido') !!}
                        {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('direccion', 'Dirección') !!}
                        {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('telefono', 'Teléfono') !!}
                        {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('celular', 'Celular') !!}
                        {!! Form::text('celular', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('dni', 'DNI') !!}
                        {!! Form::text('dni', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('referencia', 'Referencia') !!}
                        {!! Form::textarea('referencia', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('observaciones', 'Observaciones') !!}
                        {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('puntos', 'Puntos') !!}
                        {!! Form::number('puntos', null, ['class' => 'form-control', 'min' => '0', 'max' => '10000']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('estado', 'Estado') !!}
                        {!! Form::select('estado_id', $estados, null, ['class' => 'form-control']) !!}
                    </div>


                    {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('clientes.index') }}" class="btn btn-default">Cerrar</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>


        $('.select2').select2({
            multiple: true,
        });

    </script>

@endsection
