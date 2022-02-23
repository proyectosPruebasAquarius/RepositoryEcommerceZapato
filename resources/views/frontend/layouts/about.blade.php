@extends('frontend.index')

@section('title', 'Sobre Nosotros - Ecommerce')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="{{ url('/') }}">Inicio</a></span> / <span>Sobre nosotros</span></p>
            </div>
        </div>
    </div>
</div>


<div class="colorlib-about">
    <div class="container">
        <div class="row row-pb-lg">
            <div class="col-sm-6 mb-3">
                <div class="video colorlib-video" style="background-image: url(images/about.jpg);">
                    <a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-play3"></i></a>
                    <div class="overlay"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="about-wrap">
                    <h2>Zapateria empresa multinacional</h2>
                    <p>Nacida en El Salvador el 29 de Agosto de 1994, y fundada por la mano de un zapatero de la localidad del municipio de San Miguel.</p>
                    <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection