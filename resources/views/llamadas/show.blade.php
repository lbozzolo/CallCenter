@extends('llamadas.base')

@section('titulo')

    <h2>
        Llamadas
        <span class="text-muted"> /
            {!! ($llamada->reclamo_id)? 'Reclamo del ' : 'Venta del ' !!}
            {!! $llamada->fecha_creado !!}
        </span>
    </h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-heading">

                    <div class="pull-right">
                        @if(config('sistema.llamadas.TIPO_LLAMADA.'.$llamada->tipo_llamada) == 'saliente')
                            <i class="fa fa-phone"></i>
                            <i class="fa fa-sign-out"></i>
                        @else
                            <i class="fa fa-sign-in"></i>
                            <i class="fa fa-phone"></i>
                        @endif
                        {!! config('sistema.llamadas.TIPO_LLAMADA.'.$llamada->tipo_llamada) !!}
                    </div>

                    @if($llamada->reclamo)
                        <h3 class="card-title">Llamada N° {!! $llamada->id !!} - Reclamo N° {!! $llamada->reclamo->id !!}</h3>
                    @else
                        <h3 class="card-title">Llamadas - venta</h3>
                    @endif

                </div>
                <div class="card-body">
                    @if($llamada->reclamo)

                        @include('llamadas.partials.show-llamada-reclamo')

                    @else

                        @include('llamadas.partials.show-llamada-venta')

                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection



