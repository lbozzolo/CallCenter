@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>IMÁGENES</h2>


                {{--@include('productos.partials.navbar')--}}


                <div class="col-lg-5">

                    <h3>Imágenes de productos</h3>
                    <ul class="list-inline">

                        @foreach($imagenesProductos as $imagen)
                            <li>
                                <img src="{{ route('imagenes.ver', $imagen->path) }}" style="object-fit: cover; height: 50px">
                            </li>
                        @endforeach

                    </ul>

                    <h3>Imágenes de usuarios</h3>
                    <ul class="list-inline">

                        @foreach($imagenesUsers as $imagen)
                            <li>
                                <img src="{{ route('imagenes.ver', $imagen->path) }}" style="object-fit: cover; height: 50px">
                            </li>
                        @endforeach

                    </ul>

                </div>
                <div class="col-lg-5 col-lg-offset-1">


                    {{--@include('imagenes.partials.formulario-subir-imagen')--}}


                </div>

            </div>
        </div>
    </div>

@endsection
