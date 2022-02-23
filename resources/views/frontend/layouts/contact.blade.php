@extends('frontend.index')

@section('title', 'Contactanos - Ecommerce')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="{{ url('/') }}">Inicio</a></span> / <span>Contactanos</span></p>
            </div>
        </div>
    </div>
</div>


<div id="colorlib-contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Información de Contacto</h3>
                <div class="row contact-info-wrap">
                    <div class="col-md-3">
                        <p><span><i class="icon-location"></i></span> 198 West 21th Street, <br> Suite 721 New York NY
                            10016</p>
                    </div>
                    <div class="col-md-3">
                        <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ (503) 22242628</a></p>
                    </div>
                    <div class="col-md-3">
                        <p><span><i class="icon-paperplane"></i></span> <a
                                href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                    </div>
                    <div class="col-md-3">
                        <p><span><i class="icon-globe"></i></span> <a href="#">yoursite.com</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-wrap">
                    <h3>Mantente en Contacto</h3>
                    <form action="#" class="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">Nombres</label>
                                    <input type="text" id="fname" class="form-control" placeholder="Tús nombres">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Apellidos</label>
                                    <input type="text" id="lname" class="form-control" placeholder="Tús apellidos">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email">Correo Eléctronico</label>
                                    <input type="text" id="email" class="form-control" placeholder="Tú dirección de correo">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="subject">Titulo</label>
                                    <input type="text" id="subject" class="form-control"
                                        placeholder="Titulo del mensaje">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="message">Mensaje</label>
                                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"
                                        placeholder="Dinos algo sobre nosotros..."></textarea>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" value="Enviar Mensaje" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div id="map" class="colorlib-map"></div>
            </div>
        </div>
    </div>
</div>
@endsection