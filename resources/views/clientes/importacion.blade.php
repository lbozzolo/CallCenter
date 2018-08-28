@extends('clientes.base')

@section('titulo')

    <h2>Clientes<span class="text-muted"> / Importación desde Excel</span></h2>

@endsection

@section('contenido')

    <div class="card card-default">
        <div class="card-heading">
            <h3 class="card-title">Seleccione un archivo Excel de su disco duro</h3>
        </div>
        <div class="card-body">

            {!! Form::open(['method' => 'post', 'url' => route('clientes.importacion.subir'), 'files' => 'true']) !!}

                <div class="form-group">
                    {!! Form::file('excel_file') !!}
                </div>

                <button type="submit" class="btn btn-primary">Aceptrar</button>

            {!! Form::close() !!}

        </div>
    </div>

@endsection