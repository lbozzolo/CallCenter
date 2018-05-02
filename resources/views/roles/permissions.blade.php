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

                        @include('permissions.partials.assign-permissions')

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
