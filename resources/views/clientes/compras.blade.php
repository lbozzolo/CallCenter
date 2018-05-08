@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>
                    {!! $cliente->full_name !!}
                    <span class="text-muted"> / Compras</span>
                </h2>

                @include('clientes.partials.navbar')


                <div class="col-lg-6 col-md-6">

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

                </div>


                @if(isset($compras))
                <div class="col-lg-12 col-md-12">


                    <table class="table" id="table-compras">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Producto</th>
                                <th>Categorías</th>
                                <th>Vendedor</th>
                                <th>Fecha</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($compras as $venta)

                            <tr>
                                <td>
                                    <label class="label label-default estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! $venta->estado->nombre !!}</label>
                                </td>
                                <td>{!! $venta->producto->nombre !!}</td>
                                <td>
                                    @foreach($venta->producto->categorias as $categoria)
                                        <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                                    @endforeach
                                </td>
                                <td>{!! $venta->user->full_name !!}</td>
                                <td>{!! $venta->fecha_creado !!}</td>
                                <td class="text-center"><a href="{{ route('ventas.show.cliente.ventas', $venta->id) }}"><i class="fa fa-info-circle"></i> </a></td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5">Este cliente no tiene ninguna compra registrada con ese estado</td>
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
                    $('#table-compras').DataTable({
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


