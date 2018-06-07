@extends('productos.base')

@section('titulo')

    <h2>Crear nuevo producto</h2>

@endsection

@section('contenido')

    <div class="container">
        <div class="content">
            <h2>Crear nuevo producto</h2>
            <hr>
            <div class="col-lg-6 col-md-6">
                {!! Form::open(['method' => 'post', 'url' => route('productos.store'), 'class' =>'form']) !!}

                <div class="form-group">
                    {!! Form::label('categoria_id[]', 'Categoría') !!}
                    <select name="categoria_id[]" class="form-control select2" id="categorias">
                        <option value=""></option>
                        @foreach($categorias as $key => $value)
                            <option value="{!! $key !!}">{!! $value !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="subcategorias" style="display: none"></div>
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripción') !!}
                    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group panel-body" id="divEstado">
                    @foreach($estados as $key => $value)
                        <label class="radio-inline">
                            <input type="radio" name="estado_id" value="{!! $key !!}" >
                            {!! $value !!}
                        </label>
                    @endforeach
                </div>
                <div class="form-group" id="fechasInicioFinalizacion" >
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('fecha_inicio', 'Fecha de inicio') !!}
                            {!! Form::text('fecha_inicio', null, ['class' => 'form-control datepicker', 'id' => 'fechaInicio']) !!}
                        </div>
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('fecha_finalizacion', 'Fecha de finalización') !!}
                            {!! Form::text('fecha_finalizacion', null, ['class' => 'form-control datepicker', 'id' => 'fechaFinalizacion']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('unidad_medida_id', 'Unidad de medida') !!}
                            {!! Form::select('unidad_medida_id', $unidadesMedida,  null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                        </div>
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('cantidad_medida', 'Cantidad') !!}
                            {!! Form::number('cantidad_medida', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    {!! Form::label('precio', 'Precio') !!}
                    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('stock', 'Stock') !!}
                            {!! Form::number('stock', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('alerta_stock', 'Alerta stock') !!}
                            {!! Form::number('alerta_stock', null, ['class' => 'form-control']) !!}
                            <small class="help-block">Ingrese el número mínimo de productos en stock para lanzar una alerta.</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('referencia', 'Referencia') !!}
                    {!! Form::text('referencia', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('institucion_id', 'Institución') !!}
                    {!! Form::select('institucion', $instituciones, null, ['class' => 'form-control']) !!}
                    <small class="help-block">Solamente en el caso de que corresponda.</small>
                </div>
                {!! Form::submit('Crear producto', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('productos.index') }}" class="btn btn-default">Cerrar</a>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection


@section('js')

    <script>

        $('.datepicker').datepicker({
            format: 'd/mm/yyyy'
        });

        $('.select2').select2({multiple: true});

        /* $('#divEstado input').click(function(){

             if($(this).val() === 'Activo'){
                 $('#fechaInicio').removeAttr('disabled');
                 $('#fechaFinalizacion').removeAttr('disabled');
             }
             if($(this).val() === 'Inactivo'){
                 $('#fechaInicio').attr('disabled', true);
                 $('#fechaFinalizacion').attr('disabled', true);
                 $('#fechaInicio').val('');
                 $('#fechaFinalizacion').val('');
             }

         });*/

        $( '#categorias' ).change(function( event ) {
            event.preventDefault();

            var categoria = $(this);

            $.ajax({
                type: 'GET',
                url: 'categoria/subcategoria',
                data: categoria.serialize(),
                dataType: 'json',
                success: function( resp ) {
                    console.log(resp);

                    var subcategorias = $('#subcategorias');
                    if(!jQuery.isEmptyObject(resp)){

                        subcategorias.empty();
                        subcategorias.show();

                        var html;
                        html = '<label for="subcategoria_id[]">Subcategorías</label>';
                        html += '<select name="subcategoria_id[]" class="form-control select2">';
                        html += '<option></option>';
                        $.each(resp, function(i, d) {

                            html += '<option value="' + i + '">' + d + '</option>';

                        });
                        html += '</select>';

                        subcategorias.append(html);
                        $('.select2').select2({multiple: true});

                    }else{

                        subcategorias.empty();

                    }

                }
            });

        });

    </script>

@endsection
