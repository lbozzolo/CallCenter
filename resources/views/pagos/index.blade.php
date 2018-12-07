@extends('pagos.base')

@section('titulo')


    <h2>Formas de Pago</h2>


@endsection


@section('contenido')


    {{--<div class="row">--}}
        {{--<div class="col-lg-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-body">--}}
                    {{--{!! Form::open(['url' => route('formas.pago.store'), 'method' => 'post']) !!}--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-lg-6">--}}
                            {{--<div class="basic-form">--}}
                                {{--<div class="form-group">--}}
                                    {{--{!! Form::label('tarjeta_id', 'Tarjeta') !!}--}}
                                    {{--{!! Form::select('tarjeta_id', $marcasTarjetas, null, ['class' => 'form-control  select2', 'placeholder' => '', 'style' => 'color: white']) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="basic-form">--}}
                                {{--<div class="form-group">--}}
                                    {{--{!! Form::label('banco_id', 'Banco') !!}--}}
                                    {{--{!! Form::select('banco_id', $bancos, null, ['class' => 'form-control  select2', 'placeholder' => '', 'style' => 'color: white']) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="basic-form">--}}
                                {{--<div class="form-group">--}}
                                    {{--{!! Form::label('cuota_cantidad', 'Cuotas') !!}--}}
                                    {{--{!! Form::select('cuota_cantidad', $cuotas, null, ['class' => 'form-control  select2', 'style' => 'color: white']) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-6">--}}
                            {{--<div class="basic-form">--}}
                                {{--<div class="form-group">--}}
                                    {{--{!! Form::label('interes', 'Interés (%)') !!}--}}
                                    {{--{!! Form::number('interes', null, ['class' => 'form-control', 'max' => '100', 'min' => '0']) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="basic-form">--}}
                                {{--<div class="form-group">--}}
                                    {{--{!! Form::label('descuento', 'Descuento (%)') !!}--}}
                                    {{--{!! Form::number('descuento', null, ['class' => 'form-control', 'max' => '100', 'min' => '00']) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<button type="submit" class="btn btn-primary">Agregar</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--{!! Form::close() !!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4">--}}
            {{--<div class="card">--}}
                {{--<div class="card-body">--}}
                    {{--Otras formas de pago--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <h4>Buscar formas de pago registradas</h4>
                </div>
                <div class="card-body">

                    {!! Form::open(['url' => route('formas.choose.card'), 'method' => 'get']) !!}

                        <div class="form-group">
                            {!! Form::select('card_id', $marcasTarjetas, null,['class' => 'form-control select2', 'placeholder' => 'Seleccione la tarjeta...']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::select('banco_id', $bancos, null,['class' => 'form-control select2', 'placeholder' => 'Seleccione un banco...']) !!}
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>

            @permission('crear.forma.de.pago')
            <div class="card alert">
                <div class="card-header pr">
                    <h4>Ingresar nueva forma de pago</h4>
                </div>
                {!! Form::open(['url' => route('formas.pago.store'), 'method' => 'post']) !!}
                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('tarjeta_id', 'Tarjeta') !!}
                        {!! Form::select('tarjeta_id', $marcasTarjetas, null, ['class' => 'form-control  select2', 'placeholder' => '', 'style' => 'color: white']) !!}
                    </div>
                </div>
                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('banco_id', 'Banco') !!}
                        {!! Form::select('banco_id', $bancos, null, ['class' => 'form-control  select2', 'placeholder' => '', 'style' => 'color: white']) !!}
                    </div>
                </div>
                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('cuota_cantidad', 'Cuotas') !!}
                        {!! Form::select('cuota_cantidad', $cuotas, null, ['class' => 'form-control  select2', 'style' => 'color: white']) !!}
                    </div>
                </div>
                
                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('interes', 'Interés (%)') !!}
                        {!! Form::number('interes', null, ['class' => 'form-control', 'max' => '100', 'min' => '0']) !!}
                    </div>
                </div>
                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('descuento', 'Descuento (%)') !!}
                        {!! Form::number('descuento', null, ['class' => 'form-control', 'max' => '100', 'min' => '00']) !!}
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Agregar</button>
                
            </div>
            {!! Form::close() !!}
        </div>
        @endpermission

        @permission('editar.forma.de.pago')
            @if(isset($formaEdit))

            @include('pagos.partials.formulario-edit')

            @endif
        @endpermission


        @permission('listado.forma.de.pago')
        <div class="col-md-8">

            @include('pagos.partials.listado-formas-pago')

        </div>
        @endpermission
    </div>

@endsection

