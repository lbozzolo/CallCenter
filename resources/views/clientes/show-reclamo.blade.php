@extends('base')

@section('content')

    <div class="row">

        <div class="container">

            <div class="content">

                <div class="row">
                    <div class="col-lg-12">

                        <h2>
                            Reclamos
                            <span class="text-muted">
                            / Cliente: {!! $cliente->full_name !!}
                            </span>
                        </h2>

                        @include('clientes.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <span class="text-muted">Listado de reclamos</span><hr>
                                        <ul class="list-unstyled">
                                            @forelse($reclamos as $rec)
                                                <li style="{!! (isset($reclamo) && $reclamo->id == $rec->id)? 'background-color: ghostwhite; color:white' : '' !!}" class="list-group-item">
                                                    <a href="{{ route('clientes.show.reclamo',  ['id' => $cliente->id, 'idReclamo' => $rec->id]) }}">
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

@section('js')

    <script>

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
