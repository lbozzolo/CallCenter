
<div class="row">
    <div class="col-lg-12">

        <ul class="nav navbar-nav">
            <li class="card">

                @permission('listado.venta')
                <div class="col-lg-8">

                    {!! Form::open(['url' => route('ventas.choose.tag'), 'method' => 'get']) !!}
                    <div class="input-group input-group-sm">
                        {!! Form::select('tag', $tags, null,['class' => 'form-control select2', 'placeholder' => 'Seleccione estado...']) !!}
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat" id="btn_search">
                            <i class="fa fa-search"></i>
                        </button>
                        </span>
                    </div>
                    {!! Form::close() !!}

                </div>
                <div class="col-lg-6">

                    <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">ver todas</a>
                    @permission('crear.venta')
                    <a href="{{ route('ventas.seleccion.cliente') }}" class="btn btn-default btn-sm"><i class="fa fa-phone-square text-success"></i> Llamar</a>
                    @endpermission

                </div>
                @endpermission

            </li>
        </ul>

    </div>
</div>