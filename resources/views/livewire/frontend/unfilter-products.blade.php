<div>
    <div class="colorlib-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xl-3">
                    <div class="row">
                        {{-- Mobile first section --}}
                        <div class="col-sm-12 d-block d-md-none mb-5">
                            <div class="accordion" id="accordionExample">
                                <div class="card border-0">
                                  <div class="card-header border-0 rounded" id="headingThree">
                                    <h5 class="mb-0">
                                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <h4 class="d-inline">Filtros </h4><i class="far fa-chevron-down d-inline text-dark"></i>
                                      </button>
                                    </h5>
                                  </div>
                                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="col-sm-12">
                                            <div class="side border mb-1">
                                                <h3>Buscar</h3>
                                                <ul>
                                                    <li><input type="search" name="" id="" class="form-control rounded" placeholder="Buscar..." wire:model.lazy="search"></li>
                                                </ul>
                                            </div>
                                        </div>
                
                                        <div class="col-sm-12">
                                            <div class="side border mb-1">
                                                <h3>Categoria</h3>
                                                <ul>
                                                    @forelse ($categorias as $cat)
                                                        @php
                                                            $count = \DB::table('productos')->join('detalles_productos', 'productos.id_detalle_producto', '=', 'detalles_productos.id')->where('detalles_productos.id_categoria', $cat->id)->count();
                                                        @endphp
                                                        <li><a type="button" wire:click="filterByCategoria(@js($cat->nombre))" @if ($cat->nombre == $categoria) class="active" @endif>{{ $cat->nombre }} ({{ $count }})</a></li>
                                                    @empty
                                                        
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                
                                        @if(!empty($categoria))
                                            <div class="col-sm-12">
                                                <div class="side border mb-1">
                                                    <h3>Sub Categoria</h3>
                                                    <ul>
                                                        @forelse ($sub_categorias as $sub)
                                                            @php
                                                                $count = \DB::table('productos')
                                                                ->join('detalles_productos', 'productos.id_detalle_producto', '=', 'detalles_productos.id')
                                                                ->join('categorias', 'detalles_productos.id_categoria', '=', 'categorias.id')
                                                                ->where([
                                                                    ['detalles_productos.id_sub_categoria', $sub->id],
                                                                    ['categorias.nombre', $categoria]
                                                                ])
                                                                ->count();
                                                            @endphp
                    
                                                            @if($count)
                                                                <li><a type="button" wire:click="filterBySubCategoria(@js($sub->nombre))" @if ($sub->nombre == $sub_categoria) class="active" @endif>{{ $sub->nombre }} ({{ $count }})</a></li>
                                                            @endif
                                                        @empty
                                                            
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                
                                        <div class="col-sm-12">
                                            <div class="side border mb-1">
                                                <h3>Marca</h3>
                                                <ul>
                                                    @forelse ($marcas as $m)
                                                        <li><a type="button" wire:click="filterByBrand(@js($m->id))" @if ($m->id == $marca) class="active" @endif>{{ $m->nombre }}</a></li>
                                                    @empty
                                                        
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="side border mb-1">
                                                <h3>Tallas</h3>
                                                <div class="block-26 mb-2">
                                                    <h4>Talla</h4>
                                               <ul>
                                                    @forelse ($tallas as $talla)
                                                        <li><a type="button" @if (in_array($talla->nombre, $filtTallas)) class="active" @endif wire:click="filterBySize(@js($talla->nombre))">{{ $talla->nombre }}</a></li>
                                                    @empty
                                                        
                                                    @endforelse                                                                    
                                               </ul>
                                            </div>
                                            {{-- <div class="block-26">
                                                    <h4>Width</h4>
                                               <ul>
                                                  <li><a href="#">M</a></li>
                                                  <li><a href="#">W</a></li>
                                               </ul>
                                            </div> --}}
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="side border mb-1">
                                                <h3>Estilo</h3>
                                                <ul>
                                                    @forelse ($estilos as $estilo)
                                                        <li><a type="button" @if ($estilo->nombre == $style) class="active" @endif wire:click="filterByStyle(@js($estilo->nombre))">{{ $estilo->nombre }}</a></li>
                                                    @empty
                                                        
                                                    @endforelse   
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="side border mb-1">
                                                <div class="block-26 color-wrap">
                                                    <h3>Color</h3>
                                                    <ul>
                                                        @forelse ($colors as $color)
                                                            <li style="background: {{ $color->color }}; width: 25px; height: 25px; border: 1px solid #000" @if (in_array($color->nombre, $filtColors)) class="active" @endif wire:click="filterByColor(@js($color->nombre))"></li>
                                                        @empty
                                                            
                                                        @endforelse                                    
                                                    </ul>
                                                </div>                                
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="side border mb-1">
                                                <h3>Precio</h3>
                                                <ul>
                                                    <li><a type="button" wire:click="filterByPrice([0.00, 50.00])" @if($filtPrecios == [0.00, 50.00]) class="active" @endif>$0.00 - $50.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([50.00, 100.00])" @if($filtPrecios == [50.00, 100.00]) class="active" @endif>$50.00 - $100.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([100.00, 150.00])" @if($filtPrecios == [100.00, 150.00]) class="active" @endif>$100.00 - $150.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([150.00, 200.00])" @if($filtPrecios == [150.00, 200.00]) class="active" @endif>$150.00 - $200.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([200.00, 250.00])" @if($filtPrecios == [200.00, 250.00]) class="active" @endif>$200.00 - $250.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([250.00, 10000.00])" @if($filtPrecios == [250.00, 10000.00]) class="active" @endif>250.00+</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                        {{-- End Mobile First --}}

                        {{-- MD and Up --}}
                        <div class="col-sm-12 d-none d-md-block">
                            <div class="side border mb-1">
                                <h3>Buscar</h3>
                                <ul>
                                    <li><input type="search" name="" id="" class="form-control rounded" placeholder="Buscar..." wire:model="search"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-12 d-none d-md-block">
                            <div class="side border mb-1">
                                <h3>Categoria</h3>
                                <ul>
                                    @forelse ($categorias as $cat)
                                        @php
                                            $count = \DB::table('productos')->join('detalles_productos', 'productos.id_detalle_producto', '=', 'detalles_productos.id')->where('detalles_productos.id_categoria', $cat->id)->count();
                                        @endphp
                                        <li><a type="button" wire:click="filterByCategoria(@js($cat->nombre))" @if ($cat->nombre == $categoria) class="active" @endif>{{ $cat->nombre }} ({{ $count }})</a></li>
                                    @empty
                                        
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        @if(!empty($categoria))
                            <div class="col-sm-12 d-none d-md-block">
                                <div class="side border mb-1">
                                    <h3>Sub Categoria</h3>
                                    <ul>
                                        @forelse ($sub_categorias as $sub)
                                            @php
                                                $count = \DB::table('productos')
                                                ->join('detalles_productos', 'productos.id_detalle_producto', '=', 'detalles_productos.id')
                                                ->join('categorias', 'detalles_productos.id_categoria', '=', 'categorias.id')
                                                ->where([
                                                    ['detalles_productos.id_sub_categoria', $sub->id],
                                                    ['categorias.nombre', $categoria]
                                                ])
                                                ->count();
                                            @endphp

                                            @if($count)
                                                <li><a type="button" wire:click="filterBySubCategoria(@js($sub->nombre))" @if ($sub->nombre == $sub_categoria) class="active" @endif>{{ $sub->nombre }} ({{ $count }})</a></li>
                                            @endif
                                        @empty
                                            
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="col-sm-12 d-none d-md-block">
                            <div class="side border mb-1">
                                <h3>Marca</h3>
                                <ul>
                                    @forelse ($marcas as $m)
                                        <li><a type="button" wire:click="filterByBrand(@js($m->id))" @if ($m->id == $marca) class="active" @endif>{{ $m->nombre }}</a></li>
                                    @empty
                                        
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 d-none d-md-block">
                            <div class="side border mb-1">
                                <h3>Tallas</h3>
                                <div class="block-26 mb-2">
                                    <h4>Talla</h4>
                               <ul>
                                    @forelse ($tallas as $talla)
                                        <li><a type="button" @if (in_array($talla->nombre, $filtTallas)) class="active" @endif wire:click="filterBySize(@js($talla->nombre))">{{ $talla->nombre }}</a></li>
                                    @empty
                                        
                                    @endforelse                                                                    
                               </ul>
                            </div>
                            {{-- <div class="block-26">
                                    <h4>Width</h4>
                               <ul>
                                  <li><a href="#">M</a></li>
                                  <li><a href="#">W</a></li>
                               </ul>
                            </div> --}}
                            </div>
                        </div>
                        <div class="col-sm-12 d-none d-md-block">
                            <div class="side border mb-1">
                                <h3>Estilo</h3>
                                <ul>
                                    @forelse ($estilos as $estilo)
                                        <li><a type="button" @if ($estilo->nombre == $style) class="active" @endif wire:click="filterByStyle(@js($estilo->nombre))">{{ $estilo->nombre }}</a></li>
                                    @empty
                                        
                                    @endforelse   
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 d-none d-md-block">
                            <div class="side border mb-1">
                                <div class="block-26 color-wrap">
                                    <h3>Color</h3>
                                    <ul>
                                        @forelse ($colors as $color)
                                            <li style="background: {{ $color->color }}; width: 25px; height: 25px; border: 1px solid #000" @if (in_array($color->nombre, $filtColors)) class="active" @endif wire:click="filterByColor(@js($color->nombre))"></li>
                                        @empty
                                            
                                        @endforelse                                    
                                    </ul>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-sm-12 d-none d-md-block">
                            <div class="side border mb-1">
                                <h3>Precio</h3>
                                <ul>
                                    <li><a type="button" wire:click="filterByPrice([0.00, 50.00])" @if($filtPrecios == [0.00, 50.00]) class="active" @endif>$0.00 - $50.00</a></li>
                                    <li><a type="button" wire:click="filterByPrice([50.00, 100.00])" @if($filtPrecios == [50.00, 100.00]) class="active" @endif>$50.00 - $100.00</a></li>
                                    <li><a type="button" wire:click="filterByPrice([100.00, 150.00])" @if($filtPrecios == [100.00, 150.00]) class="active" @endif>$100.00 - $150.00</a></li>
                                    <li><a type="button" wire:click="filterByPrice([150.00, 200.00])" @if($filtPrecios == [150.00, 200.00]) class="active" @endif>$150.00 - $200.00</a></li>
                                    <li><a type="button" wire:click="filterByPrice([200.00, 250.00])" @if($filtPrecios == [200.00, 250.00]) class="active" @endif>$200.00 - $250.00</a></li>
                                    <li><a type="button" wire:click="filterByPrice([250.00, 10000.00])" @if($filtPrecios == [250.00, 10000.00]) class="active" @endif>250.00+</a></li>
                                </ul>
                            </div>
                        </div>
                        {{-- MD and Up End --}}
                        {{-- <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Technologies</h3>
                                <ul>
                                    <li><a href="#">BioBevel</a></li>
                                    <li><a href="#">Groove</a></li>
                                    <li><a href="#">FlexBevel</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-9 col-xl-9">
                    <div class="row row-pb-md">        
                       {{--  @php
                            $isEmpty;
                            if ($sub_categoria) {
                                $isEmpty = $sub_categoria;
                            } else {
                                $isEmpty = $style;
                            }
                        @endphp   --}}              
                        @forelse ($inventarios as $inv)
                            <div class="col-lg-4 mb-4 text-center" onclick="location.href = @js(route('product.detail', [$inv->categoria, $inv->sub_categoria, $inv->nombre]))">
                                <div class="product-entry border">
                                    <a href="{{ route('product.detail', [$inv->categoria, $inv->sub_categoria, $inv->nombre]) }}" class="prod-img">
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
                            <div class="col-lg-12 mb-4 text-center">
                                <div class="product-entry ">
                                    <img src="{{ asset('frontend/images/empty-state-grid.svg') }}" alt="">
                                </div>
                            </div>
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
