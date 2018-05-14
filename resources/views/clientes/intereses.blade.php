@extends('base')

@section('content')

    <div class="row">

        <div class="container">

            <div class="content">

                <div class="row">
                    <div class="col-lg-12">

                        <h2>
                            Intereses
                            <span class="text-muted">
                            / Cliente: {!! $cliente->full_name !!}
                            </span>
                        </h2>

                        @include('clientes.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Listado de intereses</h3>
                            </div>
                            <div class="panel-body">


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>



    </script>

@endsection
