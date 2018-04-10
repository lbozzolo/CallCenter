<div class="row">

    {!! Form::model($user, ['method' => 'put', 'url' => route('users.assign.permissions', $user->id), 'class' => 'form']) !!}


    <ul class="list-unstyled col-lg-6 col-md-6 col-sm-6 col-xs-12" id="accordion">
        <li class="list-group-item" style="background-color: beige">
            <span style="cursor: pointer"  data-toggle="collapse" data-target="#collapseBanco" aria-expanded="false" aria-controls="collapseBanco">
                <h4>Bancos</h4>
            </span>

            <ul class="list-unstyled collapse in" id="collapseBanco" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'banco')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseCategoria" aria-expanded="false" aria-controls="collapseCategoria">
                <h4>Categorías</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseCategoria" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'categoria')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseCliente" aria-expanded="false" aria-controls="collapseCliente">
                <h4>Clientes</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseCliente" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'cliente')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer"  data-toggle="collapse" data-target="#collapseEtapa" aria-expanded="false" aria-controls="collapseEtapa">
                <h4>Etapas</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseEtapa" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'etapa')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseFormasPago" aria-expanded="false" aria-controls="collapseFormasPago">
                <h4>Formas de Pago</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseFormasPago" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'formaPago')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseImagen" aria-expanded="false" aria-controls="collapseImagen">
                <h4>Imágenes</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseImagen" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'imagen')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseInstitucion" aria-expanded="false" aria-controls="collapseInstitucion">
                <h4>Instituciones</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseInstitucion" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'institucion')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    </ul>

    <ul class="list-unstyled col-lg-6 col-md-6 col-sm-6 col-xs-12" id="accordion2">
        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseLlamada" aria-expanded="false" aria-controls="collapseLlamada">
                <h4>Llamadas</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseLlamada" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'llamada')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseMetodoPago" aria-expanded="false" aria-controls="collapseMetodoPago">
                <h4>Métodos de pago</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseMetodoPago" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'metodoPago')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseProducto" aria-expanded="false" aria-controls="collapseProducto">
                <h4>Productos</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseProducto" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'producto')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapsePromocion" aria-expanded="false" aria-controls="collapsePromocion">
                <h4>Promociones</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapsePromocion" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'promocion')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseReclamos" aria-expanded="false" aria-controls="collapseReclamos">
                <h4>Reclamos</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseReclamos" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'reclamo')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseUsuario" aria-expanded="false" aria-controls="collapseUsuario">
                <h4>Usuarios</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseUsuario" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'user')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item " style="background-color: beige">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseVentas" aria-expanded="false" aria-controls="collapseVentas">
                <h4>Ventas</h4>
            </span>
            <ul class="list-unstyled collapse in"  id="collapseVentas" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'venta')
                        <li class="list-group-item">
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                <strong>{!! $permiso->name !!}</strong>
                                <small>({!! $permiso->description !!})</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    </ul>

    {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

</div>