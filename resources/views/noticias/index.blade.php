@extends('noticias.base')

@section('titulo')

    <h2>Noticias</h2>

@endsection

@section('contenido')

        @permission('crear.noticia')

            <div class="card alert">
                <div class="card-header pr">
                    <h3>Agregar Nueva Noticia</h3>
                </div>
                <div class="card-body">
                    @include('noticias.partials.formulario-crear-noticia')
                </div>
            </div>

        @endpermission

        @permission('listado.noticia')

            <div class="card alert">
                <div class="card-header pr">
                    <h3>Noticias Disponibles</h3>
                </div>
                <div class="card-body">
                    @include('noticias.partials.noticias-listado')
                </div>
            </div>

        @endpermission

@endsection

@section('js')

    <script src="{{ asset('plugins/ckeditor/ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script type="text/javascript">ClassicEditor.create( document.querySelector( '#ckeditor' ) );</script>
    <script>

        $('.select2b').select2({
            multiple: true
        });

    </script>

@endsection