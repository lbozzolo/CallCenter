@extends('pagos.base')

@section('titulo')

    <h2>Formas de pago</h2>

@endsection


@section('contenido')

    <div class="row">

        <div class="col-lg-6">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Nueva forma de pago</h3>
                </div>
                <div class="panel-body">

                    {!! Form::open(['url' => route('formas.pago.store'), 'method' => 'post']) !!}

                        <div class="form-group">
                            {!! Form::label('tarjeta_id', 'Tarjeta') !!}
                            {!! Form::select('tarjeta_id', $marcasTarjetas, null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('cuota_cantidad', 'Cuotas') !!}
                                    {!! Form::number('cuota_cantidad', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('interes', 'Interés') !!}
                                    {!! Form::number('interes', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('descuento', 'Descuento') !!}
                                    {!! Form::number('descuento', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Agregar <i class="fa fa-angle-double-right"></i></button>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>


        </div>

        <div class="col-lg-6">
            <table class="table">
                <thead>
                <tr>
                    <th>Tarjeta</th>
                    <th class="text-center">Cuotas</th>
                    <th class="text-center">Interés</th>
                    <th class="text-center">Descuento</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tarjetas as $tarjeta)
                    @foreach($tarjeta->formasPago as $formasPago)
                        <tr>
                            <td>{!! $tarjeta->nombre !!}</td>
                            <td class="text-center">{!! $formasPago->cuota_cantidad !!}</td>
                            <td class="text-center">{!! ($formasPago->interes)? $formasPago->interes.'%' : '--' !!}</td>
                            <td class="text-center">{!! ($formasPago->descuento)? $formasPago->descuento.'%' : '--' !!}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>

            </table>
        </div>

    </div>

@endsection