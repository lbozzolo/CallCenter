@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>{!! $user->full_name !!}<span class="text-muted"> / Asignar permisos</span></h2>
                        @include('users.partials.navbar')
                    </div>
                </div>

                <div class="col-lg-12">

                    <div class="panel panel-default">
                        {!! Form::model($user, ['method' => 'put', 'url' => route('users.assign.permissions', $user->id), 'class' => 'form']) !!}
                        <div class="panel-heading">
                            {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary pull-right']) !!}
                            <h3 class="panel-title">Asignar permisos</h3>
                        </div>
                        <div class="panel-body">

                            @include('permissions.partials.assign-permissions')

                        </div>
                        {!! Form::close() !!}
                    </div>

                    {{--@include('permissions.partials.assign-permissions-to-user')--}}

                </div>

            </div>
        </div>
    </div>

@endsection
