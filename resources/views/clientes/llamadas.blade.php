@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>
                    {!! $cliente->full_name !!}
                    <span class="text-muted"> / Llamadas</span>
                </h2>

                @include('clientes.partials.navbar')

                {{--<div class="col-lg-6 col-md-6">

                    <p>Filtrar por estado</p>
                    {!! Form::open(['method' => 'get', 'url' => route('clientes.compras.filtrar', $cliente->id), 'class' => 'form']) !!}
                    <div class="form-group">
                        <div class="input-group input-group">
                            <select name="estado" class="form-control">
                                <option>todas</option>
                                @foreach($estadosVentas as $key => $value)
                                    @if($cliente->ventas->where('estado_id', $key)->count() > 0)
                                        <option value="{!! $key !!}">{!! $value !!}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                    {!! Form::submit('filtrar', ['class' => 'btn btn-info btn-flag']) !!}
                                </span>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>--}}


                @if($llamadas->count())
                    <div class="col-lg-12 col-md-12">


                        <table class="table" id="table-llamadas">
                            <thead>
                            <tr>
                                <th>Operador</th>
                                <th>Cliente</th>
                                <th>Resultado</th>
                                <th class="text-center">Venta</th>
                                <th>Archivo</th>
                                <th>Observaciones</th>
                                <th>Fecha</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($llamadas as $llamada)

                                <tr>
                                    <td>
                                        @if($llamada->user)
                                            <a href="{{ route('users.profile', $llamada->user->id) }}">{!! $llamada->user->full_name !!}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($llamada->cliente)
                                            <a href="{{ route('clientes.show', $llamada->cliente->id) }}">{!! $llamada->cliente->nombre !!}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($llamada->resultado)
                                            @if($llamada->resultado->slug == 'rellamar')
                                                <label class="label label-warning">{!! $llamada->resultado->nombre !!}</label>
                                            @elseif($llamada->resultado->slug == 'venta')
                                                <label class="label label-success">{!! $llamada->resultado->nombre !!}</label>
                                            @elseif($llamada->resultado->slug == 'no.venta')
                                                <label class="label label-default">{!! $llamada->resultado->nombre !!}</label>
                                            @elseif($llamada->resultado->slug == 'nuevo')
                                                <label class="label label-primary">{!! $llamada->resultado->nombre !!}</label>
                                            @elseif($llamada->resultado->slug == 'no.responde')
                                                <label class="label label-info">{!! $llamada->resultado->nombre !!}</label>
                                            @elseif($llamada->resultado->slug == 'dato.erroneo')
                                                <label class="label label-danger">{!! $llamada->resultado->nombre !!}</label>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($llamada->venta)
                                            #{!! $llamada->venta->id !!}
                                            <a href="{{ route('ventas.show', $llamada->venta->id) }}"><i class="fa fa-info-circle"></i> </a>
                                        @endif
                                        {{--{!! ($llamada->venta)? $llamada->venta->id : '<small class="text-muted">//</small>' !!}--}}
                                    </td>
                                    <td><a href="">{!! $llamada->url !!}</a></td>
                                    <td>{!! $llamada->observaciones !!}</td>
                                    <td>{!! $llamada->fecha_creado !!}</td>
                                    <td class="text-center">

                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8">No hay registros de ninguna llamada para este cliente</td>
                                </tr>

                            @endforelse
                            </tbody>
                        </table>

                    </div>
                @endif

            </div>
        </div>

        @endsection

        @section('js')

            <script src="{{ asset('js/estados-ventas.js') }}"></script>

            <script>

                $(document).ready(function() {
                    $('#table-llamadas').DataTable({
                        "language": {
                            "lengthMenu": "Mostrar _MENU_ registros por página",
                            "zeroRecords": "No se encontraron resultados",
                            "info": "Mostrando _PAGE_ de _PAGES_",
                            "emptyTable": "Sin datos disponibles",
                            "infoEmpty": "Sin registros",
                            "infoFiltered": "(filtrado de _MAX_ registros totales)",
                            "search": "<i class='fa fa-search'></i> buscar",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        }
                    });
                    $("#div-table-ventas").show();
                    $(".overlay").hide();



                });

            </script>

@endsection


