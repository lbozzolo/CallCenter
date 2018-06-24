<ul class="list-inline">
    <li>
        <button type="button" class="nonStyledButton" data-toggle="modal" data-target="#agregarProducto" >
            <i class="fa fa-plus text-primary"></i> Agregar
        </button>
        <div class="modal fade" id="agregarProducto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Agregar producto</h4>
                    </div>
                    <div class="modal-body">


                        <div class="panel panel-default"  style="max-height: 500px; overflow: scroll; overflow-x: hidden">
                            <div class="panel-heading">
                                <span class="panel-title">Buscar producto</span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <form class="form-horizontal">
                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <div class="form-group">
                                                            <div class="col-lg-12 col-sm-8">
                                                                <div class="input-group input-group-sm">
                                                                    {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'producto_valor']) !!}
                                                                    <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-info btn-flat" id="search">
                                                                        <i class="fa fa-search"></i>
                                                                    </button>
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br class="clearfix" />
                                                    </fieldset>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row">

                                        </div>
                                        <div class="row" id="div-table-resultados">
                                            <div class="text-center">
                                                <i class="fa fa-refresh fa-spin" style="display: none; font-size: 2em" id="cargando"></i>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="panel panel-info">
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
        </div>
    </li>
</ul>

<div class="row">

    <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">

        @foreach($venta->productos as $producto)


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="panel panel-default">
                    <div class="panel-heading" style="cursor: pointer" data-toggle="collapse" data-target="#producto{{ $producto->id }}" aria-expanded="false" aria-controls="producto{{ $producto->id }}">
                        <div class="row">
                            <div class="col-lg-10">
                                <h4 class="panel-title">
                                    {!! ucfirst($producto->nombre) !!}
                                    {!! ($producto->marca)? ', '.$producto->marca->nombre : '' !!}
                                </h4>
                            </div>
                            <div class="col-lg-2 text-right">
                                {{--<i class="fa fa-caret-down"></i>--}}
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#quitarProducto{{ $producto->id }}"><i class="fa fa-trash"></i></button>
                                <div class="modal fade text-left" id="quitarProducto{{ $producto->id }}">
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
                            </div>
                        </div>
                    </div>
                    <div class="{{ ($venta->productos->count() > 1)? 'panel-body collapse' : 'panel-body' }}" id="producto{{ $producto->id }}" aria-labelledby="headingOne" data-parent="#accordion">

                        <div class="row">
                            <div class="col-lg-6">

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

                                <hr>

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
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    {!! Form::model($venta, ['method' => 'put', 'url' => route('ventas.editar.modos')]) !!}
                                    {!! Form::submit('guardar', ['class' => 'btn btn-primary btn-xs pull-right']) !!}
                                    {!! Form::hidden('venta_id', $venta->id) !!}
                                    {!! Form::label('observaciones', 'Observaciones / modos de uso') !!}
                                    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '6']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


            </div>
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

    </div>

    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 text-right">

        <ul class="list-unstyled">

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

        {{--<ul class="list-unstyled">
            <li class="list-group-item"><em class="pull-left">subtotal</em> <strong>${!! $venta->total_venta !!}</strong></li>
            @if($venta->interes_venta)
                <li class="list-group-item"><em class="pull-left">intereses</em> <strong>${!! $venta->interes_venta !!}</strong></li>
            @endif
            @if($venta->descuento_venta)
                <li class="list-group-item"><em class="pull-left">descuentos</em> <strong>${!! $venta->descuento_venta !!}</strong></li>
            @endif
            <li class="list-group-item">
                <em class="pull-left">total</em>
                <span class="text-primary" style="font-size: 1.5em"> ${!! $venta->importe_total !!}</span>
            </li>
        </ul>--}}

    </div>

</div>


