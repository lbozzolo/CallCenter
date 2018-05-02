@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            Llamadas
                            <span class="text-muted"> /
                                {!! ($llamada->reclamo_id)? 'Reclamo del ' : 'Venta del ' !!}
                                {!! $llamada->fecha_creado !!}</span>
                        </h2>
                        @if($llamada->reclamo)

                            @include('reclamos.partials.navbar')

                        @else

                            @include('ventas.partials.navbar')

                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                @if($llamada->reclamo)
                                    <h3 class="panel-title">Llamada N° {!! $llamada->id !!} - Reclamo N° {!! $llamada->reclamo->id !!}</h3>
                                @else
                                    <h3 class="panel-title">Llamadas - venta</h3>
                                @endif
                            </div>
                            <div class="panel-body">
                                @if($llamada->reclamo)

                                    @include('llamadas.partials.show-llamada-reclamo')

                                @else

                                    @include('llamadas.partials.show-llamada-venta')

                                @endif
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>

@endsection



