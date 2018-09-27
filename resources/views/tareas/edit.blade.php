@extends('tareas.base')

@section('titulo')

    <h2>Tareas</h2>

@endsection

@section('contenido')

    @include('tareas.partials.formulario-editar-tarea')

@endsection
