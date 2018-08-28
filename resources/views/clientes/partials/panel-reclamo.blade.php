<div class="card card-default">

    <div class="card-heading">

        <div class="pull-right">
            <span>{!! $reclamo->fecha_creado !!}</span>
            <label class="{!! ($reclamo->estado->slug == 'abierto')? 'label label-success' : 'label label-danger' !!}">{!! $reclamo->estado->nombre !!}</label>
        </div>

        <h3 class="card-title">Reclamo #{!! $reclamo->id !!}</h3>

        <span class="text-muted">
            @if($reclamo->tipo == 'cliente')
                acerca del producto {!! ucfirst($reclamo->venta->producto->nombre) !!} ({!! $reclamo->venta->producto->marca->nombre !!})
                <a href="{{ route('productos.show', $reclamo->venta->producto->id) }}" title="Ver Producto"></a>
            @else
                por {!! $reclamo->venta->cliente->full_name !!}
                <a href="{{ route('clientes.show', $reclamo->venta->cliente->id) }}" title="Ver Cliente"></a>
            @endif
        </span>

        <div class="pull-right">
            {!! Form::open(['method' => 'put', 'url' => route('reclamos.change.solucionado', $reclamo->id), 'class' => 'form', 'style' => 'display: inline-block']) !!}
            @if($reclamo->solucionado == config('sistema.reclamos.SOLUCIONADO.sinsolucion'))
                <button type="submit" title="Marcar como solucionado" class="btn btn-default btn-sm"><i class="fa fa-check-circle-o"></i></button>
            @else
                <button type="submit" title="Marcar como sin solución" class="btn btn-default btn-sm"><i class="fa fa-exclamation-triangle"></i></button>
            @endif
            {!! Form::close() !!}

            @if($reclamo->estado->slug == 'abierto')
                <span class="btn btn-default btn-sm" title="Cerrar reclamo" data-toggle="modal" data-target="#changeStatus{!! $reclamo->id !!}"><i class="fa fa-window-close-o"></i></span>
            @else
                <span class="btn btn-default btn-sm" title="Volver a abrir reclamo" data-toggle="modal" data-target="#changeStatus{!! $reclamo->id !!}"><i class="fa fa-folder-open"></i></span>
            @endif
            <span title="Editar descripción" class="btn btn-default btn-sm" id="editarReclamo"><i class="fa fa-edit"></i></span>
        </div>
    </div>
    <div class="card-body">
        <div>

            <div class="modal fade col-lg-3" id="changeStatus{!! $reclamo->id !!}">

                    <div class="card alert">
                        <div class="card-header">
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
                        <div class="card-body">
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
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            {!! Form::open(['method' => 'put', 'url' => route('reclamos.change.status', $reclamo->id), 'class' => 'form']) !!}

                            <div class="sweetalert">
                                <div class="text-center">
                                    @if($reclamo->estado->slug == 'abierto')
                                        <button type="submit" class="btn btn-danger sweet-confirm" title="Cerrar reclamo">Cerrar reclamo</button>
                                        {{--{!! Form::submit('Cerrar reclamo', ['title' => 'Cerrar reclamo', 'class' => 'btn btn-danger']) !!}--}}
                                    @else
                                        <button type="submit" class="btn btn-primary sweet-confirm" title="Abrir reclamo">Abrir reclamo</button>
                                        {{--{!! Form::submit('Abrir reclamo', ['title' => 'Abrir reclamo', 'class' => 'btn btn-success']) !!}--}}
                                    @endif
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

            </div>

            <div>
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
                    {!! Form::button('Cancelar', ['id' => 'cancelarEdicion', 'class' => 'btn btn-default']) !!}
                </div>

                {!! Form::close() !!}
            </div>

        </div><hr>
        <div class="col-lg-6 col-md-6">
            <ul class="list-unstyled">
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
        <div class="col-lg-6 col-md-6">
            Llamadas relacionadas:
            <ul class="list-unstyled">
                @forelse($reclamo->llamadas as $llamada)

                    <li>
                        <a href="{{ route('clientes.llamadas.show', ['id' => $cliente->id, 'idReclamo' => $reclamo->id, 'idLlamada' => $llamada->id]) }}"><i class="fa fa-phone"></i> {!! $llamada->fecha_creado !!}</a>
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
</div>