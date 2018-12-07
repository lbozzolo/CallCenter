@extends('users.base')

@section('titulo')

    <h2>Usuarios<span class="text-muted"> / Asignar Permisos</span></h2>

@endsection

@section('contenido')

@permission('editar.permisos.usuario')

        <div class="">
            {!! Form::model($user, ['method' => 'put', 'url' => route('users.assign.permissions', $user->id), 'class' => 'form']) !!}
            <div class="card-heading">
                <button type="submit" class="btn btn-warning ">Guardar cambios</button>
            </div>
            
           

                @include('permissions.partials.assign-permissions')

          
            {!! Form::close() !!}
        </div>
   
@endpermission

@endsection
