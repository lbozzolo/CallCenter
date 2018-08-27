<div class="card card-default">
    <div class="card-heading" style="cursor: pointer" data-toggle="collapse" data-target="#collapseProducto" aria-expanded="false" aria-controls="collapseCategoria">
        <small class="pull-right label label-default">stock: {!! ($producto->stock)? $producto->stock : '' !!}</small>
        <h3 class="card-title">
            Producto: {!! ucfirst($producto->nombre) !!} ({!! ($producto->marca)? $producto->marca->nombre : '' !!})
            <i class="fa fa-caret-down"></i>
        </h3>

    </div>
    <div class="card-body " id="collapseProducto" aria-labelledby="headingOne" data-parent="#accordion">

            <div>
                @foreach($producto->categorias as $categoria)
                    <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                @endforeach
                <br>
                <span class="text-info pull-right" style="font-size: 2em">{!! ($producto->precio)? "$ ".$producto->precio : '' !!}</span>
                <h4>{!! ucfirst($producto->nombre) !!}, {!! ($producto->marca)? $producto->marca->nombre : '' !!}</h4>
            </div>
            <div>
                <strong>Descripción</strong><br>
                {!! ($producto->descripcion)? $producto->descripcion : '' !!}
            </div>
            <hr>
            <div>
                <strong>Medida</strong>
                {!! ($producto->cantidad_medida)? $producto->cantidad_medida : '' !!}
                {!! ($producto->unidadMedida)? $producto->unidadMedida->nombre : '' !!}
            </div>
            @if($producto->prospecto)
                <div>
                    <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseComponentes" aria-expanded="false" aria-controls="collapseComponentes">
                        <span class="text-primary">Prospecto (componentes)</span>
                        {{--<i class="fa fa-caret-down "></i>--}}
                    </span>
                    <div class="list-unstyled collapse"  id="collapseComponentes" aria-labelledby="headingOne" data-parent="#accordion">
                        {!! $producto->prospecto !!}
                    </div>
                </div>
            @endif
            <div>
                {!! Form::label('observaciones', 'Observaciones / formas de uso') !!}
                {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '6']) !!}
            </div>
            @if(count($producto->etapas) > 0)
                <div>
                    Etapas:
                    @foreach($producto->etapas as $etapa)
                        <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $etapa->nombre !!}</label>
                    @endforeach
                </div>
            @endif
            @if($producto->institucion_id)
                <div>
                    Institución: {!! ($producto->institucion_id)? $producto->institucion->nombre : '<em class="text-muted">(sin datos)</em>' !!}
                </div>
            @endif


    </div>
</div>