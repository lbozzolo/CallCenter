@extends('base')



@section('content')


    <div class="row">
        <div class="col-lg-12">
            <h2>
                @if($user->profile_image)
                    <img src="{{ route('imagenes.ver', $user->profile_image) }}" class="img-circle " style="object-fit: cover; width: 30px; height: 30px">
                @else
                    <img src="{{ route('imagenes.ver', 'x') }}" class="img-circle " style="object-fit: cover; width: 30px; height: 30px">
                @endif
                {!! $user->full_name !!}
                <span class="text-muted"> / Perfil de usuario</span>
            </h2>
            <div class="card">
                <span class="pull-right"> @include('users.partials.labels-roles-inline')</span>
                <span class="text-info">{!! $user->email !!}</span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">

            <div class="card">
                <ul class="list-unstyled listado">
                    <li class="list-group-item">Fecha de alta: {!! $user->fecha_creado !!}</li>
                    <li class="list-group-item"><i class="fa fa-phone"></i>Teléfono:  {!! ($user->telefono)? $user->telefono : "<small class='text-muted'>sin datos</small>" !!}</li>
                    <li class="list-group-item">DNI: {!! ($user->dni)? $user->dni : "<small class='text-muted'>sin datos</small>" !!}</li>
                    @permission('cambiar.password.perfil')
                    @if(Auth::user()->id == $user->id || Auth::user()->is('superadmin'))
                        <li class="list-group-item">
                            <a href="{{ route('users.changePassword', $user->id) }}" style="color: cyan">Cambiar contraseña</a>
                        </li>
                    @endif
                    @endpermission
                </ul>
                @permission('editar.perfil')
                @if(Auth::user()->id == $user->id || Auth::user()->is('superadmin|admin'))
                    <div style="padding: 10px 0px"><a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar</a></div>
                @endif
                @endpermission
            </div>

            @if(Auth::user()->id == $user->id || Auth::user()->is('superadmin|admin'))

                @permission('subir.imagen.perfil')
                <div class="card card-default">
                    <div class="card-heading">
                        <h3 class="card-title">Agregar foto de perfil</h3>
                    </div>
                    <div class="card-body">

                        <div class="formularioFoto">
                            {!! Form::open(['url' => route('imagenes.store', ['id' => $user->id, 'model' => 'user']), 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    {!! Form::file('img', ['class' => 'form-control', 'id' => 'inputImagen']) !!}
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flag">Subir</button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="titleDescription" style="display:none">
                                <label for="title"><small class="text-muted">Agregue una descripción de la foto</small></label>
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>

                            {!! Form::close() !!}

                        </div>

                        @if(count($user->images) > 0)

                            <ul class="list-inline">
                                @foreach($user->images as $imagen)
                                    @if($imagen->image_exists)
                                        <li>
                                            <span style="display: inline-block">
                                                <a href="" data-toggle="modal" data-target="#modalVerImage{!! $imagen->id !!}">
                                                    <img src="{{ route('imagenes.ver', $imagen->path) }}" class="img-responsive" style="{!! ($imagen->principal == 0)? 'opacity: 0.5;' : '' !!} height: 80px">
                                                </a>
                                            </span>
                                            <div class="modal fade col-lg-6 col-lg-offset-3" id="modalVerImage{!! $imagen->id !!}">
                                                <div class="card">
                                                    <div class="modal-body">
                                                        <img src="{{ route('imagenes.ver', $imagen->path) }}" class="img-responsive" style="margin: 0px auto">
                                                    </div>
                                                    <div class="modal-footer">

                                                        @if($imagen->principal == 0)
                                                            <a href="{{ route('imagenes.principal', $imagen->id) }}" class="btn btn-primary" title="Marcar como principal">Marcar como principal</a>
                                                        @else
                                                            <a href="#" class="btn btn-primary" disabled title="Marcar como principal">Marcar como principal</a>
                                                        @endif
                                                        <button class="btn btn-danger" title="Eliminar foto" data-toggle="modal" data-target="#modalDeleteImage{!! $imagen->id !!}">Eliminar</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <div class="modal fade text-left col-lg-3 col-md-3 col-sm-4 col-lg-offset-9 col-md-offset-9 col-sm-offset-8" id="modalDeleteImage{!! $imagen->id !!}">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Eliminar imagen</h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="text-red">¿Está seguro que desea eliminar la imagen?</p>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                                    {!! Form::open(['method' => 'DELETE', 'url' => route('imagenes.delete', $imagen->id)]) !!}
                                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
                @endpermission

            @endif

        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Mis ventas</h3>
                </div>
                <div class="card-body">

                    <div class="overlay text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
                        Aguarde un momento por favor...<br>
                        <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
                    </div>
                    <div class="table-responsive" id="div-table-mis-ventas" style="display: none">

                        <table class="table table-condensed dataTable" id="table-mis-ventas">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Estado</th>
                                <th>Cliente</th>
                                <th>Productos</th>
                                <th>Etapa</th>
                                <th>Reclamos</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($user->ventas as $venta)

                                <tr>
                                    <td>{!! $venta->id !!}</td>
                                    <td>
                                        <label class="label label-default estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! $venta->estado->nombre !!}</label>
                                    </td>
                                    <td>{!! ($venta->cliente)? $venta->cliente->full_name : '' !!}</td>
                                    <td>
                                        @permission('ver.producto')
                                        @if($venta->productos)
                                            <ul>
                                                @foreach($venta->productos as $producto)
                                                    <li><a href="{{ route('productos.show', $producto->id) }}">{!! $producto->nombre !!}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        @endpermission
                                    </td>
                                    <td class="text-center">{!! ($venta->etapa)? $venta->etapa->nombre : '-' !!}</td>
                                    <td class="text-center">
                                        @permission('ver.reclamos.venta')
                                        <a href="{!! route('ventas.reclamos', $venta->id) !!}" style="color:cyan">{!! ($venta->reclamos)? $venta->reclamos_abiertos : '0' !!}</a>
                                        @endpermission
                                    </td>
                                    <td>{!! $venta->fecha_creado !!}</td>
                                    <td class="text-right">
                                        <span class="text-primary" style="font-size: 1.1em">${!! $venta->importe_total !!}</span>
                                    </td>
                                    <td class="text-center">
                                        @permission('ver.venta')
                                        <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-default btn-xs">detalles</a>
                                        @endpermission

                                        @permission('ver.updateable')
                                        <a href="{{ route('updateables.entidad.show', ['entity' => $venta->getClass(), 'id' => $venta->id]) }}" class="btn btn-updateable btn-xs" title="movimientos"><i class="fa fa-info-circle"></i> </a>
                                        @endpermission

                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>
    <script>

        $('#inputImagen').change(function() {
            $('#titleDescription').fadeIn();
        });

        $(document).ready(function() {
            $('#table-mis-ventas').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando _PAGE_ de _PAGES_",
                    "emptyTable": "Sin datos disponibles",
                    "infoEmpty": "Sin registros",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "<i class='fa fa-search'></i> buscar",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
            $("#div-table-mis-ventas").show();
            $(".overlay").hide();

        });

    </script>

@endsection


