<div class="panel panel-default">

    <div class="panel-heading">
        <span>RECLAMO N° {!! $reclamoFecha->id !!}</span>
        <label class="{!! ($reclamoFecha->estado->slug == 'abierto')? 'label label-success' : 'label label-danger' !!}">{!! $reclamoFecha->estado->nombre !!}</label>
        <span>{!! $reclamoFecha->fecha_creado !!}</span>
        <span>
            @if($reclamoFecha->tipo == 'cliente')
                acerca del producto {!! ucfirst($reclamoFecha->venta->producto->nombre) !!} ({!! $reclamoFecha->venta->producto->marca->nombre !!})
                <a href="{{ route('productos.show', $reclamoFecha->venta->producto->id) }}" title="Ver Producto"> <i class="fa fa-briefcase"></i></a>
            @else
                realizado por {!! $reclamoFecha->venta->cliente->full_name !!}
                <a href="{{ route('clientes.show', $reclamoFecha->venta->cliente->id) }}" title="Ver Cliente"><i class="fa fa-user"></i></a>
            @endif
        </span>
    </div>
    <div class="panel-body">
        @permission('cambiar.estado.reclamo')
        <div>
            <span class="pull-right">
                {!! Form::open(['method' => 'put', 'url' => route('reclamos.change.solucionado', $reclamoFecha->id), 'class' => 'form', 'style' => 'display: inline-block']) !!}
                    @if($reclamoFecha->solucionado == config('sistema.reclamos.SOLUCIONADO.sinsolucion'))
                    <button type="submit" title="Marcar como solucionado" class="btn btn-default btn-sm"><i class="fa fa-check-circle-o"></i></button>
                    @else
                    <button type="submit" title="Marcar como sin solución" class="btn btn-default btn-sm"><i class="fa fa-exclamation-triangle"></i></button>
                    @endif
                {!! Form::close() !!}

                @if($reclamoFecha->estado->slug == 'abierto')
                    <span class="btn btn-default btn-sm" title="Cerrar reclamo" data-toggle="modal" data-target="#changeStatus{!! $reclamoFecha->id !!}"><i class="fa fa-window-close-o"></i></span>
                @else
                    <span class="btn btn-default btn-sm" title="Volver a abrir reclamo" data-toggle="modal" data-target="#changeStatus{!! $reclamoFecha->id !!}"><i class="fa fa-folder-open"></i></span>
                @endif
                <span title="Editar descripción" class="btn btn-default btn-sm" id="editarReclamo"><i class="fa fa-edit"></i></span>
            </span>

            <div class="modal fade" id="changeStatus{!! $reclamoFecha->id !!}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-warning "></i>
                                @if($reclamoFecha->estado->slug == 'abierto')
                                Cerrar el RECLAMO N° {!! $reclamoFecha->id !!}
                                @else
                                Abrir el RECLAMO N° {!! $reclamoFecha->id !!}
                                @endif
                            </h4>
                        </div>
                        <div class="modal-body">
                            @if($reclamoFecha->estado->slug == 'abierto')
                                <p>¿Desea cerrar el reclamo?</p>
                            @else
                                <p>
                                    El reclamo que usted seleccionó se encuentra cerrado.<br>
                                    ¿Desea abrir el reclamo nuevamente?
                                </p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            {!! Form::open(['method' => 'put', 'url' => route('reclamos.change.status', $reclamoFecha->id), 'class' => 'form']) !!}
                            @if($reclamoFecha->estado->slug == 'abierto')
                                {!! Form::submit('Cerrar reclamo', ['title' => 'Cerrar reclamo', 'class' => 'btn btn-danger']) !!}
                            @else
                                {!! Form::submit('Abrir reclamo', ['title' => 'Abrir reclamo', 'class' => 'btn btn-success']) !!}
                            @endif
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <p class="lead" id="titulo">{!! $reclamoFecha->titulo !!}</p>
            <p id="descripcion">{!! $reclamoFecha->descripcion !!}</p>
            {!! Form::open(['method' => 'put', 'url' => route('reclamos.description.update', $reclamoFecha->id), 'id' => 'formDescripcion','class' => 'form', 'style' => 'display: none']) !!}

            <div class="form-group">
                {!! Form::label('titulo', 'Título') !!}
                {!! Form::text('titulo', $reclamoFecha->titulo, ['class' => 'form-control', 'id' => 'inputTitulo']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('descripcion', 'Descripción') !!}
                {!! Form::textarea('descripcion', $reclamoFecha->descripcion, ['class' => 'form-control', 'rows' => '6']) !!}
                <small class="text-warning"><i class="fa fa-exclamation-circle"></i> Máximo 1000 caracteres</small>
            </div>
            <div class="form-group">
                {!! Form::submit('Guardar', ['class' => 'btn btn-info']) !!}
                {!! Form::button('Cancelar', ['id' => 'cancelarEdicion', 'class' => 'btn btn-default']) !!}
            </div>

            {!! Form::close() !!}
        </div><hr>
        <div class="col-lg-6 col-md-6">
            <ul class="list-unstyled">
                <li class="list-group-item">
                    @if($reclamoFecha->solucionado == 0)
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                        <em class="text-danger">Reclamo sin solución</em>
                    @else
                        <i class="fa fa-check-circle text-success"></i>
                        <em class="text-success">Reclamo solucionado</em>
                    @endif
                </li>
                <li class="list-group-item">
                    <small class="text-muted">Receptor de la llamada</small><br>
                    {!! $reclamoFecha->owner->full_name !!}
                </li>
                @if($reclamoFecha->derivador)
                    <li class="list-group-item">
                        <small class="text-muted">Derivador</small><br>
                        {!! $reclamoFecha->derivador->full_name !!}
                    </li>
                @endif
                @if($reclamoFecha->responsable)
                    <li class="list-group-item">
                        <small class="text-muted">Responsable</small><br>
                        {!! $reclamoFecha->responsable->full_name !!}
                    </li>
                @endif
            </ul>
        </div>
        <div class="col-lg-6 col-md-6">
            Llamadas relacionadas:
            <ul class="list-unstyled">
                @forelse($reclamoFecha->llamadas as $llamada)

                    <li>
                        <a href="{{ route('llamadas.show', $llamada->id) }}"><i class="fa fa-phone"></i> {!! $llamada->fecha_creado !!}</a>
                        <small>(llamada {!! config('sistema.llamadas.TIPO_LLAMADA.'.$llamada->tipo_llamada) !!})</small>
                    </li>

                @empty

                    <li>
                        <small class="text-muted">No hay ninguna llamada relacionada con este reclamo</small>
                    </li>

                @endforelse
            </ul>
        </div>
    </div>
    @endpermission
</div>