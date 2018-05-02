@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Roles</h2>

                        @include('roles.partials.navbar')

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Roles actuales</h3>
                            </div>
                            <div class="panel-body">
                                @include('roles.partials.roles-list')
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Agregar nuevo rol</h3>
                            </div>
                            <div class="panel-body">

                                {!! Form::open(['method' => 'post', 'url' => route('roles.create'), 'class' => 'form']) !!}

                                <div class="form-group">
                                    {!! Form::label('name', 'Nombre') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description', 'Descripción') !!}
                                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('slug', 'Slug') !!}
                                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('level', 'Nivel (de 1 a 10)') !!}
                                    {!! Form::number('level',null, ['class' => 'form-control', 'min' => '1', 'max' => '10']) !!}
                                </div>
                                {!! Form::submit('+ Agregar rol', ['class' => 'btn btn-primary']) !!}

                                {!! Form::close() !!}

                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
