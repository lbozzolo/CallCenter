
{!! Form::model($venta, ['method' => 'put', 'url' => route('ventas.update', $venta->id), 'class' =>'form']) !!}

<div class="form-group">
    {!! Form::label('metodo_pago_id', 'Método de pago') !!}
    {!! Form::select('metodo_pago_id', $metodosPago,  null, ['class' => 'form-control']) !!}
</div>
@if($etapas->count())
<div class="form-group">
    {!! Form::label('etapa_id', 'Etapa') !!}
    {{--<select name="etapa_id" class="form-control">
       <option></option>
        @foreach($etapas as $key => $value)
            @if($venta->etapa_id == $key)
            <option value="{!! $key !!}" selected>{!! $value !!}</option>
            @else
            <option value="{!! $key !!}">{!! $value !!}</option>
            @endif
        @endforeach
    </select>--}}
    {!! Form::select('etapa_id', $etapas, null, ['class' => 'form-control', 'placeholder' => '']) !!}
</div>
@endif
<div class="form-group">
    {!! Form::label('promocion_id', 'Promoción') !!}
    {!! Form::select('promocion_id', $promociones, null, ['class' => 'form-control']) !!}
</div>
<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>

{!! Form::close() !!}
