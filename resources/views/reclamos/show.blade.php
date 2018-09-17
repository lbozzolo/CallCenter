@extends('reclamos.base')

@section('css')

    <style>

        .listado li {
            background-color: #404a6b !important;
            border: 1px solid #193144 !important;
        }

    </style>

@endsection

@section('titulo')

    <h2>
        Reclamos<span class="text-muted"> / {!! ($reclamo->venta && $reclamo->venta->cliente)? $reclamo->venta->cliente->full_name : '' !!} / Producto: {!! ($reclamo->venta && $reclamo->venta->producto)? $reclamo->venta->producto->nombre : '' !!}</span>
    </h2>

@endsection

@section('contenido')


    <div class="card card-primary">
        <div class="card-heading">
            <h3>Listado de reclamos</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">

                    <ul class="list-unstyled listado">
                        @foreach($reclamo->venta->reclamos as $complain)
                            <li class="list-group-item">
                                <a style="display: inline-block; padding: 5px 10px" class="{!! ($reclamoFecha && $reclamoFecha->id == $complain->id)? 'bg-danger' : '' !!}" href="{{ route('reclamos.show',  ['id' => $reclamo->id, 'reclamoFecha' => $complain->id]) }}">
                                    {!! $complain->titulo !!}
                                </a>
                                <small>({!! $complain->fecha_creado !!})</small>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <div class="col-lg-9 col-md-9 col-sm-12" style="border-left: 2px solid #404a6b">
                    @if($reclamoFecha)

                        @include('reclamos.partials.panel-reclamo')

                    @else

                        <div>
                            <i class="fa fa-arrow-left"></i>
                            <small class="text-muted">Seleccione un reclamo de la lista</small>
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
