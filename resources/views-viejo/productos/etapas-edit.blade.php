@extends('base')

@section('css')
    <style type="text/css">

        .list-group-item {
            display: list-item;
        }

    </style>
@endsection

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>
                    Configurar etapas
                    <small class="text-muted"> / producto: {!! $producto->nombre !!}</small>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-primary">editar</a>
                </h2>
                <p>Si este producto se vende en etapas, describirlas abajo.</p>
                <hr>
                <div class="col-lg-6 col-md-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Etapas registradas</h3>
                        </div>
                        <div class="panel-body">
                            @if($producto->etapas->count() > 0)

                                <ol class="list-group" style="padding: 0px 15px">
                                    @foreach($producto->etapas as $etapa)
                                        <li class="list-group-item">
                                            <button type="button" title="Eliminar" class="pull-right nonStyledButton" data-toggle="modal" data-target="#eliminarEtapa{!! $etapa->id !!}" style="border: none">
                                                <i class="glyphicon glyphicon-trash small text-danger"></i>
                                            </button>
                                            <a href="{{ route('etapas.edit', ['etapaId' => $etapa->id, 'productoId' => $producto->id]) }}" class="pull-right nonStyledButton"><i class="glyphicon glyphicon-edit small text-info"></i></a>

                                            {!! $etapa->nombre !!}
                                            @if($etapa->dias_pendiente > 0)
                                                ({!! $etapa->dias_pendiente !!} días después)
                                            @endif

                                            <div class="modal fade" id="eliminarEtapa{!! $etapa->id !!}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar etapa</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-danger">Usted está a punto de eliminar la etapa '{!! $etapa->nombre !!}'</p>
                                                            <p>¿Desea continuar?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                            {!! Form::open(['route'  => ['etapas.destroy', $etapa->id], 'method' => 'delete']) !!}
                                                            <button type="submit" class="btn btn-danger pull-right">Eliminar de todos modos</button>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                    @endforeach
                                </ol>

                            @else

                                <p>Todavía no hay ninguna etapa</p>

                            @endif
                        </div>
                    </div>


                </div>

                <div class="col-lg-6 col-md-6">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Editar etapa</h3>
                        </div>
                        <div class="panel-body">

                            {!! Form::model($etapaEdit,['method' => 'put', 'url' => route('etapas.update', $etapaEdit->id), 'class' => 'form']) !!}
                            <div class="form-group">
                                {!! Form::label('nombre', 'Nombre') !!}
                                {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                            </div>

                            @if($producto->etapas->count() > 0)

                                <div class="form-group">
                                    {!! Form::label('dias_pendiente', 'Días de espera') !!}
                                    {!! Form::number('dias_pendiente', null, ['class' => 'form-control', 'min' => 1]) !!}
                                    <span class="text-muted">Ingrese la cantidad de días de espera desde la finalización de la etapa anterior hasta la activación de ésta.</span>
                                </div>

                            @endif


                            {!! Form::submit('Guardar cambios', ['class' => 'btn btn-info']) !!}
                            <a href="{{ route('productos.etapas', $producto->id) }}" class="btn btn-default">Cancelar</a>

                            {!! Form::close() !!}

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        $('.datepicker').datepicker({
            format: 'd/mm/yyyy'
        });

        $('.select2').select2({multiple: true});

    </script>

@endsection
