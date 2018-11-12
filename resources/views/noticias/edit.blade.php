@extends('noticias.base')

@section('css')

    <style>
        .ck-editor__editable {
            min-height: 400px;
        }
        .select2-selection__choice, .select2-selection__choice, .select2-results__option{
            color: black;
        }
    </style>

@endsection

@section('titulo')

    <h2>Noticias</h2>

@endsection

@section('contenido')

    @permission('editar.noticia')
    @include('noticias.partials.formulario-editar-noticia')
    @endpermission

@endsection

@section('js')

    <script src="{{ asset('plugins/ckeditor/ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script type="text/javascript">ClassicEditor.create( document.querySelector( '#ckeditor' ) );</script>
    <script>

        var rolesActuales =  [<?php echo '"'.implode('","', $noticia->roles_ids).'"' ?>];

        $('.select2b').select2({
            multiple: true
        }).select2('val', rolesActuales);

    </script>

@endsection

