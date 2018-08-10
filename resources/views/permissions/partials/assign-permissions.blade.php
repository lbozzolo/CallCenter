<div class="row">



<div class="col-lg-4 col-md-4 col-sm-6">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Bancos</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
            @foreach($permisos as $permiso)
                @if($permiso->model == 'banco')
                        <li>
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Categorías</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'categoria')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Clientes</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'cliente')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Etapas</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'etapa')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Formas de Pago</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'formaPago')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>




</div>


<div class="col-lg-4 col-md-4 col-sm-6">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Imágenes</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'imagen')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Instituciones</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'institucion')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Llamadas</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'llamada')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Métodos de Pago</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'metodoPago')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Productos</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'producto')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

</div>

<div class="col-lg-4 col-md-4 col-sm-6">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Promociones</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'promocion')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Reclamos</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'reclamo')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Usuarios</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'user')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Ventas</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'venta')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Marcas</h4>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'marca')
                        <li >
                            <div class="form-check">
                                @if(isset($user))
                                    {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                @else
                                    {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                @endif
                                {!! $permiso->name !!}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

</div>


</div>