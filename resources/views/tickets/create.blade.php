@extends('tareas.base')

@section('titulo')

    <h2>Soporte / Crear ticket</h2>

@endsection

@section('contenido')

    <div class="card">
        <div class="card-header">
            <ul class="list-inline">
                <li><h3>Crear un nuevo ticket</h3></li>
                <li><a href="{{ route('tickets.mis.tickets') }}" style="color:cyan">Ver mis tickets</a></li>
            </ul>
        </div>
        <div class="card-body">

            {!! Form::open(['url' => route('tickets.store'), 'method' => 'post', 'class' => 'form']) !!}

            <div class="row">

                <div class="col-lg-10">
                    <div class="form-group">
                        {!! Form::label('subject', 'Indique el asunto del ticket') !!}
                        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="form-group">
                        {!! Form::label('modulo', 'Seleccione el módulo') !!}
                        {!! Form::select('modulo', $modulos, null, ['class' => 'form-control select2b', 'placeholder' => '']) !!}
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="form-group">
                        {!! Form::label('body', 'Descripción') !!}
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '15']) !!}
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        {!! Form::label('level_id', 'Indique el nivel de criticidad') !!}
                        <ul class=" listado">
                            <li class="list-group-item">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('level_id', '1', true) !!}
                                        <span class="text-success">Bajo</span>
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('level_id', '2', false) !!}
                                        <span class="text-warning">Medio</span>
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="radio">
                                    <label>
                                        {!! Form::radio('level_id', '3', false) !!}
                                        <span class="text-danger">Alto</span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Enviar ticket</button>
                    </div>
                </div>

            </div>


            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('plugins/ckeditor/ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script type="text/javascript">ClassicEditor.create( document.querySelector( '#ckeditor' ) );</script>

@endsection