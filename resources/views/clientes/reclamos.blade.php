@extends('clientes.base')

@section('titulo')

    <h2>
        {!! $cliente->full_name !!}
        <span class="text-muted">/ Reclamos</span>
    </h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card">
                <h4>Listado de reclamos</h4>
                <ul class="list-unstyled">
                    @forelse($reclamos as $rec)
                        <li class="list-group-item">
                            @permission('ver.reclamos.cliente')
                            <a href="{{ route('clientes.show.reclamo',  ['id' => $cliente->id, 'idReclamo' => $rec->id]) }}" class="{!! (isset($reclamo) && $reclamo->id == $rec->id)? 'bg-info' : '' !!}">
                                {!! $rec->titulo !!}
                            </a>
                            @elsepermission
                                {!! $rec->titulo !!}
                            @endpermission
                            <small class="text-muted">({!! $rec->fecha_creado !!})</small>
                        </li>
                    @empty

                        <p class="col-lg-12">No hay ningún reclamo realizado por este cliente</p>

                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12">
            @if(isset($reclamo))

            @permission('ver.reclamos.cliente')

                    @include('clientes.partials.panel-reclamo')

            @endpermission

            @else

                @if(count($reclamos) > 0)
                    <div class="card">
                        <p><i class="fa fa-arrow-circle-left"></i> Seleccione un reclamo del 'Listado de reclamos'</p>
                    </div>
                @endif

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
