@extends('clientes.base')

@section('titulo')

    <h2>
        {!! $cliente->full_name !!}
        <span class="text-muted"> / Compras</span>
    </h2>

@endsection

@section('contenido')


    @if($cliente->ventas->count())

        <div class="row">
            <div class="col-lg-12 col-md-6">

                <div class="card">
                    <div class="row">
                        <div class="col-lg-4">

                            <p>Filtrar por estado</p>
                            {!! Form::open(['method' => 'get', 'url' => route('clientes.compras.filtrar', $cliente->id), 'class' => 'form']) !!}
                            <div class="form-group">
                                <div class="input-group input-group">
                                    <select name="estado" class="form-control select2">
                                        <option>todas</option>
                                        @foreach($estadosVentas as $key => $value)
                                            @if($cliente->ventas->where('estado_id', $key)->count() > 0)
                                                <option value="{!! $key !!}">{!! $value !!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flag">filtrar</button>
                            </span>
                                </div>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>

            </div>
        </div>



    @if(isset($compras))

        <div class="row">
            <div class="col-lg-12 col-md-12">

                <div class="card">
                    <table class="table" id="table-compras">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Estado</th>
                            <th>Productos</th>
                            <th>Categorías</th>
                            <th>Vendedor</th>
                            <th>Fecha</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($compras as $venta)

                            <tr>
                                <td>{!! $venta->id !!}</td>
                                <td>
                                    <label class="label label-default estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! $venta->estado->nombre !!}</label>
                                </td>
                                <td>
                                    <ul>
                                        @foreach($venta->productos as $producto)
                                            <li>{!! $producto->nombre !!}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @foreach($venta->productos as $producto)
                                        @foreach($producto->categorias as $categoria)
                                            <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>{!! $venta->user->full_name !!}</td>
                                <td>{!! $venta->fecha_creado !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('ventas.show.cliente.ventas', $venta->id) }}" class="btn btn-default btn-xs">detalles </a>
                                    @permission('ver.venta')
                                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-xs">editar venta </a>
                                    @endpermission
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5">Su búsqueda no produjo ningún resultado</td>
                            </tr>

                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    @endif

    @else

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    Todavía no hay ninguna compara registrada por este cliente.
                </div>
            </div>
        </div>

    @endif


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


