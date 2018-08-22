@extends('clientes.base')

@section('titulo')

    <h2>Clientes<span class="text-muted"> / Importación desde Excel</span></h2>

@endsection

@section('contenido')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Seleccione un archivo Excel de su disco duro</h3>
        </div>
        <div class="panel-body">

            {!! Form::open(['method' => 'post', 'url' => route('clientes.importacion.subir'), 'files' => 'true']) !!}

                <div class="form-group">
                    {!! Form::file('excel_file') !!}
                </div>
                {!! Form::submit('Aceptar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('clientes.index') }}" class="btn btn-default">Cancelar</a>

            {!! Form::close() !!}

        </div>
    </div>

@endsection