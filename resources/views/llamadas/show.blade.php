@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>
                    Llamadas
                    <span class="text-muted"> /
                        {!! ($llamada->reclamo_id)? 'Reclamo del ' : 'Venta del ' !!}
                        {!! $llamada->fecha_creado !!}</span>
                </h2>


                    @if($llamada->reclamo)

                        @include('reclamos.partials.navbar')

                    <div class="col-lg-6 col-md-6">

                        @include('llamadas.partials.show-llamada-reclamo')

                    </div>
                    <div class="col-lg-6 col-md-6">



                    </div>

                    @else

                        @include('ventas.partials.navbar')

                    <div class="col-lg-6 col-md-6">

                        @include('llamadas.partials.show-llamada-venta')

                    </div>

                    @endif


            </div>
        </div>
    </div>

@endsection



