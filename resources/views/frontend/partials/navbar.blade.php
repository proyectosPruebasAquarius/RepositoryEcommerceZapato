<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-9">
                    <div id="colorlib-logo"><a href="{{ url('/') }}">Footwear</a></div>
                </div>
                <div class="col-sm-5 col-md-3">
                    <form action="{{ route('product.unfilter') }}" method="get" class="search-wrap">
                        <div class="form-group">
                            <input type="search" class="form-control search" placeholder="Buscar" name="search">
                            <button class="btn btn-primary submit-search text-center" type="submit"><i class="fal fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="navPrincipal">
                <div>
                    <div class="row">
                        <div class="col-sm-12 text-left menu-1">
                            @php
                                $actualParam = NULL;
                                if (request()->route()->getName() == 'product.views' || request()->route()->getName() == 'product.filter') {
                                    $actualParam = request()->route('categoria');
                                }                                
                            @endphp
                            <ul>
                                <li @if (request()->route()->getName() == 'inicio') class="active" @endif><a href="{{ url('/') }}">Inicio</a></li>
                                {{-- <li class="has-dropdown">
                                    <a href="men.html">Men</a>
                                    <ul class="dropdown">
                                        <li><a href="product-detail.html">Product Detail</a></li>
                                        <li><a href="cart.html">Shopping Cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="order-complete.html">Order Complete</a></li>
                                        <li><a href="add-to-wishlist.html">Wishlist</a></li>
                                    </ul>
                                </li> --}}
                                @php
                                    $categorias = \DB::table('categorias')->where('estado', 1)->get(['nombre', 'id']);
                                @endphp
                                @forelse ($categorias as $categoria)
                                    <li @if ($actualParam == $categoria->nombre) class="active" @endif><a href="{{ route('product.views', $categoria->nombre) }}">{{ $categoria->nombre }}</a></li>
                                @empty
                                    <li>No se encontraron categorias que mostrar...</li>
                                @endforelse
                                {{-- <li><a href="about.html">About</a></li>
                                <li><a href="contact.html">Contact</a></li> --}}
                                <li class="cart">
                                    
                                    @livewire('frontend.cart-section')
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="sale">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center">
                    <div class="row">
                        <div class="owl-carousel2">
                            <div class="item">
                                <div class="col">
                                    <h3><a href="#">25% de descuento. Usa el código: Venta de verano</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col">
                                    <h3><a href="#">Se acerca nuestra promoción del 50% de descuento</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>