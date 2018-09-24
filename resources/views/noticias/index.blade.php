@extends('noticias.base')

@section('titulo')

    <h2>Noticias</h2>

@endsection

@section('contenido')


    <div class="row">
        <div class="col-md-6">
            <div class="card alert">
                <div class="card-header pr">
                    <h3>Agregar Nueva Noticia</h3>
                </div>
                <div class="panel-body">
                    @include('noticias.partials.formulario-crear-noticia')
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card alert">
                <div class="card-header pr">
                    <h3>Noticias Disponibles</h3>
                </div>
                    @include('noticias.partials.noticias-listado')
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('plugins/ckeditor/ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script type="text/javascript">ClassicEditor.create( document.querySelector( '#ckeditor' ) );</script>
@endsection