@extends('base')


@section('css')

    <style type="text/css">

        .card {
            min-height: 180px;
        }

    </style>

@endsection

@section('content')


    <div class="page-header">
        <div class="page-title">
            <h1 style="color:white">Bienvenido, <span>{!! Auth::user()->fullname !!}</span>.</h1>
        </div>
    </div>

    <div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-user f-s-22 color-primary border-primary round-widget"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h4>{!! $clientes !!}</h4>
                            <h5>Clientes del Sistema</h5>
                            <span>Nuevos: {!! $clientesNuevos !!}</span><br>
                            <span>Frecuentes: {!! $clientesFrecuentes !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-money f-s-22 color-warning border-warning round-widget"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h4>{!! $ventas !!}</h4>
                            <h5>Ventas Totales</h5>
                            <span>Este mes: {!! $ventasDelMes !!}</span><br>
                            <span>Esta semana: {!! $ventasDeLaSemana !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-alert f-s-22 color-success border-success round-widget"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h4>{!! $reclamos !!}</h4>
                            <h5>Reclamos</h5>
                            <span>Abiertos: {!! $reclamosAbiertos !!}</span><br>
                            <span>Cerrados: {!! $reclamosCerrados !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-headphone-alt f-s-22 border-danger color-danger round-widget"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h4>{!! $usuarios !!}</h4>
                            <h5>Usuarios del Sistema</h5>
                            <span>Habilitados: {!! $usuariosHabilitados !!}</span><br>
                            <span>Deshabilitados: {!! $usuariosDeshabilitados !!}</span><br>
                            <span>Nuevos: {!! $usuariosNuevos !!}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-bag f-s-22 color-muted border-muted round-widget"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h4>{!! $productos !!}</h4>
                            <h5>Productos</h5>
                            <span>Activos: {!! $productosActivos !!}</span><br>
                            <span>Inactivos: {!! $productosInactivos !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-money f-s-22 color-warning border-warning round-widget"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h4>${!! $facturacion !!}</h4>
                            <h5>Facturación</h5>
                            <span>Facturadas: ${!! $facturacionFacturadas !!}</span><br>
                            <span>Entregadas: ${!! $facturacionEntregadas !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-comment-alt f-s-22 color-warning border-warning round-widget"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h4>{!! $noticias !!}</h4>
                            <h5>Noticias</h5>
                            <span>Activas: {!! $noticiasActivas !!}</span><br>
                            <span>Inactivas: {!! $noticiasInactivas !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-write f-s-22 color-success border-success round-widget"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h4>{!! $asignacionesActuales !!}</h4>
                            <h5>Tareas Asignadas</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

@endsection
