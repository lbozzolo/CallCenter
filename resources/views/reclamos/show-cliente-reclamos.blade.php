@extends('base')

@section('content')

    <div class="row">

        <div class="container">

            <div class="content">
                <h2>
                    Reclamos
                    <span class="text-muted">
                        / Cliente: {!! $cliente->full_name !!}
                    </span>
                </h2>

                @include('reclamos.partials.navbar')

                <div class="col-lg-4">

                    <ul>
                        <li class="list-group-item">
                            <small class="text-muted">Cliente</small><br>
                            {!! $cliente->full_name !!}
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Reclamos</small><br>
                            <ul class="list-unstyled">
                                @foreach($reclamos as $reclamo)
                                    <li>
                                        <a class="{!! (isset($reclamoFecha) && $reclamoFecha->id == $reclamo->id)? 'bg-info' : '' !!}" href="{{ route('reclamos.show.clientes',  ['id' => $cliente->id, 'reclamoFecha' => $reclamo->id]) }}">
                                            <i class="fa fa-thumbs-o-down"></i>
                                            {!! $reclamo->created_at !!}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    </ul>

                </div>

                <div class="col-lg-8">

                    @if(isset($reclamoFecha))

                    <div class="row">

                        @include('reclamos.partials.panel-reclamo')

                    </div>

                    @endif

                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        $('#editarReclamo').click(function () {
            $('#descripcion').hide();
            $('#formDescripcion').show();
        });

        $('#cancelarEdicion').click(function () {
            $('#descripcion').show();
            $('#formDescripcion textarea').val('{!! $reclamoFecha->descripcion !!}');
            $('#formDescripcion').hide();
        });

    </script>

@endsection
