@extends('ventas.base')

@section('titulo')

    <h2>Ventas<span class="text-muted"> / Reclamos</span> </h2>

@endsection


@section('contenido')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <h3>
                        #{!! $venta->id !!}
                        <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
                        Operador: {!! $venta->user->full_name !!}
                    </h3>
                </div>
                <div class="col-lg-3 col-md-12 text-right">
                    <span class="text-primary" style="font-size: 2.5em">${!! $venta->importe_total !!}</span>
                    @if($venta->has_cuotas)
                        <div class="text-muted">
                            {!! $venta->has_cuotas->cuota_cantidad !!} cuotas de <span class=" text-primary">${!! $venta->valor_cuota !!}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-4">

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Información general</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled listado">
                        <li class="list-group-item">Cliente: {!! $venta->cliente->full_name !!}</li>
                        <li class="list-group-item">Fecha de venta: {!! $venta->fecha_creado !!}</li>
                        <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                    </ul>
                    @permission('ver.venta')
                    <a href="{{ route('ventas.show', $venta->id) }}" style="color:cyan">ver venta</a>
                    @endpermission
                </div>
            </div>
            <div class="card">
                @if($venta->reclamos->count())

                    <div class="card-header">
                        <h3>Listado de reclamos</h3>
                    </div>
                    <div class="card-body">
                        <ul class="listado">
                            @foreach($venta->reclamos as $reclamo)
                                <li class="list-group-item reclamo-list-item" id="reclamo{!! $reclamo->id !!}" style="cursor: pointer">
                                    <span class="text-info">{!! '#'.$reclamo->id !!}</span>
                                    {!! ($reclamo->titulo)? $reclamo->titulo : '' !!}
                                    @if($reclamo->estado->slug == 'cerrado')
                                        <span class="pull-right" title="reclamo cerrado"><i class="fa fa-window-close-o text-danger"></i></span>
                                    @else
                                        <span class="pull-right" title="reclamo abierto"><i class="fa fa-folder-open text-primary"></i></span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                @else

                    <p>Esta venta no tiene ningún reclamo.</p>

                @endif
            </div>

        </div>
        <div class="col-lg-8">

            <div class="card">
                <div class="card-header">
                    <h3>Reclamo</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>
                            <p id="seleccione">Seleccione un reclamo de la lista</p>
                        </li>
                        @foreach($venta->reclamos as $reclamo)

                            @permission('ver.reclamos.venta')
                            @include('ventas.partials.panel-reclamo')
                            @endpermission

                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

    </div>

@endsection



@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>

    <script>

        $('.reclamo-list-item').click(function () {
            $('#seleccione').hide();
            var id = '#panel-' + $(this).attr('id');
            $('.reclamos-paneles').hide();
            $(id).show();
        });


        $('#editarReclamo').click(function () {
            $('#descripcion').hide();
            $('#formDescripcion').show();
            $('#titulo').hide();
        });

        $('#cancelarEdicion').click(function () {
            $('#descripcion').show();
            $('#formDescripcion textarea').val('{!! (isset($reclamo))? $reclamo->descripcion : '' !!}');
            $('#formDescripcion').hide();
            $('#inputTitulo').val('{!! (isset($reclamo))? $reclamo->titulo : '' !!}');
            $('#titulo').show();
        });


    </script>

@endsection