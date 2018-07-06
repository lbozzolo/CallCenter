@extends('clientes.base')

@section('titulo')

    <h2>
        Reclamos
        <span class="text-muted">/ Cliente: {!! $cliente->full_name !!}</span>
    </h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <span class="text-muted">Listado de reclamos</span><hr>
                            <ul class="list-unstyled">
                                @forelse($reclamos as $rec)
                                    <li class="list-group-item">
                                        <a href="{{ route('clientes.show.reclamo',  ['id' => $cliente->id, 'idReclamo' => $rec->id]) }}" class="{!! (isset($reclamo) && $reclamo->id == $rec->id)? 'bg-info' : '' !!}">
                                            {!! $rec->titulo !!}
                                        </a>
                                        <small class="text-muted">({!! $rec->fecha_creado !!})</small>
                                    </li>
                                @empty

                                    <p class="col-lg-12">No hay ningún reclamo realizado por este cliente</p>

                                @endforelse
                            </ul>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            @if(isset($reclamo))

                                <div class="row">
                                    @include('clientes.partials.panel-reclamo')
                                </div>

                            @else

                                @if(count($reclamos) > 0)
                                <p><i class="fa fa-arrow-circle-left"></i> Seleccione un reclamo del 'Listado de reclamos'</p>
                                @endif

                            @endif
                        </div>
                    </div>
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
