@extends('updateables.base')

@section('titulo')

    <h2>Movimientos</h2>

@endsection

@section('contenido')

    <div class="card">
        <div class="card-body">
            <div class="row">

                @include('updateables.partials.entidades')

            </div>
        </div>
    </div>

@endsection