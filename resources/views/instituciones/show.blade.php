@extends('instituciones.base')

@section('titulo')

    <h2>Instituciones</h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">

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

@endsection





