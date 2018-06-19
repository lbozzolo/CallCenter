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

                    <div class="col-lg-4">
                    {!! Form::open(['url' => route('ventas.choose.tag'), 'method' => 'get']) !!}
                        <div class="input-group input-group-sm">
                            {!! Form::select('tag', $tags, null,['class' => 'form-control']) !!}
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
                </li>
                {{--<li><a href="{{ route('ventas.index') }}" class="{{ (Request::is('ventas') ? 'navbar-item-selected' : '') }}"><small>Todas</small></a></li>
                <li><a href="{{ route('ventas.index', 'iniciada') }}" class="{{ (Request::is('ventas/iniciada') ? 'navbar-item-selected' : '') }}"><small>Iniciadas ({!! $total['iniciada'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'cancelada') }}" class="{{ (Request::is('ventas/cancelada') ? 'navbar-item-selected' : '') }}"><small>Canceladas ({!! $total['cancelada'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'auditable') }}" class="{{ (Request::is('ventas/auditable') ? 'navbar-item-selected' : '') }}"><small>Auditables ({!! $total['auditable'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'confirmada') }}" class="{{ (Request::is('ventas/confirmada') ? 'navbar-item-selected' : '') }}"><small>Confirmadas ({!! $total['confirmada'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'rechazada') }}" class="{{ (Request::is('ventas/rechazada') ? 'navbar-item-selected' : '') }}"><small>Rechazadas ({!! $total['rechazada'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'cobrada') }}" class="{{ (Request::is('ventas/cobrada') ? 'navbar-item-selected' : '') }}"><small>Cobradas ({!! $total['cobrada'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'facturada') }}" class="{{ (Request::is('ventas/facturada') ? 'navbar-item-selected' : '') }}"><small>Facturadas ({!! $total['facturada'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'enviada') }}" class="{{ (Request::is('ventas/enviada') ? 'navbar-item-selected' : '') }}"><small>Enviadas ({!! $total['enviada'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'entregado') }}" class="{{ (Request::is('ventas/entregado') ? 'navbar-item-selected' : '') }}"><small>Entregadas ({!! $total['entregado'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'noentregado') }}" class="{{ (Request::is('ventas/noentregado') ? 'navbar-item-selected' : '') }}"><small>No entregadas ({!! $total['noentregado'] !!})</small></a></li>
                <li><a href="{{ route('ventas.index', 'devuelto') }}" class="{{ (Request::is('ventas/devuelto') ? 'navbar-item-selected' : '') }}"><small>Devueltas ({!! $total['devuelto'] !!})</small></a></li>--}}
            </ul>
        </div>
    </div>
</nav>
