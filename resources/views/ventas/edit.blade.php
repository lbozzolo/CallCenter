@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="card card-default">
                            <div class="card-heading">
                                <h2 class="card-title">Editar venta #{!! $venta->id !!}</h2>
                            </div>
                            <div class="card-body">
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
                                <a href="{{ URL::previous() }}" class="btn btn-default">Cerrar</a>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
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
