@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            Roles
                            <span class="text-muted"> / Asignar permisos a {!! strtoupper($role->name)!!}</span>
                        </h2>

                        @include('roles.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel panel-default">
                            {!! Form::model($role, ['method' => 'put', 'url' => route('roles.assign.permissions', $role->id), 'class' => 'form']) !!}
                            <div class="panel-heading">
                                {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary pull-right']) !!}
                                <h3 class="panel-title">Asignar permisos</h3>
                            </div>
                            <div class="panel-body">

                                @include('permissions.partials.assign-permissions')

                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
