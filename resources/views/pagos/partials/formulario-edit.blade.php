<div class="col-md-8">
    <div class="card alert">
        
            <h4>Editar forma de pago</h4>
            <ul class="list">
                <li class="h4">
                    {!! $formaEdit->tarjeta->nombre !!} / {!! $formaEdit->banco->nombre !!}
                </li>
                <li>
                    <span class="label label-primary">{!! $formaEdit->cuota_cantidad !!} {!! ($formaEdit->cuota_cantidad == 1)? 'CUOTA' : 'CUOTAS' !!}</span>
                    @if($formaEdit->interes || $formaEdit->descuento)
                    <span class="label label-default">{!! ($formaEdit->interes)? $formaEdit->interes : $formaEdit->descuento !!}% de {!! ($formaEdit->interes)? 'interés' : 'descuento' !!}</span>
                    @endif
                </li>
                @if($formaEdit->ventasAbiertas($formaEdit->id) > 0)
                <li>
                    <p style="padding: 5px 10px; margin-top: 15px" class="bg-danger">
                        Esta Forma de Pago está siendo utilizada actualmente en {!! $formaEdit->ventasAbiertas($formaEdit->id) !!} ventas que aún no han sido cerradas.
                        Tenga en cuenta que si la edita MODIFICARÁ LOS VALORES de dichas ventas.
                    </p>
                </li>
                @endif
            </ul>

        <div class="panel-body">

            {!! Form::model($formaEdit, ['url' => route('formas.pago.update', $formaEdit->id), 'method' => 'put']) !!}

                {!! Form::hidden('tarjeta_id', $formaEdit->marca_tarjeta_id) !!}
                {!! Form::hidden('banco_id', $formaEdit->banco_id) !!}
                {!! Form::hidden('cuota_cantidad', $formaEdit->cuota_cantidad) !!}

                <div class="form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="interes_descuento" id="optionsRadios1" value="interes" {!! ($formaEdit->interes)? 'checked' : '' !!}>
                            Interés
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="interes_descuento" id="optionsRadios2" value="descuento" {!! ($formaEdit->descuento)? 'checked' : '' !!}>
                            Descuento
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('valor', 'Valor') !!}
                    {!! Form::number('valor', ($formaEdit->interes)? $formaEdit->interes : $formaEdit->descuento, ['class' => 'form-control', 'max' => '100', 'min' => '00']) !!}
                </div>

                <div class="form-group ">
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>