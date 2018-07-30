@extends('clientes.base')

@section('titulo')

    <h2>
        Llamada
        <span class="text-muted">/ Cliente: {!! $cliente->full_name !!}</span>
    </h2>

@endsection

@section('contenido')

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <span class="text-muted">Listado de reclamos</span><hr>
                    <ul class="list-unstyled">
                        @forelse($reclamos as $rec)
                            <li style="{!! (isset($reclamo) && $reclamo->id == $rec->id)? 'background-color: ghostwhite; color:white' : '' !!}" class="list-group-item">
                            @permission('ver.reclamos.cliente')
                                <a  href="{{ route('clientes.show.reclamo',  ['id' => $cliente->id, 'idReclamo' => $rec->id]) }}">
                                    {!! $rec->titulo !!}
                                </a>
                            @elsepermission
                                {!! $rec->titulo !!}
                            @endpermission
                                <small class="text-muted">({!! $rec->fecha_creado !!})</small>
                            </li>
                        @empty

                            <p class="col-lg-12">No hay ningún reclamo realizado por este cliente</p>

                        @endforelse
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    @if(isset($llamada))

                    @permission('ver.reclamos.cliente')
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Llamada
                                    <span class="text-muted">(id #{!! $llamada->id !!})</span>
                                    - Reclamo
                                    <span class="text-muted">(id #{!! $llamada->reclamo->id !!})</span>
                                    - {!! $llamada->reclamo->titulo !!}
                                </h3>
                            </div>
                            <div class="panel-body">

                                @include('clientes.partials.panel-llamada')

                            </div>
                        </div>
                    @endpermission

                    @endif
                </div>
            </div>
        </div>

@endsection



