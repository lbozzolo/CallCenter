@extends('ventas.base')

@section('titulo')

    <h2>Ventas<span class="text-muted"> / Reclamos</span> </h2>

@endsection


@section('contenido')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <h3>
                        #{!! $venta->id !!}
                        <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
                        Operador: {!! $venta->user->full_name !!}
                    </h3>
                </div>
                <div class="col-lg-3 col-md-12 text-right">
                    <span class="text-primary" style="font-size: 2.5em">${!! $venta->importe_total !!}</span>
                    @if($venta->has_cuotas)
                        <div class="text-muted">
                            {!! $venta->has_cuotas->cuota_cantidad !!} cuotas de <span class=" text-primary">${!! $venta->valor_cuota !!}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-body">
                    <ul class="list-unstyled list-inline listado">
                        <li class="list-group-item">Cliente: {!! $venta->cliente->full_name !!}</li>
                        <li class="list-group-item">Fecha de venta: {!! $venta->fecha_creado !!}</li>
                        <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                        <li class="list-group-item">
                            @permission('ver.venta')
                            <a href="{{ route('ventas.show', $venta->id) }}" style="color:cyan">Ver venta</a>
                            @endpermission
                        </li>
                        <li class="list-group-item">
                            @permission('crear.reclamo')
                            <a href="{{ route('reclamos.create', $venta->id) }}" style="color: cyan">Generar un nuevo reclamo</a>
                            @endpermission
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <h3>Reclamos abiertos</h3>
            <ul>
            @foreach($venta->reclamos as $reclamo)

                @if($reclamo->estado_id == 1)
                <li>@include('ventas.partials.reclamo')</li>
                @endif

            @endforeach
            </ul>
            @if(!$venta->reclamosPorEstado('abierto')->count())

                <div class="panel panel-barra text-muted">No hay ningún reclamo abierto</div>

            @endif
        </div>
        <div class="col-lg-6 col-md-12">
            <h3>Reclamos cerrados</h3>
            <ul>
            @foreach($venta->reclamos as $reclamo)

                @if($reclamo->estado_id == 2)
                    <li>@include('ventas.partials.reclamo')</li>
                @endif

            @endforeach
            </ul>
            @if(!$venta->reclamosPorEstado('cerrado')->count())

                <div class="panel panel-barra text-muted">No hay ningún reclamo cerrado</div>

            @endif
        </div>
    </div>



@endsection



@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>

    <script>

        $('.editar-descripcion').click(function () {
            var id = $(this).attr('data-id');
            $('#formDescripcion' + id).show();
            $('#titulo' + id).hide();
            $('#descripcion' + id).hide();
        });

        $('.cancelar-edicion').click(function () {
            var id = $(this).attr('data-id');
            $('#descripcion' + id).show();
            $('#formDescripcion' + id + 'textarea').val('{!! (isset($reclamo))? $reclamo->descripcion : '' !!}');
            $('#inputTitulo' + id).val('{!! (isset($reclamo))? $reclamo->titulo : '' !!}');
            $('#formDescripcion' + id).hide();
            $('#titulo' + id).show();
            $('#descripcion' + id).show();
        });


        $(document).ready(function() {
            $('#table-enable-users').DataTable({
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

        });


    </script>

@endsection