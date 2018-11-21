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
            <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-user f-s-22 color-primary border-primary round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>278</h4>
                                        <h5>Clientes del Sistema</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-money f-s-22 color-warning border-warning round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>37</h4>
                                        <h5>Ventas Diarias</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-alert f-s-22 color-success border-success round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>68748</h4>
                                        <h5>Reclamos</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-headphone-alt f-s-22 border-danger color-danger round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>689</h4>
                                        <h5>Usuarios del Sistema</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-bag f-s-22 color-muted border-muted round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>1278</h4>
                                        <h5>Productos Activos</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-comment-alt f-s-22 color-warning border-warning round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>37</h4>
                                        <h5>Noticias Semanales</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-write f-s-22 color-success border-success round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>68748</h4>
                                        <h5>Tareas Asignadas</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-rss-alt f-s-22 border-danger color-danger round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>689</h4>
                                        <h5>Marcas cargadas</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

        </div>  
    </div>

@endsection
