@extends('reclamos.base')

@section('titulo')

    <h2>Reclamos<span class="text-muted">/ Cliente: {!! $cliente->full_name !!}</span></h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="card">
                <small class="text-muted">Reclamos</small><br>
                <ul class="list-unstyled">
                    @forelse($reclamos as $reclamo)
                        <li>
                            <a class="{!! (isset($reclamoFecha) && $reclamoFecha->id == $reclamo->id)? 'bg-info' : '' !!}" href="{{ route('reclamos.show.clientes',  ['id' => $cliente->id, 'reclamoFecha' => $reclamo->id]) }}">
                                <i class="fa fa-thumbs-o-down"></i>
                                {!! $reclamo->created_at !!}
                            </a>
                        </li>
                    @empty

                        <p class="col-lg-12">No hay ningún reclamo realizado por este cliente</p>

                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12">
            @if(isset($reclamoFecha))

                <div class="row">
                    @include('reclamos.partials.panel-reclamo')
                </div>

            @endif
        </div>
    </div>

@endsection

@section('js')

    <script>

        $('#editarReclamo').click(function () {
            $('#descripcion').hide();
            $('#formDescripcion').show();
            $('#titulo').hide();
        });

        $('#cancelarEdicion').click(function () {
            $('#descripcion').show();
            $('#formDescripcion textarea').val('{!! (isset($reclamoFecha))? $reclamoFecha->descripcion : '' !!}');
            $('#formDescripcion').hide();
            $('#inputTitulo').val('{!! (isset($reclamoFecha))? $reclamoFecha->titulo : '' !!}');
            $('#titulo').show();
        });

    </script>

@endsection
