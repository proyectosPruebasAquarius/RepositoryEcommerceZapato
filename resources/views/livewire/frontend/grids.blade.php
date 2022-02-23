<div>
    <div class="colorlib-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xl-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Brand</h3>
                                <ul>
                                    <li><a href="#">Nike</a></li>
                                    <li><a href="#">Adidas</a></li>
                                    <li><a href="#">Merrel</a></li>
                                    <li><a href="#">Gucci</a></li>
                                    <li><a href="#">Skechers</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Size/Width</h3>
                                <div class="block-26 mb-2">
                                    <h4>Size</h4>
                               <ul>
                                  <li><a href="#">7</a></li>
                                  <li><a href="#">7.5</a></li>
                                  <li><a href="#">8</a></li>
                                  <li><a href="#">8.5</a></li>
                                  <li><a href="#">9</a></li>
                                  <li><a href="#">9.5</a></li>
                                  <li><a href="#">10</a></li>
                                  <li><a href="#">10.5</a></li>
                                  <li><a href="#">11</a></li>
                                  <li><a href="#">11.5</a></li>
                                  <li><a href="#">12</a></li>
                                  <li><a href="#">12.5</a></li>
                                  <li><a href="#">13</a></li>
                                  <li><a href="#">13.5</a></li>
                                  <li><a href="#">14</a></li>
                               </ul>
                            </div>
                            <div class="block-26">
                                    <h4>Width</h4>
                               <ul>
                                  <li><a href="#">M</a></li>
                                  <li><a href="#">W</a></li>
                               </ul>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Style</h3>
                                <ul>
                                    <li><a href="#">Slip Ons</a></li>
                                    <li><a href="#">Boots</a></li>
                                    <li><a href="#">Sandals</a></li>
                                    <li><a href="#">Lace Ups</a></li>
                                    <li><a href="#">Oxfords</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Colors</h3>
                                <ul>
                                    <li><a href="#">Black</a></li>
                                    <li><a href="#">White</a></li>
                                    <li><a href="#">Blue</a></li>
                                    <li><a href="#">Red</a></li>
                                    <li><a href="#">Green</a></li>
                                    <li><a href="#">Grey</a></li>
                                    <li><a href="#">Orange</a></li>
                                    <li><a href="#">Cream</a></li>
                                    <li><a href="#">Brown</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Material</h3>
                                <ul>
                                    <li><a href="#">Leather</a></li>
                                    <li><a href="#">Suede</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Technologies</h3>
                                <ul>
                                    <li><a href="#">BioBevel</a></li>
                                    <li><a href="#">Groove</a></li>
                                    <li><a href="#">FlexBevel</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-xl-9">
                    <div class="row row-pb-md">        
                        @php
                            $isEmpty;
                            if ($sub_categoria) {
                                $isEmpty = $sub_categoria;
                            } else {
                                $isEmpty = $style;
                            }
                        @endphp                
                        @forelse ($inventarios as $inv)
                            <div class="col-lg-4 mb-4 text-center" onclick="location.href = @js(route('product.detail', [$categoria, $isEmpty, $inv->nombre]))">
                                <div class="product-entry border">
                                    <a href="#" class="prod-img">
                                        <img src="{{ asset('storage/'. json_decode($inv->imagen)[0]) }}" class="img-fluid" alt="Product Img">
                                    </a>
                                    <div class="desc">
                                        <h2><a href="#">{{ $inv->nombre }}</a></h2>
                                        @if ($inv->precio_descuento)
                                            <span class="price">${{ $inv->precio_descuento}} <span style="text-decoration: line-through; color: #616161;">${{ $inv->precio_venta }}</span></span>
                                        @else
                                            <span class="price">{{ $inv->precio_venta }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="block-27">
                           <ul>
                               <li><a href="#"><i class="ion-ios-arrow-back"></i></a></li>
                              <li class="active"><span>1</span></li>
                              <li><a href="#">2</a></li>
                              <li><a href="#">3</a></li>
                              <li><a href="#">4</a></li>
                              <li><a href="#">5</a></li>
                              <li><a href="#"><i class="ion-ios-arrow-forward"></i></a></li>
                           </ul>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
