@extends('productos.base')

@section('css')
    <style type="text/css">

        input::-webkit-calendar-picker-indicator{
            display: none;
        }

    </style>
@endsection

@section('titulo')
    <h2>Productos<span class="text-muted"> / Agregar nuevo producto</span></h2>
@endsection

@section('contenido')

    <div class="card default">
        <div class="panel-body">

            {!! Form::open(['method' => 'post', 'url' => route('productos.store'), 'class' =>'form', 'autocomplete' => 'off']) !!}
            <div class="row">
                <div class="col-lg-6">
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
                        {!! Form::label('estado_id', 'Activo') !!}
                        {!! Form::radio('estado_id', $estados[0], true) !!}
                        {!! Form::label('estado_id', 'Inactivo') !!}
                        {!! Form::radio('estado_id', $estados[1], false) !!}
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
                        {!! Form::number('precio', null, ['class' => 'form-control', 'min' => '0']) !!}
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                {!! Form::label('stock', 'Stock') !!}
                                {!! Form::number('stock', null, ['class' => 'form-control', 'min' => '0']) !!}
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
                        {!! Form::label('marca_id', 'Marca') !!}
                        {!! Form::select('marca_id', $marcas, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('referencia', 'Referencia') !!}
                        {!! Form::text('referencia', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('institucion_id', 'Institución') !!}
                        {!! Form::select('institucion', $instituciones, null, ['class' => 'form-control select2']) !!}
                        <small class="help-block">Solamente en el caso de que corresponda.</small>
                    </div>
                    {!! Form::submit('Agregar', ['class' => 'btn btn-primary']) !!}

                </div>

            </div>

            {!! Form::close() !!}


        </div>

    </div>

@endsection


@section('js')

    <script>

        $('.datepicker').datepicker({
            format: 'd/m/yyyy',
            language: 'es',
            todayHighLight: true
        });



        $('.select2').select2({multiple: true});
        $('.select22').select2();

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
