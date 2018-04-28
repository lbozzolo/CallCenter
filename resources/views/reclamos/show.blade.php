@extends('base')

@section('content')

    <div class="row">

        <div class="container">

            <div class="content">
                <h2>
                    Reclamos
                    <span class="text-muted">
                        / {!! $reclamo->venta->cliente->full_name !!}
                        / Producto: {!! $reclamo->venta->producto->nombre !!}</span>
                </h2>

                @include('reclamos.partials.navbar')

                <div class="col-lg-4">

                    <ul>
                        <li class="list-group-item">
                            <small class="text-muted">Cliente</small><br>
                            {!! $reclamo->venta->cliente->full_name !!}
                        </li>
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
                                            {!! $complain->fecha_creado !!}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    </ul>

                </div>

                <div class="col-lg-8">

                    @if($reclamoFecha)
                    <ul class="list-unstyled">

                        <li class="list-group-item"><span class="lead">Reclamo {!! $reclamoFecha->fecha_creado !!}</span></li>
                        <li class="list-group-item">Descripción: {!! $reclamoFecha->venta->producto->descripcion !!}</li>
                        <li class="list-group-item">Estado: {!! $reclamoFecha->estado->nombre !!}</li>
                        <li class="list-group-item">Solucionado</li>
                        <li class="list-group-item">Receptor de la llamada: {!! $reclamoFecha->owner->full_name !!}</li>
                        <li class="list-group-item">Derivador: {!! $reclamoFecha->derivador->full_name !!}</li>
                        <li class="list-group-item">Responsable: {!! $reclamoFecha->responsable->full_name !!}</li>

                    </ul>
                    @endif

                </div>

            </div>
        </div>
    </div>

@endsection
