@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="col-lg-9">
                    <h3>
                        Asignar permisos a {!! strtoupper($role->name)!!}
                    </h3>
                </div>
                <div class="form-group col-lg-3">
                    <a href="{{ route('roles.index') }}" class="btn btn-default"> << volver</a>
                </div>
                <hr>
                <div class="col-lg-12">

                    @include('permissions.partials.assign-permissions')

                </div>

            </div>
        </div>
    </div>

@endsection
