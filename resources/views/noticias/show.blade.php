@extends('noticias.base')

@section('titulo')

    <h2>Noticias</h2>

@endsection

@section('contenido')

    <div class="row">

        <div class="col-lg-6">
            <div class="card">

                <div class="user-profile-name">Titulo de la Noticia:  {!! $noticia->nombre !!}</div>
                <div class="ratings">
                    <h4>Estado: <span class="badge badge-success"> {!! ($noticia->estado)? $noticia->estado->nombre : '' !!}</span></h4>
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
                                    <span class="phone-number">{!! $noticia->telefono !!}</span>
                                </div>
                                <div class="phone-content">
                                    <span class="contact-title">URL:</span>
                                    <span class="phone-number">{!! $noticia->url !!}</span>
                                </div>
                                <div class="address-content">
                                    <span class="contact-title">Responsable:</span>
                                    <span class="mail-address">{!! $noticia->responsable !!}</span>
                                </div>
                                <div class="email-content">
                                    <span class="contact-title">Email:</span>
                                    <span class="contact-email">{!! $noticia->email !!}</span>
                                </div>

                                <div class="skype-content">
                                    <span class="contact-title">Descripción:</span>
                                    <span class="contact-skype">{!! $noticia->descripcion !!}</span>
                                </div>
                            </div>
                            <div class="basic-information">
                                <h4>Información Básica:</h4>
                                <div class="birthday-content">
                                    <span class="contact-title">Dirección:</span>
                                    <span class="birth-date">{!! $noticia->direccion !!}</span>
                                </div>
                                <div class="gender-content">
                                    <span class="contact-title">Fecha de Alta:</span>
                                    <span class="gender">{!! $noticia->fecha_creado !!}</span>
                                </div>
                                <div class="gender-content">
                                    <span class="contact-title">Fecha de última acción:</span>
                                    <span class="gender">{!! $noticia->fecha_editado !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

@endsection





