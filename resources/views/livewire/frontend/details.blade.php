<div>
    <div class="colorlib-product">
        <div class="container">
            <div class="row row-pb-lg product-detail-wrap">
                <div class="col-sm-8">
                    @livewire('frontend.photos-gallery', ['imagenes' => json_decode($product->imagen)])
                </div>
                <div class="col-sm-4">
                    <div class="product-desc">
                        <h3>{{ $product->nombre }}</h3>
                        <p class="price">
                            @if ($product->precio_descuento)
                            <span><span class="d-inline">${{ $product->precio_descuento }}</span> <span class="d-inline" style="text-decoration: line-through; color: #b3b3b3">${{ $product->precio_venta }}</span></span>
                            @else
                            <span>${{ $product->precio_venta }}</span>
                            @endif
                            <span class="rate">
                                @php
                                    $opiniones = DB::table('opiniones')->where('id_producto', $product->id_producto);                                    
                                    $countOp = $opiniones->avg('rating');
                                    if (empty($countOp)) {
                                        $countOp = 0;
                                    }
                                @endphp
                                <i class="@if ($countOp > 0 && $countOp <= 0.50) fad fa-star-half-alt @elseif($countOp >= 1) fas fa-star @else far fa-star @endif"></i>
                                <i class="@if ($countOp > 0.50 && $countOp <= 1.50) fad fa-star-half-alt @elseif($countOp >= 2) fas fa-star @else far fa-star @endif"></i>
                                <i class="@if ($countOp > 1.50 && $countOp <= 2.50) fad fa-star-half-alt @elseif($countOp >= 3) fas fa-star @else far fa-star @endif"></i>
                                <i class="@if ($countOp > 2.50 && $countOp <= 3.50) fad fa-star-half-alt @elseif($countOp >= 4) fas fa-star @else far fa-star @endif"></i>
                                <i class="@if ($countOp > 3.50 && $countOp <= 4.50) fad fa-star-half-alt @elseif($countOp == 5) fas fa-star @else far fa-star @endif"></i>
                                {{-- (74 Rating) --}}
                            </span>
                        </p>
                        <p>{{ $product->descripcion }}</p>
                        <div class="size-wrap">
                            <div class="block-26 mb-2 size-wrap">
                                @php
                                $tallas = \DB::table('detalles_tallas')->join('tallas', 'detalles_tallas.id_talla', '=', 'tallas.id')
                                ->where([
                                ['detalles_tallas.id_producto', $product->id_producto],
                                ['tallas.estado', 1]
                                ])
                                ->select('detalles_tallas.*', 'tallas.nombre')->get();

                                $colores = \DB::table('detalles_colores')->join('colores', 'detalles_colores.id_color', '=', 'colores.id')
                                ->where([
                                ['detalles_colores.id_producto', $product->id_producto],
                                ['colores.estado', 1]
                                ])
                                ->select('detalles_colores.*', 'colores.color')->get();
                                @endphp
                                <h4>Talla</h4>
                                <ul>
                                    @forelse ($tallas as $tal)
                                    <li @if ($tal->id_talla == $size) class="active" @endif wire:click="$set('size', @js($tal->id_talla))" style="line-height: 40px;
                                        text-align: center;">{{ $tal->nombre }}</li>
                                    @empty
                                    <li>No se encontraron tallas...</li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="block-26 mb-4 color-wrap">
                                <h4>Color</h4>
                                <ul>
                                    @forelse ($colores as $color)
                                    <li style="background: {{ $color->color }}; border: 1px solid #000000;" @if ($color->id_color == $style) class="active" @endif wire:click="$set('style', @js($color->id_color))"><a type="button"></a></li>
                                    @empty
                                    <li>No se encontraron colores...</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-btn">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                            <span class="input-group-btn ml-1">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <p class="addtocart"><a type="button" class="btn btn-primary btn-addtocart text-white d-inline" onclick="addToCartTrigger()" wire:click="addToCart(@js($product))"><i class="far fa-shopping-cart d-inline"></i> Agregar al Carrito</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-12 pills">
                            <div class="bd-example bd-example-tabs">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Descripción</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Guía de Tallas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-expanded="true">Opiniones</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                                        <p>{{ $product->descripcion }}</p>
                                        {{-- <p>When she reached the first hills of the Italic Mountains, she had a last view
                                            back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet
                                            Village and the subline of her own road, the Line Lane. Pityful a rethoric
                                            question ran over her cheek, then she continued her way.</p> --}}
                                        {{-- <ul>
                                            <li>The Big Oxmox advised her not to do so</li>
                                            <li>Because there were thousands of bad Commas</li>
                                            <li>Wild Question Marks and devious Semikoli</li>
                                            <li>She packed her seven versalia</li>
                                            <li>tial into the belt and made herself on the way.</li>
                                        </ul> --}}
                                    </div>

                                    <div class="tab-pane border fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
                                        <p>Even the all-powerful Pointing has no control about the blind texts it is an
                                            almost unorthographic life One day however a small line of blind text by the
                                            name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                                        <p>When she reached the first hills of the Italic Mountains, she had a last view
                                            back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet
                                            Village and the subline of her own road, the Line Lane. Pityful a rethoric
                                            question ran over her cheek, then she continued her way.</p>
                                    </div>

                                    <div class="tab-pane border fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @guest
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <p>Debes iniciar sesión para valorar.</p>
                                                    </div>
                                                </div>
                                                @else
                                                @php
                                                $isAllowedToComment = \DB::table('detalle_ventas')->join('ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->where([
                                                ['detalle_ventas.id_producto', $product->id_producto],
                                                ['ventas.id_usuario', auth()->user()->id]
                                                ])->count();
                                                @endphp

                                                @if ($isAllowedToComment)
                                                @livewire('frontend.reviews', ['id' => $product->id_producto])
                                                @endif

                                                @livewire('frontend.edit-review')
                                                @endguest
                                                @livewire('frontend.comments', ['id' => $product->id_producto])


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
        @push('scripts')
        <script>
            let addToCartTrigger = () => {
                @this.qty = document.querySelector('input[type=text]').value
            }

            $(document).ready(function(){

            var quantitiy=0;
            $('.quantity-right-plus').click(function(e){
                    
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    var quantity = parseInt($('#quantity').val());
                    
                    // If is not undefined
                        
                        $('#quantity').val(quantity + 1);

                    
                        // Increment
                    
                });

                $('.quantity-left-minus').click(function(e){
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    var quantity = parseInt($('#quantity').val());
                    
                    // If is not undefined
                
                        // Increment
                        if(quantity>1){
                        $('#quantity').val(quantity - 1);
                        }
                });
                
            });
        </script>
        @endpush
    </div>
</div>