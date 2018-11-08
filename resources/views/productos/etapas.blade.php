@extends('productos.base')

@section('css')
    <style type="text/css">

        .list-group-item {
            display: list-item;
        }

    </style>
@endsection

@section('titulo')

    <h2>
        Configurar etapas
        <small class="text-muted"> / producto: {!! $producto->nombre !!}</small>
        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-primary">editar</a>
    </h2>

@endsection

@section('contenido')

    <div class="row">


                <div class="col-lg-12">
                    <div class="card">
                        <span class="text-warning">Si este producto se vende en etapas, describirlas abajo.</span>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Etapas registradas</h3>
                        </div>
                        <div class="card-body">
                            @if($producto->etapas->count() > 0)

                                <ol class="list-group listado" style="padding: 0px 15px">
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

                                            <div class="modal fade col-lg-3 col-lg-offset-4" id="eliminarEtapa{!! $etapa->id !!}">
                                                    <div class="card alert">
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
                                                            <button type="submit" class="btn btn-danger pull-right">Eliminar</button>
                                                            {!! Form::close() !!}
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

                    <div class="card card-default">
                        <div class="card-header">
                            @if($producto->etapas->count())

                                <h3 class="card-title">Ingresar más etapas</h3>

                            @else

                                <h3 class="card-title">Ingresar etapa</h3>

                            @endif

                        </div>
                        <div class="card-body">

                            {!! Form::open(['method' => 'post', 'url' => route('productos.etapas.store', $producto->id), 'class' => 'form']) !!}
                            <div class="form-group">
                                {!! Form::label('nombre', 'Nombre') !!}
                                <input type="text" class="form-control" name="nombre" placeholder="ej: Etapa {!! $producto->etapas->count() + 1 !!}">
                                {{--{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => "ej: Etapa 1"]) !!}--}}
                            </div>

                            @if($producto->etapas->count() > 0)

                                <div class="form-group">
                                    {!! Form::label('dias_pendiente', 'Días de espera') !!}
                                    {!! Form::number('dias_pendiente', null, ['class' => 'form-control', 'min' => 1]) !!}
                                    <span class="text-muted">Ingrese la cantidad de días de espera desde la finalización de la etapa anterior hasta la activación de ésta.</span>
                                </div>

                            @endif


                            <button type="submit" class="btn btn-primary">+ Agregar etapa</button>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-default">Cancelar</a>

                            {!! Form::close() !!}

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
