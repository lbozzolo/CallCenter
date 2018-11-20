@extends('base')

@section('content')


            <div class="page-header">
                <div class="page-title">
                    <h1 style="color:white">Bienvenido, <span>{!! Auth::user()->fullname !!}</span>.</h1>
                </div>
            </div>

    <!-- /# row -->
    <div id="main-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-eight">
                        <div class="stat-header">
                            <div class="header-title pull-left">Clientes del Sistema</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-up color-success"></i>
                                <span class="stat-digit">{!! $clientes !!}</span>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-eight">
                        <div class="stat-header">
                            <div class="header-title pull-left">Asignaciones Actuales</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-up color-success"></i>
                                <span class="stat-digit">{!! $asignacionesActuales !!}</span>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-eight">
                        <div class="stat-header">
                            <div class="header-title pull-left">Reclamos Diarios</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-down color-danger"></i>
                                <span class="stat-digit"> 58</span>
                            </div>
                            <div class="pull-right">
                                <span class="progress-stats">20%</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning w-70" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">20% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-eight">
                        <div class="stat-header">
                            <div class="header-title pull-left">Ventas Totales</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-down color-danger"></i>
                                <span class="stat-digit">{!! $ventas !!}</span>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-eight">
                        <div class="stat-header">
                            <div class="header-title pull-left">Ventas del mes</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-up color-success"></i>
                                <span class="stat-digit">{!! $ventasDelMes !!}</span>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-eight">
                        <div class="stat-header">
                            <div class="header-title pull-left">Llamadas Semanales</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-up color-success"></i>
                                <span class="stat-digit"> 3350</span>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-eight">
                        <div class="stat-header">
                            <div class="header-title pull-left">Reclamos Semanales</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-down color-danger"></i>
                                <span class="stat-digit"> 158</span>
                            </div>
                            <div class="pull-right">
                                <span class="progress-stats">20%</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning w-70" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">20% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-eight">
                        <div class="stat-header">
                            <div class="header-title pull-left">Ventas Semanales</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-down color-danger"></i>
                                <span class="stat-digit"> 6235</span>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
