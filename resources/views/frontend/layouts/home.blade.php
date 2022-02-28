@extends('frontend.index')

@section('title', 'Inicio - Ecommerce Zapatos')

@section('content')
<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            @forelse ($banners as $banner)
                <li style="background-image: url({{ asset( $banner->imagen) }});">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">{{ $banner->titulo }}</h1>
                                        <h2 class="head-2">{{ $banner->sub_titulo }}</h2>
                                        <h2 class="head-3">{{ $banner->descripcion }}</h2>
                                        <p class="category"><span>New trending shoes</span></p>
                                        <p><a href="#" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li><h3 class="text-center mt-2">No se encontraron banners...</h3></li>
            @endforelse
            {{-- <li style="background-image: url(images/img_bg_2.jpg);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 offset-sm-3 text-center slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h1 class="head-1">Huge</h1>
                                    <h2 class="head-2">Sale</h2>
                                    <h2 class="head-3"><strong class="font-weight-bold">50%</strong> Off</h2>
                                    <p class="category"><span>Big sale sandals</span></p>
                                    <p><a href="#" class="btn btn-primary">Shop Collection</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url(images/img_bg_3.jpg);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 offset-sm-3 text-center slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h1 class="head-1">New</h1>
                                    <h2 class="head-2">Arrival</h2>
                                    <h2 class="head-3">up to <strong class="font-weight-bold">30%</strong> off
                                    </h2>
                                    <p class="category"><span>New stylish shoes for men</span></p>
                                    <p><a href="#" class="btn btn-primary">Shop Collection</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li> --}}
        </ul>
    </div>
</aside>
<div class="colorlib-intro">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="intro">Categorías de Productos.</h2>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-product">
    <div class="container-fluid">
        <div class="row">
            @forelse ($categorias as $cat)
                @if(strtolower($cat->nombre) != 'unisex')
                    <div class="col-sm-6 text-center">
                        <div class="featured">
                            @inject('remove', 'App\Helpers\Helper')
                            @if(strtolower($cat->nombre) == 'hombre')
                                <a href="{{ route('product.views', $cat->nombre) }}" class="featured-img" style="background-image: url({{ asset('frontend/images/men-category.jpg') }});"></a>
                            @elseif(strtolower($cat->nombre) == 'mujer')
                                <a href="{{ route('product.views', $cat->nombre) }}" class="featured-img" style="background-image: url({{ asset('frontend/images/women-category.jpg') }});"></a>                                
                            @elseif(strtolower($remove::remove_accents($cat->nombre)) == 'nino')
                                <a href="{{ route('product.views', $cat->nombre) }}" class="featured-img" style="background-image: url({{ asset('frontend/images/niños-category.jpg') }});"></a>
                            @else
                                <a href="{{ route('product.views', $cat->nombre) }}" class="featured-img" style="background-image: url({{ asset('frontend/images/niñas-category.jpg') }});"></a>
                            @endif
                            <div class="desc">
                                <h2><a href="{{ route('product.views', $cat->nombre) }}">Colleción de {{ $cat->nombre }}</a></h2>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-sm-6 text-center">
                    <div class="featured">
                        No se encontraron categorias...
                    </div>
                </div>
            @endforelse
            {{-- <div class="col-sm-6 text-center">
                <div class="featured">
                    <a href="#" class="featured-img" style="background-image: url(images/women.jpg);"></a>
                    <div class="desc">
                        <h2><a href="#">Shop Women's Collection</a></h2>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
                <h2>Nuevos Productos</h2>
            </div>
        </div>
        <div class="row row-pb-md">
            @forelse ($inventarios as $inv)
                <div class="col-lg-3 mb-4 text-center" onclick="location.href = @js(route('product.detail', [$inv->categoria, $inv->sub_categoria, $inv->nombre]))">
                    <div class="product-entry border">
                        <a href="{{ route('product.detail', [$inv->categoria, $inv->sub_categoria, $inv->nombre]) }}" class="prod-img">
                            <img src="{{ 'storage/' . json_decode($inv->imagen)[0] }}" class="img-fluid" alt="Product Img">
                        </a>
                        <div class="desc">
                            <h2><a href="{{ route('product.detail', [$inv->categoria, $inv->sub_categoria, $inv->nombre]) }}">{{ $inv->nombre }}</a></h2>
                            @if ($inv->precio_descuento)
                                <span><span class="price">${{ $inv->precio_descuento }}</span> <span class="price" style="text-decoration: line-through; color: #616161;">${{ $inv->precio_venta }}</span></span>
                            @else
                                <span class="price">${{ $inv->precio_venta }}</span>
                            @endif
                        </div>
                    </div>
                </div>  
            @empty
                <div class="col-lg-12 mb-4 text-center">
                    <div class="product-entry border">
                        No se encontraron productos...
                    </div>
                </div>
            @endforelse          
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p><a href="{{ route('product.unfilter') }}" class="btn btn-primary btn-lg">Todos los productos</a></p>
            </div>
        </div>
    </div>
</div>

<div class="colorlib-partner">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>Marcas</h2>
            </div>
        </div>
        <div class="row">
            <div class="col partner-col text-center">
                <img src="{{ asset('frontend/images/brand-1.jpg') }}" class="img-fluid" alt="Marcas Images">
            </div>
            <div class="col partner-col text-center">
                <img src="{{ asset('frontend/images/brand-2.jpg') }}" class="img-fluid" alt="Marcas Images">
            </div>
            <div class="col partner-col text-center">
                <img src="{{ asset('frontend/images/brand-3.jpg') }}" class="img-fluid" alt="Marcas Images">
            </div>
            <div class="col partner-col text-center">
                <img src="{{ asset('frontend/images/brand-4.jpg') }}" class="img-fluid" alt="Marcas Images">
            </div>
            <div class="col partner-col text-center">
                <img src="{{ asset('frontend/images/brand-5.jpg') }}" class="img-fluid" alt="Marcas Images">
            </div>
        </div>
    </div>
</div>
@endsection