@extends('base')

@section('content')

    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1 style="color:white">Bienvenido, <span>{!! Auth::user()->fullname !!}</span>.</h1>
                </div>
            </div>
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
                                <span class="stat-digit"> 2158</span>
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
                            <div class="header-title pull-left">Llamadas Diarias</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-up color-success"></i>
                                <span class="stat-digit"> 350</span>
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
                            <div class="header-title pull-left">Ventas Diarias</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-down color-danger"></i>
                                <span class="stat-digit"> 235</span>
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
                            <div class="header-title pull-left">Usuarios del Sistema</div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="stat-content">
                            <div class="pull-left">
                                <i class="ti-arrow-up color-success"></i>
                                <span class="stat-digit"> 15</span>
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



        <!-- /# row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="footer">
                    <p>Smartline @ 2018 - Desarrollado por <a href="#" class="page-refresh">Bamdig.com</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection
