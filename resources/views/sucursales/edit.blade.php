@extends('sucursales.base')

@section('titulo')

    <h2>
        Sucursales<span class="text-muted">/ editar / {!! $sucursal->nombre !!}</span>

    </h2>

@endsection

@section('contenido')

    {!! Form::model($sucursal, ['method' => 'put', 'url' => route('sucursales.update', $sucursal->id), 'class' =>'form']) !!}

    <div class="col-lg-6 col-md-6">

        <div class="card card-default">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            @if($sucursal->estado == 0)
                                <span class="label label-danger pull-right">inactiva</span>
                            @elseif($sucursal->estado == 1)
                                <span class="label label-success pull-right">activa</span>
                            @endif
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('direccion', 'Dirección') !!}
                            {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('telefono', 'Teléfono') !!}
                            {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('estado', 'Estado') !!}
                            {!! Form::select('estado_id', [1 => 'Activa', 0 => 'Inactiva'], $sucursal->estado, ['class' => 'form-control select2']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-default">Cancelar</a>

    </div>

    {!! Form::close() !!}

@endsection


@section('js')

    <script>

        $('.datepicker').datepicker({
            format: 'd/mm/yyyy'
        });

        $('.select22').select2({multiple: true});


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
    <script type="text/javascript">ClassicEditor.create( document.querySelector( '#ckeditor' ) );</script>

@endsection