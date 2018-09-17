@extends('clientes.base')

@section('titulo')

    <h2>
        {!! $cliente->full_name !!}
        <span class="text-muted">/ Intereses</span>
    </h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-heading">
                    <h3 class="card-title">Listado de intereses</h3>
                </div>
                <div class="card-body">
                    <p>Todavía no hay ningún interés relacionado con este cliente.</p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>



    </script>

@endsection
