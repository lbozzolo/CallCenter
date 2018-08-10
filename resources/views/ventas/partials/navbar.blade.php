<nav class="navbar navbar-default">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2" style="padding-top: 10px">
            <ul class="nav navbar-nav">
                <li>
                    <div class="row">
                        @permission('listado.venta')
                        <div class="col-lg-4">
                            {!! Form::open(['url' => route('ventas.choose.tag'), 'method' => 'get']) !!}
                            <div class="input-group input-group-sm">
                                {!! Form::select('tag', $tags, null,['class' => 'form-control', 'placeholder' => 'Seleccione estado...']) !!}
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat" id="btn_search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-lg-1">
                            <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">ver todas</a>
                        </div>
                        @endpermission
                        @permission('crear.venta')
                        <div class="col-lg-2">
                            <a href="{{ route('ventas.seleccion.cliente') }}" class="btn btn-default btn-sm"><i class="fa fa-phone-square text-success"></i> Llamar</a>
                        </div>
                        @endpermission
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
