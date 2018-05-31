<div class="panel panel-default">
    <div class="panel-heading">
        <small class="pull-right label label-default">stock: {!! ($producto->stock)? $producto->stock : '' !!}</small>
        <h3 class="panel-title">Producto</h3>
    </div>
    <div class="panel-body">

        <ul class="list-unstyled">
            <li class="list-group-item">
                @foreach($producto->categorias as $categoria)
                    <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                @endforeach
                <br>
                <span class="text-info pull-right" style="font-size: 2em">{!! ($producto->precio)? "$".$producto->precio : '' !!}</span>
                <h4>{!! $producto->nombre !!}|{!! ($producto->marca)? $producto->marca->nombre : '' !!}</h4>
            </li>
            <li class="list-group-item">
                <strong>Descripción</strong><br>
                {!! ($producto->descripcion)? $producto->descripcion : '' !!}
            </li>
            <li class="list-group-item">
                <div>Fecha de inicio: {!! ($producto->fecha_inicio)? $producto->fecha_inicio_formatted : '' !!}</div>
                <div>Fecha de finalización: {!! ($producto->fecha_finalizacion)? $producto->fecha_finalizacion_formatted : '' !!}</div>
            </li>
            <li class="list-group-item">
                <strong>Medida</strong>
                {!! ($producto->cantidad_medida)? $producto->cantidad_medida : '' !!}
                {!! ($producto->unidadMedida)? $producto->unidadMedida->nombre : '' !!}
            </li>
            @if($producto->prospecto)
                <li class="list-group-item">
                <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseComponentes" aria-expanded="false" aria-controls="collapseCategoria">
                    <span class="text-primary">Prospecto (componentes)</span>
                    {{--<i class="fa fa-caret-down "></i>--}}
                </span>
                    <div class="list-unstyled collapse"  id="collapseComponentes" aria-labelledby="headingOne" data-parent="#accordion">
                        {!! $producto->prospecto !!}
                    </div>
                </li>
            @endif
            <li class="list-group-item">

                    {!! Form::label('observaciones', 'Observaciones / formas de uso') !!}
                    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '6']) !!}

            </li>
            @if(count($producto->etapas) > 0)
                <li class="list-group-item">
                    Etapas:
                    @foreach($producto->etapas as $etapa)
                        <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $etapa->nombre !!}</label>
                    @endforeach
                </li>
            @endif
            @if($producto->institucion_id)
                <li class="list-group-item">
                    Institución: {!! ($producto->institucion_id)? $producto->institucion->nombre : '<em class="text-muted">(sin datos)</em>' !!}
                </li>
            @endif
        </ul>

    </div>
</div>