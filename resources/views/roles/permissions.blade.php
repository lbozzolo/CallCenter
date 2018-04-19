@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>ROLES</h2>

                @include('roles.partials.navbar')

                <h3>Asignar permisos a {!! strtoupper($role->name)!!}</h3>

                <div class="col-lg-12">

                    @include('permissions.partials.assign-permissions')

                </div>

            </div>
        </div>
    </div>

@endsection
