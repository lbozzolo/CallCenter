@extends('productos.base')

@section('titulo')

    <h2></h2>

@endsection

@section('css')
    <style type="text/css">

        input::-webkit-calendar-picker-indicator{
            display: none;
        }

        .datepicker-days  {
            background: white !important;
        }
        .datepicker-switch{
            background: gray !important;
            color: white !important;
        }
        .prev, .next{
            background: lightgrey !important;
            color: white !important;
        }
        .day, .month, .year{
            color: gray !important;
        }
        .active{
            color: white !important;
        }
        .old{
            color: lightgray !important;
        }
        input, .select2{
            background-color: #404a6b !important;
        }

    </style>
@endsection

@section('contenido')

    
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card alert">
                <div class="card-header pr">

        <h3>Editar marca: {!! $marca->nombre !!}</h3>

        {!! Form::model($marca, ['method' => 'put', 'url' => route('marcas.update', $marca->id), 'class' => 'form']) !!}

        <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('descripcion', 'Descripción') !!}
            {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
        </div>

        <button type="submit" class="btn btn-warning">Editar Info</button>

        {!! Form::close() !!}

    </div>
</div>
      </div>
      </div>
      </div>

      <div class="row">
    <div class="col-lg-12">
        <div class="footer">
            <p>Smartline @ 2018 - Desarrollado por <a href="http://www.bamdig.com/" target="_new" class="page-refresh">Bamdig.com</a></p>
        </div>
    </div>
</div>
@endsection
