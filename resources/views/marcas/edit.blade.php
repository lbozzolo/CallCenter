@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>MARCAS</h2>

                @include('productos.partials.navbar')

                <div class="col-lg-5">

                    @include('marcas.partials.marcas-listado')

                </div>
                <div class="col-lg-5 col-lg-offset-1">

                    <h3>Editar marca: {!! $marca->nombre !!}</h3>

                    {!! Form::model($marca, ['method' => 'put', 'url' => route('marcas.update', $marca->id), 'class' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción') !!}
                        {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('+ Guardar cambios', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>

@endsection
