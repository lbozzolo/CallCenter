<div class="card">
    <div class="card-header">
        <a href="{!! route('asignaciones.mis.tareas') !!}" class="btn btn-sm btn-default">Cancelar asignación</a>
    </div>
    <div class="card-body">

        <div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
            Aguarde un momento por favor...<br>
            <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
        </div>

        <div class="row">



            <div class="col-lg-7 col-sm-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Seleccione un supervisor o un operador</h3>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive" id="div-table-enable-users" style="display: none">

                            <table class="table table-vertical dataTable" id="table-enable-users" style="background-color: #404a6b">

                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th class="text-center">Rol</th>
                                    <th class="text-center">Datos asignados</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($operadores as $user)

                                    <tr>
                                        <td>
                                            @if($user->profile_image)
                                                <img src="{{ route('imagenes.ver', $user->profile_image) }}" class="img-circle " style="object-fit: cover; width: 30px; height: 30px">
                                            @else
                                                <img src="{{ route('imagenes.ver', 'x') }}" class="img-circle " style="object-fit: cover; width: 30px; height: 30px">
                                            @endif
                                        </td>
                                        <td>{!! $user->full_name !!}</td>
                                        <td class="text-center">
                                            @if($user->is('operador.in'))
                                                <span class="label label-default">OP-IN</span>
                                            @elseif($user->is('operador.out'))
                                                <span class="label label-warning">OP-OUT</span>
                                            @elseif($user->is('supervisor'))
                                                <span class="label label-success">SUPERVISOR</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{!! $user->total_asignaciones_actuales !!}</td>
                                        <td class="text-center">

                                            <button type="button" title="ASIGNAR" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#asignar{!! $user->id !!}" >asignar</button>
                                            <div class="modal fade col-lg-4 col-lg-offset-4" id="asignar{!! $user->id !!}">

                                                <div class="card alert text-left">
                                                    <div class="card-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="card-title">¿Desea asignar los siguientes datos?</h4>
                                                    </div>
                                                    <div class="card-body">

                                                        <h5>{!! ($user->is('supervisor'))? 'Supervisor' : 'Operador' !!}</h5>
                                                        <ul class="list-unstyled listado">
                                                            <li class="list-group-item">{!! $user->full_name !!}</li>
                                                        </ul>
                                                        <h5>Datos</h5>
                                                        <ul class="list-unstyled listado">
                                                            @foreach($datos as $cliente)
                                                                <li class="list-group-item">{!! $cliente->full_name !!}</li>
                                                            @endforeach
                                                        </ul>

                                                    </div>
                                                    <div class="card-footer" style="margin-top: 20px">

                                                        {!! Form::open(['url' => route('asignaciones.store'), 'method' => 'post']) !!}
                                                        @foreach($datosModificar as $value)
                                                            {!! Form::hidden('datos[]', $value) !!}
                                                        @endforeach
                                                        {!! Form::hidden('operador_id', $user->id) !!}

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">Asignar</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>

                                            </div>


                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>


            </div>

            <div class="col-lg-5 col-sm-12">

                <div class="card" id="listado-datos" style="display: none">
                    <div class="card-header">


                        {!! Form::open(['url' => route('asignaciones.mis.tareas'), 'method' => 'get']) !!}
                        @foreach($datosModificar as $value)
                            {!! Form::hidden('datosModificar[]', $value) !!}
                        @endforeach

                        <button type="submit" class="btn btn-sm btn-warning pull-right">modificar</button>

                        {!! Form::close() !!}

                        <h3>Datos a asignar</h3>

                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled listado">
                            @foreach($datos as $cliente)
                                <li class="list-group-item">{!! $cliente->full_name !!}</li>
                            @endforeach
                        </ul>
                        <ul class="list-unstyled listado" style="margin-top: 5px">
                            <li class="list-group-item text-warning" >Total de datos ({!! count($datos) !!})</li>
                        </ul>
                    </div>
                </div>

            </div>



        </div>

    </div>
</div>



