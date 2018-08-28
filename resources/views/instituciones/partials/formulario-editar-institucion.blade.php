@section('css')
    <style type="text/css">

        input::-webkit-calendar-picker-indicator{
            display: none;
        }

        .datepicker-days  {
            background: white !important;
        }
        .datepicker-switch{
            background: gray !important;
            color: white !important;
        }
        .prev, .next{
            background: lightgrey !important;
            color: white !important;
        }
        .day, .month, .year{
            color: gray !important;
        }
        .active{
            color: white !important;
        }
        .old{
            color: lightgray !important;
        }
        input, .select2{
            background-color: #404a6b !important;
        }

    </style>
@endsection

<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card alert">
                <div class="card-header pr">
                    <h4>Editar institución</h4>
                </div>

                {!! Form::model($institucion, ['method' => 'put', 'url' => route('instituciones.update'), 'class' => 'form']) !!}

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripcion') !!}
                        {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('direccion', 'Dirección') !!}
                        {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('telefono', 'Teléfono') !!}
                        {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('url', 'URL') !!}
                        {!! Form::text('url', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="basic-form">
                    <div class="form-group">
                        {!! Form::label('responsable', 'Responsable') !!}
                        {!! Form::text('responsable', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group panel-body" id="divEstado">
                    {!! Form::label('estado_id', 'Activa') !!}
                    {!! Form::radio('estado_id', $estados[0], true) !!}
                    {!! Form::label('estado_id', 'Inactiva') !!}
                    {!! Form::radio('estado_id', $estados[1], false) !!}
                </div>

                <button type="submit" class="btn btn-warning">Editar Info</button>
                {!! Form::close() !!}
                <br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="footer">
            <p>Smartline @ 2018 - Desarrollado por <a href="http://www.bamdig.com/" target="_new" class="page-refresh">Bamdig.com</a></p>
        </div>
    </div>
</div>
