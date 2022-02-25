@extends('frontend.index')

@section('title', 'Carrito - Ecommerce')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="{{ url('/') }}">Inicio</a></span> / <span>Carrito de Compras</span></p>
            </div>
        </div>
    </div>
</div>


<div class="colorlib-product">
    <div class="container">
        <div class="row row-pb-lg">
            <div class="col-md-10 offset-md-1">
                <div class="process-wrap">
                    <div class="process text-center active">
                        <p><span>01</span></p>
                        <h3>Carrito de Compras</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>02</span></p>
                        <h3>Datos de Envío</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>03</span></p>
                        <h3>Métodos de Pago</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="col-6">
                    <a href="{{ route('product.unfilter') }}" class="btn btn-primary">Continuar Comprando</a>
                </div>
            </div>
        </div>

        @livewire('frontend.cart')        
        {{-- <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>Related Products</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-lg-3 mb-4 text-center">
                <div class="product-entry border">
                    <a href="#" class="prod-img">
                        <img src="images/item-1.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
                    </a>
                    <div class="desc">
                        <h2><a href="#">Women's Boots Shoes Maca</a></h2>
                        <span class="price">$139.00</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 mb-4 text-center">
                <div class="product-entry border">
                    <a href="#" class="prod-img">
                        <img src="images/item-2.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
                    </a>
                    <div class="desc">
                        <h2><a href="#">Women's Minam Meaghan</a></h2>
                        <span class="price">$139.00</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 mb-4 text-center">
                <div class="product-entry border">
                    <a href="#" class="prod-img">
                        <img src="images/item-3.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
                    </a>
                    <div class="desc">
                        <h2><a href="#">Men's Taja Commissioner</a></h2>
                        <span class="price">$139.00</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 mb-4 text-center">
                <div class="product-entry border">
                    <a href="#" class="prod-img">
                        <img src="images/item-4.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
                    </a>
                    <div class="desc">
                        <h2><a href="#">Russ Men's Sneakers</a></h2>
                        <span class="price">$139.00</span>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection

@push('scripts')
    
@endpush