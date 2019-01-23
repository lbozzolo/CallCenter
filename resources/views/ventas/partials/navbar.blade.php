
<div class="panel panel-barra">

    @permission('listado.venta')

        {!! Form::open(['url' => route('ventas.buscar.entre.fechas'), 'method' => 'post', 'class' => 'form']) !!}
        <div class="row">
            {!! Form::hidden('view', $view) !!}
            <div class="form-group col-lg-2">
                {!! Form::text('fecha_desde', null, ['class' => 'form-control small datepicker', 'placeholder' => 'Desde fecha...', 'autocomplete' => 'off']) !!}
            </div>
            <div class="form-group col-lg-2">
                {!! Form::text('fecha_hasta', null, ['class' => 'form-control datepicker', 'placeholder' => 'Hasta fecha...', 'autocomplete' => 'off']) !!}
            </div>
            <div class="form-group col-lg-3">
                <button type="submit" class="btn btn-primary" style="margin-top: 4px">buscar</button>
                <a href="{{ route($view) }}" style="color: cyan; display: inline-block; padding: 0px 10px; ">ver todas</a>
            </div>
        </div>
        {!! Form::close() !!}

    @endpermission

</div>
