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
                <span class="text-muted"> / Cambiar contraseña</span>
            </h2>
            <div class="card">
                <span class="pull-right"> @include('users.partials.labels-roles-inline')</span>
                <span class="text-info">{!! $user->email !!}</span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div >
                        {!! Form::open(['method' => 'put', 'url' => route('users.storeNewPassword'), 'class' => 'form']) !!}

                        {!! Form::hidden('user_id', $user->id) !!}

                        <div class="form-group">
                            {!! Form::label('current_password', 'Contraseña actual') !!}
                            {!! Form::password('current_password', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Nueva contraseña') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Repetir nueva contraseña') !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>

                        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                        <a href="{{ route('users.profile', $user->id) }}" class="btn btn-default">Cancelar</a>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
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


