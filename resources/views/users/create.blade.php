@extends('users.base')
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

.select2-selection__choice, .select2-selection__choice, .select2-results__option{
            color: black;
        }

</style>
@endsection
@section('titulo')

    <h2>Usuarios</h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card alert">
                <div class="card-header pr">
                    <h2 class="panel-title">Crear nuevo usuario</h2>
                </div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'post', 'url' => route('users.store'), 'class' =>'form']) !!}

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('roles', 'Roles:') !!}
                                {!! Form::select('roles[]', $roles, null, ['class' => 'form-control multiple select2']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('sucursales', 'Sucursales') !!}
                                {!! Form::select('sucursales[]', $sucursales, null, ['class' => 'form-control multiple select2']) !!}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('nombre', 'Nombre') !!}
                                {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('apellido', 'Apellido') !!}
                                {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('telefono', 'Teléfono') !!}
                                {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('dni', 'DNI') !!}
                                {!! Form::text('dni', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Crear usuario</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        $('.select2').select2({
            multiple: true,
        });

    </script>

@endsection
