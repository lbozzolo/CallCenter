@extends('asignaciones.base')

@section('titulo')

    <h2>Mis tareas</h2>

@endsection

@section('contenido')

    @permission('ver.mis.asignaciones')
    <div class="card">
        <div class="card-header">
            <ul class="list-unstyled list-inline">
                <li>
                    <h3>Tareas actuales</h3>
                </li>
                <li>
                    <a href="{{ route('asignaciones.mis.tareas.anteriores') }}" style="color: cyan">ver anteriores</a>
                </li>
            </ul>

        </div>
        <div class="card-body">

            <div class="table-responsive" id="div-table-asignaciones-historicas">

                @if(Auth::user()->is('supervisor'))

                    {!! Form::open(['url' => route('asignaciones.seleccion.operador'), 'method' => 'post']) !!}
                    <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 5px">Aceptar datos seleccionados</button>

                @endif

                <table class="table table-vertical dataTable" id="table-asignaciones-historicas">

                    <thead>
                    <tr>
                        <th>Asignado por...</th>
                        <th>Dato asignado</th>
                        <th>Fecha</th>
                        <th class="text-right">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($asignaciones as $asignacion)

                        <tr>
                            <td>{!! $asignacion->supervisor->full_name !!}</td>
                            <td>{!! $asignacion->cliente->full_name !!}</td>
                            <td>{!! $asignacion->fecha_creado !!}</td>
                            <td>

                                @if(Auth::user()->is('supervisor'))

                                    @if(isset($datosModificar))
                                        {!! Form::checkbox('clientes[]', $asignacion->cliente->id,  (in_array($asignacion->cliente->id, $datosModificar))? true : false, ['style' => 'font-size: 2em']) !!}
                                    @else
                                    {!! Form::checkbox('clientes[]', $asignacion->cliente->id,  false, ['style' => 'font-size: 2em']) !!}
                                    @endif

                                @else

                            @permission('crear.venta')
                                <a href="{{ route('asignaciones.tomar', $asignacion->id) }}" class="btn btn-sm btn-primary">Tomar</a>
                                <button type="button" title="reasignar" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#reasignar{!! $asignacion->id !!}" style="border: none">
                                    Reasignar
                                </button>

                                <div class="modal fade col-lg-4 col-lg-offset-8 text-left" id="reasignar{!! $asignacion->id !!}">
                                    <div class="card">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <span class="modal-title h4"><i class="fa fa-warning text-warning"></i> Reasignar</span>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open(['url' => route('asignaciones.reasignar', $asignacion->id), 'method' => 'post']) !!}
                                                {!! Form::label('motivo_id', 'Ingrese un motivo') !!}
                                                {!! Form::select('motivo_id', $motivos, null, ['class' => 'form-control select2b']) !!}
                                                <div class="form-group" style="padding-top: 15px">
                                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                            @endpermission

                                @endif

                            </td>
                        </tr>

                    @empty

                        <tr>
                            <p><span class="text-warning">No tiene ninguna tarea asignada.</span></p>
                        </tr>

                    @endforelse

                    </tbody>
                </table>

                    @if(Auth::user()->is('supervisor'))

                        {!! Form::close() !!}

                    @endif

            </div>



        </div>
    </div>
    @endpermission

@endsection