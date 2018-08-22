@extends('productos.base')

@section('css')

    <style>
        .ck-editor__editable {
            min-height: 400px;
        }
    </style>

@endsection

@section('titulo')

    <h2>
        Productos
        <span class="text-muted">
                               / editar / {!! $producto->nombre !!}
            @if($producto->marca)
                ({!! $producto->marca->nombre !!})
            @endif
        </span>
    </h2>

@endsection

@section('contenido')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{--<a href="{{ route('productos.show', $producto->id) }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-times"></i> Cerrar</a>--}}
            <h2 class="panel-title">Editar producto - {!! $producto->nombre !!}</h2>
        </div>
        <div class="panel-body">
            <div class="col-lg-6 col-md-6">
                {!! Form::model($producto, ['method' => 'put', 'url' => route('productos.update', $producto->id), 'class' =>'form']) !!}

                <div class="form-group">
                    {!! Form::label('categorias_id[]', 'Categoría') !!}
                    {!! Form::select('categorias_id[]', $categorias, $producto->categorias->lists('pivot.categoria_id')->toArray(),['multiple', 'id' => 'categorias', 'class' => 'select2 form-control']) !!}
                    {{-- <select name="categoria_id[]" class="form-control select2" multiple id="categorias">
                         <option value=""></option>
                         @foreach($categorias as $key => $value)
                             @if(in_array($key, $producto->categorias->lists('pivot.categoria_id')->toArray()))
                                 <option selected value="{!! $key !!}">{!! $value !!}</option>
                             @else
                                 <option value="{!! $key !!}">{!! $value !!}</option>
                             @endif
                         @endforeac
                     </select>--}}
                </div>
                <div class="form-group" id="subcategorias" style="display: none"></div>
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('marca_id', 'Marca') !!}
                    {!! Form::select('marca_id', $marcas, null, ['class' => 'form-control select22', 'placeholder' => '']) !!}
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
                            {!! Form::text('fecha_inicio', $producto->fecha_inicio_formatted, ['class' => 'form-control datepicker', 'id' => 'fechaInicio']) !!}
                        </div>
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('fecha_finalizacion', 'Fecha de finalización') !!}
                            {!! Form::text('fecha_finalizacion', $producto->fecha_finalizacion_formatted, ['class' => 'form-control datepicker', 'id' => 'fechaFinalizacion']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('unidad_medida_id', 'Unidad de medida') !!}
                            {!! Form::select('unidad_medida_id', $unidadesMedida,  null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('cantidad_medida', 'Cantidad') !!}
                            {!! Form::number('cantidad_medida', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
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

            </div>

            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <div class="pull-right">
                        <a href="{{ route('productos.etapas', $producto->id) }}">Configurar etapas</a> |
                        <a href="{{ route('productos.imagenes', $producto->id) }}">Administrar imágenes</a>
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
                <div class="form-group">
                    {!! Form::label('prospecto', 'Prospecto (componentes)') !!}
                    {!! Form::textarea('prospecto', null, ['id'=>'ckeditor', 'class'=>'form-control', 'rows'=>'30', 'cols'=>'80']) !!}
                </div>
                {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}
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


    <script src="{{ asset('plugins/ckeditor/ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script type="text/javascript">

        ClassicEditor.create( document.querySelector( '#ckeditor' ) );



    </script>

@endsection