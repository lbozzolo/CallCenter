<ul class="list-inline">
    <li>
        <button type="button" class="nonStyledButton" data-toggle="modal" data-target="#agregarProducto" >
            <i class="fa fa-plus text-primary"></i> Agregar
        </button>
        <div class="modal fade col-lg-6 col-lg-offset-2" id="agregarProducto">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="card-title">Agregar producto</h4>
                    </div>
                    <div class="card-body">


                        <div class="card card-default"  style="max-height: 500px; overflow: scroll; overflow-x: hidden">
                            <div class="card-heading">
                                <span class="card-title">Buscar producto</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <form class="form-horizontal">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <div class="input-group input-group-sm">
                                                            {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'producto_valor']) !!}
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-primary btn-flat" id="search">
                                                                    <i class="fa fa-search"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="row">

                                        </div>
                                        <div class="row" id="div-table-resultados">
                                            <div class="text-center">
                                                <i class="fa fa-refresh fa-spin" style="display: none; font-size: 2em" id="cargando"></i>
                                            </div>
                                            @permission('crear.venta')
                                            <div class="col-xs-12">
                                                <div class="card card-info">
                                                    <div class="table-responsive">
                                                        {!! Form::open(['url' => route('ventas.agregar.producto'), 'method' => 'POST']) !!}
                                                        <table class="table table-hover" id="tbl-resultados">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nombre</th>
                                                                <th>Marca</th>
                                                                <th>Precio</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            @endpermission
                                        </div>

                                        <div class="row" id="sinresultados">
                                            <div class="col-lg-12">
                                                <span class="text-muted">Sin resultados.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
        </div>
    </li>
</ul>

<div class="row">

    <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">

        <ul class="list-unstyled listado">
        @foreach($venta->productos as $producto)

            <li class="list-group-item">

                <h4 class="card-title" style="display: inline-block">
                    {!! ucfirst($producto->nombre) !!}
                    {!! ($producto->marca)? ', '.$producto->marca->nombre : '' !!}
                </h4>
                @permission('quitar.producto.venta')
                <button type="button" class="btn btn-danger btn-xs pull-right" data-toggle="modal" data-target="#quitarProducto{{ $producto->id }}"><i class="fa fa-trash"></i></button>
                <div class="modal fade text-left col-lg-3 col-lg-offset-4" id="quitarProducto{{ $producto->id }}">
                    <div class="card">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-danger"><i class="fa fa-exclamation-triangle"></i> Quitar producto</h4>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro que desea quitar el producto "{!! $producto->nombre !!}" de esta venta?</p>
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'url' => route('ventas.quitar.producto')]) !!}
                            {!! Form::hidden('producto_id', $producto->id) !!}
                            {!! Form::hidden('venta_id', $venta->id) !!}
                            <button type="submit" class="btn btn-danger pull-left">Quitar</button>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                @endpermission

                <span class="text-info" style="font-size: 2em">{!! ($producto->precio)? "$ ".$producto->precio : '' !!}</span>
                <div>{!! ($producto->descripcion)? $producto->descripcion : '' !!}</div>
                <div>
                    <div style="padding: 10px 0 0 0">
                        <strong>Categorías</strong><br>
                        @foreach($producto->categorias as $categoria)
                            <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                        @endforeach
                    </div>
                    <div style="padding: 10px 0 0 0">
                        <strong>Medida</strong>
                        {!! ($producto->cantidad_medida)? $producto->cantidad_medida : '' !!}
                        {!! ($producto->unidadMedida)? $producto->unidadMedida->nombre : '' !!}
                    </div>
                </div>

                @if($producto->prospecto != '' && $producto->prospecto != null)
                    <div>
                        <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseComponentes{{ $producto->id }}" aria-expanded="false" aria-controls="collapseComponentes{{ $producto->id }}">
                            <span class="text-primary">Prospecto (componentes)</span>
                            <i class="fa fa-caret-down "></i>
                        </span>
                        <div class="list-unstyled collapse"  id="collapseComponentes{{ $producto->id }}" aria-labelledby="headingOne" data-parent="#accordion">
                            {!! $producto->prospecto !!}
                        </div>
                    </div>
                @endif

                @if(count($producto->etapas) > 0)
                    <div>
                        Etapas:
                        @foreach($producto->etapas as $etapa)
                            <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $etapa->nombre !!}</label>
                        @endforeach
                    </div>
                @endif
                @if($producto->institucion_id)
                    <div>
                        Institución: {!! ($producto->institucion_id)? $producto->institucion->nombre : '<em class="text-muted">(sin datos)</em>' !!}
                    </div>
                @endif

                @permission('editar.venta')

                    <div>
                        {!! Form::model($venta, ['method' => 'put', 'url' => route('ventas.editar.modos')]) !!}

                        <button type="submit" class="btn btn-primary btn-xs pull-right">guardar</button>
                        {!! Form::hidden('venta_id', $venta->id) !!}
                        {!! Form::label('observaciones', 'Observaciones / modos de uso') !!}
                        {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '6']) !!}

                        {!! Form::close() !!}
                    </div>

                @endpermission

            </li>

            @if(count($venta->productos) > 1)
                        {{--<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">

                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#quitarProducto{{ $producto->id }}"><i class="fa fa-trash"></i></button>
                            <div class="modal fade" id="quitarProducto{{ $producto->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title text-danger"><i class="fa fa-exclamation-triangle"></i> Quitar producto</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Está seguro que desea quitar el producto "{!! $producto->nombre !!}" de esta venta?</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::open(['method' => 'DELETE', 'url' => route('ventas.quitar.producto')]) !!}
                                            {!! Form::hidden('producto_id', $producto->id) !!}
                                            {!! Form::hidden('venta_id', $venta->id) !!}
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                            {!! Form::submit('Quitar', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>--}}
            @endif
            {{--@if(count($venta->productos) > 1)
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2 text-right">
                    <span>${!! $producto->precio !!}</span>
                </div>
            @endif--}}

        @endforeach

        </ul>

    </div>

    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 ">

        <div>
        {!! Form::model($venta, ['url' => route('ventas.numero.guia', $venta->id), 'method' => 'post']) !!}

            <div class="form-group">
                {!! Form::label('numero_guia', 'Número de guía') !!}
                {!! Form::text('numero_guia', $venta->numero_guia, ['class' => 'form-control']) !!}
                <button type="submit" class="btn btn-xs btn-info">guardar</button>
            </div>

        {!! Form::close() !!}
        </div>

        <ul class="list-unstyled listado text-right">

            @foreach($venta->productos as $producto)

                <li class="list-group-item">
                    <span class="pull-left"> {!! $producto->nombre !!}</span>
                    <span class="">${!! $producto->precio !!}</span>
                </li>

            @endforeach

            <li class="list-group-item">
                <div class="text-right">Subtotal <strong> ${!! $venta->total_venta !!}</strong></div>
                @if($venta->interes_venta)
                    <div class="text-right">Intereses ({!! $venta->datosTarjeta->formaPago->interes !!}%)<strong>+ ${!! $venta->interes_venta !!}</strong></div>
                @endif
                @if($venta->descuento_venta)
                    <div class="text-right">Descuentos ({!! $venta->datosTarjeta->formaPago->descuento !!}%)<strong>- ${!! $venta->descuento_venta !!}</strong></div>
                @endif
                <div class="text-right">IVA (21%) <strong style="border-top: 1px solid lightgray">+${!! $venta->IVA !!}</strong> </div>
            </li>
            <li class="list-group-item">
                <div class="text-right"><span class="text-primary" style="font-size: 1.5em">${!! $venta->importe_total !!}</span></div>
                @if($venta->has_cuotas)
                    <div class="text-right">
                        <small class="text-muted">
                            {!! $venta->has_cuotas->cuota_cantidad !!} cuotas de <span class=" text-primary">${!! $venta->valor_cuota !!}</span>
                        </small>
                    </div>
                @endif
            </li>

        </ul>

    </div>

</div>


