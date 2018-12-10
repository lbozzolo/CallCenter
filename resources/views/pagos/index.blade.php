@extends('pagos.base')

@section('titulo')


    <h2>Formas de Pago</h2>


@endsection


@section('contenido')

    <div class="row">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <h4>Buscar formas de pago registradas</h4>
                </div>
                <div class="card-body">

                    {!! Form::open(['url' => route('formas.choose.card'), 'method' => 'get']) !!}

                        <div class="form-group">
                            {!! Form::select('card_id', $marcasTarjetas, (isset($card))? $card->id : null,['class' => 'form-control select2', 'placeholder' => 'Seleccione la tarjeta...']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::select('banco_id', $bancos, (isset($banco))? $banco->id : null,['class' => 'form-control select2', 'placeholder' => 'Seleccione un banco...']) !!}
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>

        @permission('crear.forma.de.pago')

            @include('pagos.partials.formulario-create')

        @endpermission

        </div>

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

