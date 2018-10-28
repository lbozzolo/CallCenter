@extends('clientes.base')

@section('titulo')

    <h2>Clientes<span class="text-muted"> / Importación desde Excel</span></h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-heading">
                    <h3 class="card-title">Seleccione un archivo Excel de su disco duro</h3>
                </div>
                <div class="card-body">

                    {!! Form::open(['method' => 'post', 'url' => route('clientes.importacion.subir'), 'files' => 'true']) !!}

                    <div class="form-group">
                        {!! Form::file('excel_file', ['class' => 'form-control']) !!}
                    </div>

                    @permission('crear.cliente')
                    <div class="form-group">
                        <p>Descargue su archivo excel si aún no lo tiene.</p>
                        <span class="panel panel-barra">
                        <a href="{{ route('clientes.download.excel') }}" style="color: cyan; padding: 0px 20px">
                        <i class="fa fa-file-excel-o"></i> descargar excel
                    </a>
                    </span>
                    </div>
                    @endpermission

                    <button type="submit" class="btn btn-primary">Aceptar</button>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection