<div class="row">
    <div class="col-lg-12">

        <div class="card card-default">
            <div class="card-header">
                <h3>Selección de producto(s)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    {!! Form::open(['url' => route('ventas.agregar.producto'), 'method' => 'post']) !!}
                        <div class="col-lg-5">
                            {!! Form::hidden('venta_id', $venta->id) !!}
                            {!! Form::select('producto_id[]', $products, null, ['class' => 'form-control select2 select2b', 'placeholder' => '']) !!}
                            {!! Form::hidden('cantidad', 1, ['class' => 'form-control', 'style' => 'height: 30px']) !!}
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Agregar producto(s)</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @if($venta->productos->count())
        <div class="card card-default">
            <div class="card-header">
                <h3>Productos seleccionados</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th class="text-center">Etapa</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Precio u.</th>
                                <th colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : 'gray' !!}">1 cuota</th>
                                <th colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : 'dimgray' !!}">3 cuotas ( + {!! config('sistema.ventas.intereses.3') !!}%)</th>
                                <th colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : 'gray' !!}">6 cuotas ( + {!! config('sistema.ventas.intereses.6') !!}%)</th>
                                <th colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : 'dimgray' !!}">9 cuotas ( + {!! config('sistema.ventas.intereses.9') !!}%)</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-right" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : '' !!}">Pago</th>
                                <th class="text-right" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : '' !!}">$ x cuota</th>
                                <th class="text-right" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : '' !!}">Pago</th>
                                <th class="text-right" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : '' !!}">$ x cuota</th>
                                <th class="text-right" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : '' !!}">Pago</th>
                                <th class="text-right"style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : '' !!}">$ x cuota</th>
                                <th class="text-right"style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : '' !!}">Pago</th>
                                <th class="text-right"style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : '' !!}">$ x cuota</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($productosVenta as $group)
                            @foreach($group->groupBy('id') as $producto)
                                <tr>
                                    <td>{!! $producto->first()->nombre !!}</td>
                                    <td class="text-center">
                                        @if($producto->first()->hasEtapas())
                                        {!! ($venta->etapa_id)? $venta->etapa_id.'/'. $producto->first()->etapas->count() : '0/'. $producto->first()->etapas->count() !!}
                                        @else
                                            NO
                                        @endif
                                    </td>
                                    <td>

                                        <div class="row">
                                            <div class="col-lg-4">{!! $producto->count() !!}</div>
                                            <div class="col-lg-4" style="margin: 0px; padding: 0px">
                                                {!! Form::open(['url' => route('ventas.agregar.producto'), 'method' => 'post']) !!}

                                                {!! Form::hidden('venta_id', $venta->id) !!}
                                                {!! Form::hidden('producto_id', $producto->first()->id) !!}
                                                {!! Form::hidden('cantidad', 1) !!}

                                                <button type="submit" title="Agregar producto" class="btn btn-default btn-xs" style="margin: 0px"><i class="fa fa-plus"></i></button>

                                                {!! Form::close() !!}
                                            </div>
                                            <div class="col-lg-4" style="margin: 0px; padding: 0px">
                                                {!! Form::open(['url' => route('ventas.quitar.producto'), 'method' => 'delete', 'style']) !!}

                                                {!! Form::hidden('venta_id', $venta->id) !!}
                                                {!! Form::hidden('producto_id', $producto->first()->id) !!}

                                                <button type="submit" title="Agregar producto" class="btn btn-default btn-xs" style="margin: 0px"><i class="fa fa-minus"></i></button>

                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        {!! $producto->first()->cantidad_medida !!}
                                    </td>
                                    <td class="text-right">${!! $producto->first()->precio !!}</td>
                                    {{--Una cuota--}}
                                    <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : 'gray' !!}">${!! $producto->first()->precioMasInteresCuota(1, $producto->count()) !!}</td>
                                    <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : 'gray' !!}">${!! $producto->first()->precioPorCuota() !!}</td>
                                    {{--Tres cuotas--}}
                                    <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : 'dimgray' !!}">${!! $producto->first()->precioMasInteresCuota(3, $producto->count()) !!}</td>
                                    <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : 'dimgray' !!}">${!! $producto->first()->precioPorCuota(3) !!}</td>
                                    {{--Seis cuotas--}}
                                    <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : 'gray' !!}">${!! $producto->first()->precioMasInteresCuota(6, $producto->count()) !!}</td>
                                    <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : 'gray' !!}">${!! $producto->first()->precioPorCuota(6) !!}</td>
                                    {{--Nueve cuotas--}}
                                    <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : 'dimgray' !!}">${!! $producto->first()->precioMasInteresCuota(9, $producto->count()) !!}</td>
                                    <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : 'dimgray' !!}">${!! $producto->first()->precioPorCuota(9) !!}</td>
                                    <td>
                                        @permission('quitar.producto.venta')
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#quitarProducto{{ $producto->first()->id }}" title="Quitar Producto"><i class="fa fa-close"></i> </button>
                                        <div class="modal fade text-left col-lg-3 col-lg-offset-9" id="quitarProducto{{ $producto->first()->id }}">
                                            <div class="card">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-danger"><i class="fa fa-exclamation-triangle"></i> Quitar productos</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Está seguro que desea quitar todos los productos "{!! $producto->first()->nombre !!}" de esta venta?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    {!! Form::open(['method' => 'DELETE', 'url' => route('ventas.quitar.productos')]) !!}
                                                        {!! Form::hidden('venta_id', $venta->id) !!}
                                                        {!! Form::hidden('producto_id', $producto->first()->id) !!}
                                                        <button type="submit" class="btn btn-danger pull-left">Quitar</button>
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        @endpermission
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right">Subtotal</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : 'gray' !!}">${!! $venta->suma_subtotal_productos !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : 'gray' !!}">${!! $venta->suma_subtotal_productos !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->subtotalProductos(3) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->subtotalProductos(3) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : 'gray' !!}">${!! $venta->subtotalProductos(6) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : 'gray' !!}">${!! $venta->subtotalProductos(6) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->subtotalProductos(9) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->subtotalProductos(9) !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">Gastos de envío</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : 'gray' !!}">${!! $venta->gastosEnvioMasInteres(1) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : 'gray' !!}">${!! $venta->gastosEnvioMasInteres(1) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->gastosEnvioMasInteres(3) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->gastosEnvioMasInteres(3) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : 'gray' !!}">${!! $venta->gastosEnvioMasInteres(6) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : 'gray' !!}">${!! $venta->gastosEnvioMasInteres(6) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->gastosEnvioMasInteres(9) !!}</td>
                                <td class="text-right" style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->gastosEnvioMasInteres(9) !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">TOTAL</td>
                                <td colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : 'gray' !!}">${!! $venta->totalPorCuotas(1) !!}</td>
                                <td colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->totalPorCuotas(3) !!}</td>
                                <td colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : 'gray' !!}">${!! $venta->totalPorCuotas(6) !!}</td>
                                <td colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : 'dimgray' !!}">${!! $venta->totalPorCuotas(9) !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 1)? 'dodgerblue' : 'gray' !!}">
                                    {!! Form::open(['url' => route('ventas.seleccionar.plan.cuotas'), 'method' => 'post', 'class' => 'form']) !!}
                                        {!! Form::hidden('venta_id', $venta->id) !!}
                                        {!! Form::hidden('numero_de_cuotas', 1) !!}
                                        @if($venta->plan_cuotas != 1)
                                        <button type="submit" class="btn btn-primary btn-sm">Seleccionar</button>
                                        @else
                                        {!! Form::submit('Cancelar', ['class' => 'btn btn-default btn-sm']) !!}
                                        @endif
                                    {!! Form::close() !!}
                                </td>
                                <td colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 3)? 'dodgerblue' : 'dimgray' !!}">
                                    {!! Form::open(['url' => route('ventas.seleccionar.plan.cuotas'), 'method' => 'post', 'class' => 'form']) !!}
                                        {!! Form::hidden('venta_id', $venta->id) !!}
                                        {!! Form::hidden('numero_de_cuotas', 3) !!}
                                        @if($venta->plan_cuotas != 3)
                                        <button type="submit" class="btn btn-primary btn-sm">Seleccionar</button>
                                        @else
                                            {!! Form::submit('Cancelar', ['class' => 'btn btn-default btn-sm']) !!}
                                        @endif
                                    {!! Form::close() !!}
                                </td>
                                <td colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 6)? 'dodgerblue' : 'gray' !!}">
                                    {!! Form::open(['url' => route('ventas.seleccionar.plan.cuotas'), 'method' => 'post', 'class' => 'form']) !!}
                                        {!! Form::hidden('venta_id', $venta->id) !!}
                                        {!! Form::hidden('numero_de_cuotas', 6) !!}
                                        @if($venta->plan_cuotas != 6)
                                        <button type="submit" class="btn btn-primary btn-sm">Seleccionar</button>
                                        @else
                                            {!! Form::submit('Cancelar', ['class' => 'btn btn-default btn-sm']) !!}
                                        @endif
                                    {!! Form::close() !!}
                                </td>
                                <td colspan="2" class="text-center" style="background-color: {!! ($venta->plan_cuotas == 9)? 'dodgerblue' : 'dimgray' !!}">
                                    {!! Form::open(['url' => route('ventas.seleccionar.plan.cuotas'), 'method' => 'post', 'class' => 'form']) !!}
                                        {!! Form::hidden('venta_id', $venta->id) !!}
                                        {!! Form::hidden('numero_de_cuotas', 9) !!}
                                        @if($venta->plan_cuotas != 9)
                                            <button type="submit" class="btn btn-primary btn-sm">Seleccionar</button>
                                        @else
                                            {!! Form::submit('Cancelar', ['class' => 'btn btn-default btn-sm']) !!}
                                        @endif
                                    {!! Form::close() !!}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        @endif

    </div>
</div>