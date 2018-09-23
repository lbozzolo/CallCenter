
<div class="card reclamos-paneles" style="display: none" id="panel-reclamo{!! $reclamo->id !!}">

    <div class="card-heading">
        <span>RECLAMO N° {!! $reclamo->id !!}</span>
        <label class="{!! ($reclamo->estado->slug == 'abierto')? 'label label-success' : 'label label-danger' !!}">{!! $reclamo->estado->nombre !!}</label>
        <span>{!! $reclamo->fecha_creado !!}</span>
        <div>
            @if($reclamo->venta->producto)
                Producto {!! ucfirst($reclamo->venta->producto->nombre) !!} ({!! $reclamo->venta->producto->marca->nombre !!})
                <a href="{{ route('productos.show', $reclamo->venta->producto->id) }}" title="Ver Producto"> <i class="fa fa-briefcase"></i></a>
            @endif
                Producto: {!! ucfirst('espadol') !!} ({!! 'Roche' !!})
                <a href="{{ route('productos.show', $reclamo->id) }}" title="Ver Producto"> <i class="fa fa-briefcase"></i></a>
        </div>
    </div>
    <div class="card-body">
        @permission('cambiar.estado.reclamo')
        <div>
            <span class="pull-right">
                {!! Form::open(['method' => 'put', 'url' => route('reclamos.change.solucionado', $reclamo->id), 'class' => 'form', 'style' => 'display: inline-block']) !!}
                @if($reclamo->solucionado == config('sistema.reclamos.SOLUCIONADO.sinsolucion'))
                    <button type="submit" title="Marcar como solucionado" class="btn btn-default btn-sm"><i class="fa fa-check-circle-o text-success"></i></button>
                @else
                    <button type="submit" title="Marcar como sin solución" class="btn btn-default btn-sm"><i class="fa fa-exclamation-triangle text-warning"></i></button>
                @endif
                {!! Form::close() !!}

                @if($reclamo->estado->slug == 'abierto')
                    <span class="btn btn-default btn-sm" title="Cerrar reclamo" data-toggle="modal" data-target="#changeStatus{!! $reclamo->id !!}"><i class="fa fa-window-close-o text-danger"></i></span>
                @else
                    <span class="btn btn-default btn-sm" title="Volver a abrir reclamo" data-toggle="modal" data-target="#changeStatus{!! $reclamo->id !!}"><i class="fa fa-folder-open text-primary"></i></span>
                @endif
                <span title="Editar descripción" class="btn btn-default btn-sm" id="editarReclamo"><i class="fa fa-edit text-info"></i></span>
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
                            <button type="submit" class="btn btn-success">Abrir reclamo</button>
                        @endif
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <p class="lead" id="titulo">{!! $reclamo->titulo !!}</p>
            <p id="descripcion">{!! $reclamo->descripcion !!}</p>
            {!! Form::open(['method' => 'put', 'url' => route('reclamos.description.update', $reclamo->id), 'id' => 'formDescripcion','class' => 'form', 'style' => 'display: none']) !!}

            <div class="form-group">
                {!! Form::label('titulo', 'Título') !!}
                {!! Form::text('titulo', $reclamo->titulo, ['class' => 'form-control', 'id' => 'inputTitulo']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('descripcion', 'Descripción') !!}
                {!! Form::textarea('descripcion', $reclamo->descripcion, ['class' => 'form-control', 'rows' => '6']) !!}
                <small class="text-warning"><i class="fa fa-exclamation-circle"></i> Máximo 1000 caracteres</small>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" id="cancelarEdicion">Cancelar</button>
            </div>

            {!! Form::close() !!}
        </div><hr>
        <div class="col-lg-6 col-md-6">
            <ul class="list-unstyled listado">
                <li class="list-group-item">
                    @if($reclamo->solucionado == 0)
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                        <em class="text-danger">Reclamo sin solución</em>
                    @else
                        <i class="fa fa-check-circle text-success"></i>
                        <em class="text-success">Reclamo solucionado</em>
                    @endif
                </li>
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
            </ul>
        </div>
    </div>
    @endpermission
</div>