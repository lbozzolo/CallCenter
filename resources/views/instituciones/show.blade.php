@extends('base')

@section('content')

    <div class="row">
        <div class="col-lg-8">
                <h2>
                    <br>
                </h2>
<<<<<<< HEAD
<<<<<<< HEAD
                <hr>
                <div class="col-lg-6 col-md-6">
                    <ul class="list-unstyled">
                        <li class="list-group-item">Nombre: {!! $institucion->nombre !!}</li>
                        <li class="list-group-item">Dirección: {!! $institucion->direccion !!}</li>
                        <li class="list-group-item">Teléfono: {!! $institucion->telefono !!}</li>
                        <li class="list-group-item">Email: {!! $institucion->email !!}</li>
                        <li class="list-group-item">URL: {!! $institucion->url !!}</li>
                        <li class="list-group-item">Responsable: {!! $institucion->responsable !!}</li>
                        <li class="list-group-item">Descripción: {!! $institucion->descripcion !!}</li>
                        <li class="list-group-item">Estado: {!! ($institucion->estado)? $institucion->estado->nombre : '' !!}</li>
                        <li class="list-group-item">Fecha de alta: {!! $institucion->fecha_creado !!}</li>
                        <li class="list-group-item">Fecha de última acción: {!! $institucion->fecha_editado !!}</li>
                    </ul>
                    <a href="{{ route('instituciones.edit', $institucion->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ URL::previous() }}" class="btn btn-default">Volver</a>
                
=======
=======
>>>>>>> dda8b1e6c14fe8b48768134f58acd2d7e28c0867
                

            </div>
>>>>>>> dda8b1e6c14fe8b48768134f58acd2d7e28c0867
        </div>
    </div>

    <div id="main-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="user-profile">
                                        <div class="row">
                                            
                                            <div class="col-lg-10">
                                                <div class="user-profile-name">Nombre de la Institución:  {!! $institucion->nombre !!}</div>
                                                <div class="ratings">
                                                   <h4>Estado: <span class="badge badge-success"> {!! ($institucion->estado)? $institucion->estado->nombre : '' !!}</span></h4>
                                                </div>
                                                <div class="custom-tab user-profile-tab">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="active"><a href="#1" aria-controls="1" role="tab" data-toggle="tab">Datos Personales</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane active" id="1">
                                                            <div class="contact-information">
                                                                <div class="phone-content">
                                                                    <span class="contact-title">Teléfono:</span>
                                                                    <span class="phone-number">{!! $institucion->telefono !!}</span>
                                                                </div>
                                                                <div class="phone-content">
                                                                    <span class="contact-title">URL:</span>
                                                                    <span class="phone-number">{!! $institucion->url !!}</span>
                                                                </div>
                                                                <div class="address-content">
                                                                    <span class="contact-title">Responsable:</span>
                                                                    <span class="mail-address">{!! $institucion->responsable !!}</span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">Email:</span>
                                                                    <span class="contact-email">{!! $institucion->email !!}</span>
                                                                </div>
                                                               
                                                                <div class="skype-content">
                                                                    <span class="contact-title">Descripción:</span>
                                                                    <span class="contact-skype">{!! $institucion->descripcion !!}</span>
                                                                </div>
                                                            </div>
                                                            <div class="basic-information">
                                                                <h4>Información Básica:</h4>
                                                                <div class="birthday-content">
                                                                    <span class="contact-title">Dirección:</span>
                                                                    <span class="birth-date">{!! $institucion->direccion !!}</span>
                                                                </div>
                                                                <div class="gender-content">
                                                                    <span class="contact-title">Fecha de Alta:</span>
                                                                    <span class="gender">{!! $institucion->fecha_creado !!}</span>
                                                                </div>
                                                                <div class="gender-content">
                                                                    <span class="contact-title">Fecha de última acción:</span>
                                                                    <span class="gender">{!! $institucion->fecha_editado !!}</span>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>Smartline @ 2018 - Desarrollado por <a href="http://www.bamdig.com/" target="_new" class="page-refresh">Bamdig.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
    

@endsection





