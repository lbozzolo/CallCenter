<div class="card">
    <div class="card-header">
        <ul class="list-inline">
            <li><span>RECLAMO N° {!! $reclamo->id !!}</span></li>
            <li><label class="{!! ($reclamo->estado->slug == 'abierto')? 'label label-success' : 'label label-danger' !!}">{!! $reclamo->estado->nombre !!}</label></li>
            <li>
                @if($reclamo->solucionado == 0)
                    <i class="fa fa-exclamation-triangle text-warning"></i>
                    <em class="text-warning">Reclamo sin solución</em>
                @else
                    <i class="fa fa-check-circle text-success"></i>
                    <em class="text-success">Reclamo solucionado</em>
                @endif
            </li>
            <li class="pull-right"><span>{!! $reclamo->fecha_creado !!}</span></li>
        </ul>
        <div class="panel panel-barra">
            @permission('ver.producto')
            Productos:
            @foreach($reclamo->venta->productos as $producto)
                <a href="{{ route('productos.show', $producto->id) }}" title="Ver Producto">
                    <span class="label label-default"> {!! ucfirst($producto->nombre) !!} ({!! $producto->marca->nombre !!})</span>
                </a>
            @endforeach
            @endpermission
        </div>
    </div>
    <div class="card-body">
        @permission('cambiar.estado.reclamo')
        <div>
            <span class="pull-right">


            @if($reclamo->estado->slug == 'abierto')

                {!! Form::open(['method' => 'put', 'url' => route('reclamos.change.solucionado', $reclamo->id), 'class' => 'form', 'style' => 'display: inline-block']) !!}
                @if($reclamo->solucionado == config('sistema.reclamos.SOLUCIONADO.sinsolucion'))
                    <button type="submit" title="Marcar como solucionado" class="btn btn-success btn-sm btn-outline"><i class="fa fa-check-circle-o text-success"></i></button>
                @else
                    <button type="submit" title="Marcar como sin solución" class="btn btn-warning btn-sm btn-outline"><i class="fa fa-exclamation-triangle text-warning"></i></button>
                @endif
                {!! Form::close() !!}
                <span class="btn btn-danger btn-sm btn-outline" title="Cerrar reclamo" data-toggle="modal" data-target="#changeStatus{!! $reclamo->id !!}"><i class="fa fa-window-close-o text-danger"></i></span>
                <span title="Editar descripción" class="btn btn-primary btn-sm btn-outline editar-descripcion" data-id="{!! $reclamo->id !!}"><i class="fa fa-edit text-info"></i></span>
                <button type="button" class="btn btn-outline btn-sm btn-danger" data-toggle="modal" data-target="#eliminarReclamo{!! $reclamo->id !!}"><i class="fa fa-trash-o"></i> </button>

            @else

                <span class="btn btn-primary btn-sm btn-outline" title="Volver a abrir reclamo" data-toggle="modal" data-target="#changeStatus{!! $reclamo->id !!}"><i class="fa fa-folder-open text-primary"></i></span>

            @endif


            </span>

            <div class="modal fade col-lg-4 col-lg-offset-8" id="changeStatus{!! $reclamo->id !!}">
                <div class="card">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-warning "></i>
                            @if($reclamo->estado->slug == 'abierto')
                                Cerrar el RECLAMO N° {!! $reclamo->id !!}
                            @else
                                Abrir el RECLAMO N° {!! $reclamo->id !!}
                            @endif
                        </h4>
                    </div>
                    <div class="modal-body">
                        @if($reclamo->estado->slug == 'abierto')
                            <p>¿Desea cerrar el reclamo?</p>
                        @else
                            <p>
                                El reclamo que usted seleccionó se encuentra cerrado.<br>
                                ¿Desea abrir el reclamo nuevamente?
                            </p>
                        @endif
                    </div>
                    <div class="modal-footer">

                        {!! Form::open(['method' => 'put', 'url' => route('reclamos.change.status', $reclamo->id), 'class' => 'form']) !!}
                        @if($reclamo->estado->slug == 'abierto')
                            <button type="submit" class="btn btn-danger">Cerrar reclamo</button>
                        @else
                            <button type="submit" class="btn btn-primary">Abrir reclamo</button>
                        @endif
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="modal fade col-lg-4 col-lg-offset-8" id="eliminarReclamo{!! $reclamo->id !!}">
                <div class="card">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-warning "></i>Eliminar reclamo</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Está a punto de eliminar este reclamo.<br>
                            ¿Desea continuar?
                        </p>
                    </div>
                    <div class="modal-footer">

                        {!! Form::open(['method' => 'delete', 'url' => route('reclamos.destroy', $reclamo->id), 'class' => 'form']) !!}
                            <button type="submit" class="btn btn-danger">Eliminar reclamo</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <p class="lead" id="titulo{!! $reclamo->id !!}">{!! $reclamo->titulo !!}</p>
            <p id="descripcion{!! $reclamo->id !!}">{!! $reclamo->descripcion !!}</p>

            {!! Form::open(['method' => 'put', 'url' => route('reclamos.description.update', $reclamo->id), 'id' => 'formDescripcion'.$reclamo->id,'class' => 'form', 'style' => 'display: none']) !!}

            <div class="form-group">
                {!! Form::label('titulo', 'Título') !!}
                {!! Form::text('titulo', $reclamo->titulo, ['class' => 'form-control', 'id' => 'inputTitulo'.$reclamo->id]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('descripcion', 'Descripción') !!}
                {!! Form::textarea('descripcion', $reclamo->descripcion, ['class' => 'form-control', 'rows' => '6', 'id' => 'textareaDescripcion'.$reclamo->id]) !!}
                <small class="text-warning"><i class="fa fa-exclamation-circle"></i> Máximo 1000 caracteres</small>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default cancelar-edicion" data-id="{!! $reclamo->id !!}">Cancelar</button>
            </div>

            {!! Form::close() !!}


        </div><hr>

        @if($reclamo->estado->slug == 'abierto')
            <div class="col-lg-12">
                <ul class="list-unstyled list-inline listado">
                    <li class="list-group-item">
                        <small class="text-muted">Receptor de la llamada</small><br>
                        {!! $reclamo->owner->full_name !!}
                    </li>
                    @if($reclamo->derivador)
                        <li class="list-group-item">
                            <small class="text-muted">Derivador</small><br>
                            {!! $reclamo->derivador->full_name !!}
                        </li>
                    @endif
                    @if($reclamo->responsable)
                        <li class="list-group-item">
                            <small class="text-muted">Responsable</small><br>
                            {!! $reclamo->responsable->full_name !!}
                        </li>
                    @endif
                    @permission('derivar.reclamo')
                        <li class="list-group-item">
                            <small class="text-muted">Derivación</small><br>
                            <button type="button" data-toggle="modal" data-target="#derivarReclamo{!! $reclamo->id !!}" class="btn btn-primary btn-xs btn-flat">Derivar este reclamo</button>

                            <div class="modal fade col-lg-8 col-lg-offset-2" id="derivarReclamo{!! $reclamo->id !!}">
                                <div class="card">
                                    <div class="panel panel-barra">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h3>Derivar reclamo</h3>
                                        <span class="text-warning">Seleccione un usuario para derivar este reclamo.</span>
                                    </div>
                                    <div class="modal-body">


                                        @include('reclamos.partials.derivacion')

                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                                    </div>
                                </div>
                            </div>

                        </li>
                    @endpermission
                </ul>
            </div>
        @endif
        @endpermission
    </div>

</div>