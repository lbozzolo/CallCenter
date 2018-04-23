@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>Editar venta #{!! $venta->id !!}</h2>
                <hr>
                <div class="col-lg-6 col-md-6">
                    {!! Form::model($venta, ['method' => 'put', 'url' => route('ventas.update', $venta->id), 'class' =>'form']) !!}

                    <div class="form-group">
                        {!! Form::label('metodo_pago_id', 'Método de pago') !!}
                        {!! Form::select('metodo_pago_id', $metodosPago,  null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('etapa_id', 'Etapa') !!}
                        {!! Form::select('etapa_id', $etapas, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('promocion_id', 'Promoción') !!}
                        {!! Form::select('promocion_id', $promociones, null, ['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-default">Cerrar</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>


        $('.select2').select2({
            multiple: true,
        });

    </script>

@endsection
