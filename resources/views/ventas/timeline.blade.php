@extends('ventas.base')

@section('css')

    <style type="text/css">

        .dark .timeline::before {
            background-color: dimgray;
        }
        .timeline:before {
            top: 50px;
            bottom: 70px;
        }
        .listado-timeline li {
            background-color: slategray;
            padding: 5px 10px;
            border-radius: 3px;
        }

    </style>

@endsection

@section('titulo')

    <h2>Timeline de la venta</h2>

@endsection

@section('contenido')


            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="card card-default">
                        <div class="card-body">
                            @include('ventas.partials.listado-timeline')
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Información general de la venta #{!! $venta->id !!}</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled listado">
                                <li class="list-group-item">Operador: {!! $venta->user->full_name !!}</li>
                                <li class="list-group-item">
                                    Cliente: {!! $venta->cliente->full_name !!}
                                    <a href="{{ route('clientes.show', $venta->cliente->id) }}" class="btn btn-default btn-xs pull-right">ver</a>
                                </li>
                                <li class="list-group-item">Fecha de venta: {!! $venta->fecha_creado !!}</li>
                                <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                                <li class="list-group-item">Número de guía: {!! ($venta->numero_guia)? $venta->numero_guia : '<small class="text-muted">sin número de guía</small>' !!}</li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>



@endsection

@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>

@endsection

