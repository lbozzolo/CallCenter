@extends('base')

@section('content')

    <h2>
        Reclamo #{!! $reclamo->id !!} / Detalles
    </h2>
    <div class="row">
        <div class="col-lg-6 col-md-12">
           @include('ventas.partials.reclamo')
        </div>
    </div>

@endsection