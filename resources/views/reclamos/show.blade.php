@extends('base')

@section('content')

    <div class="row">

        <div class="container">

            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            Reclamos<span class="text-muted"> / {!! $reclamo->venta->cliente->full_name !!} / Producto: {!! $reclamo->venta->producto->nombre !!}</span>
                        </h2>

                        @include('reclamos.partials.navbar')

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <small class="text-muted">Cliente</small>
                                {!! $reclamo->venta->cliente->full_name !!}
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <ul class="list-unstyled">
                                            <li class="list-group-item">
                                                <small class="text-muted">Producto</small><br>
                                                {!! $reclamo->venta->producto->nombre !!}
                                            </li>
                                            <li class="list-group-item">
                                                <small class="text-muted">Reclamos</small><br>
                                                <ul class="list-unstyled">
                                                    @foreach($reclamo->venta->reclamos as $complain)
                                                        <li>
                                                            <a class="{!! ($reclamoFecha && $reclamoFecha->id == $complain->id)? 'bg-info' : '' !!}" href="{{ route('reclamos.show',  ['id' => $reclamo->id, 'reclamoFecha' => $complain->id]) }}">
                                                                <i class="fa fa-thumbs-o-down"></i>
                                                                {!! $complain->titulo !!}
                                                            </a>
                                                            <small>({!! $complain->fecha_creado !!})</small>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        @if($reclamoFecha)

                                            @include('reclamos.partials.panel-reclamo')

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
