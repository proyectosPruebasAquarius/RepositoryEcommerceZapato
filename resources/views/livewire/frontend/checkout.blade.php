<div>
    <section class="colorlib-product">
        <div class="container">
            <div class="row">
                <div class="col">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                </div>
            </div>

            <div class="row row-pb-lg">
                <div class="col-sm-10 offset-md-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Carrito de Compras</h3>
                        </div>
                        <div class="process text-center active">
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
                    <div class="col-12 text-center mx-auto">                        
                        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item mr-3 black__tab">
                                <a class="nav-link border" id="carrito-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">
                                  <span class="d-none d-md-block">Carrito</span> <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="nav-item mr-3 black__tab">
                                <a class="nav-link border @if ($tab == 'entrega') active @endif" id="entrega-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">
                                  <span class="d-none d-md-block"> Información de Entrega</span> <i class="fa fa-truck flip" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="nav-item black__tab">
                              <a class="nav-link border @if ($tab == 'pago') active @endif" id="pago-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                                  <span class="d-none d-md-block">Métodos de Pago</span> <i class="fa fa-credit-card" aria-hidden="true"></i>
                              </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="row">
                    <form wire:submit.prevent="venta" class="col-lg-8 col-md-6 colorlib-form" id="orderForm">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
                            <div class="tab-pane fade @if ($tab == 'entrega') show active @endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item black__tab">
                                      <a class="nav-link @if ($tabStore == 'direccion') active @endif" wire:click="$set('tabStore', 'direccion')" id="pills-direcciones-tab" data-toggle="pill" href="#pills-direcciones" role="tab" aria-controls="pills-direcciones" aria-selected="true"><i class="fa fa-map-o" aria-hidden="true"></i>
                                         Tús Direcciones</a>
                                    </li>
                                    <li class="nav-item black__tab">
                                      <a class="nav-link @if ($tabStore == 'tienda') active @endif" wire:click="$set('tabStore', 'tienda')" id="pills-tienda-tab" data-toggle="pill" href="#pills-tienda" role="tab" aria-controls="pills-tienda" aria-selected="false"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                         Recoger en Tienda</a>
                                    </li>
                                  </ul>
                                  <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade @if ($tabStore == 'direccion') show active @endif" id="pills-direcciones" role="tabpanel" aria-labelledby="pills-direcciones-tab">
                                        @forelse ($direcciones as $direccion)     
                                            @if($loop->first)
                                                <h3 class="font-weight-bold mb-5">Datos Personales:</h3>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr  class="border-bottom"> 
                                                                        <th scope="col"></th>                                                                       
                                                                        <th scope="col">Nombres y Apellidos</th>
                                                                        <th scope="col">Teléfono</th>
                                                                        <th scope="col">Editar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="border-bottom">
                                                                        <td></td>
                                                                        <td>{{ auth()->user()->name }}</td>
                                                                        <td>{{ $telefono }}</td>
                                                                        <td><button class="btn btn-default" data-toggle="modal" data-target="#profileModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                          </div>
                                                    </div>
                                                </div>

                                                <h3 class="font-weight-bold mb-5">Tús Direcciones:</h3>
                                                    
            
                                                @error('id_direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-borderless @error('id_direccion') border border-danger @enderror">
                                                        <thead>
                                                            <tr  class="border-bottom">
                                                                <th scope="col"></th>
                                                                <th scope="col">Dirección de envío</th>
                                                                <th scope="col">Editar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                            @endif                  
                                            
                                                        <tr class="border-bottom">
                                                            <td>
                                                                <label for="{{ 'selected-'.$loop->index }}"></label>
                                                                <input type="radio" name="selected" id="{{ 'selected-'.$loop->index }}" value="{{ $direccion->id }}" wire:model="id_direccion">
                                                            </td>
                                                            <td>
                                                                {{ $direccion->direccion. ', '.$direccion->departamento.' - '.$direccion->municipio }}
                                                                @if($direccion->referencia)
                                                                    <br>
                                                                    <p class="font-weight-bold">Referencia: </p>                                                    
                                                                    {{ $direccion->referencia }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-default" onclick="Livewire.emit('setValuesD', @js($direccion))" data-toggle="modal" data-target="#direccionesModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                            </td>
                                                        </tr>
                                                        @if($loop->last)
                                                            <tr>
                                                                <td colspan="3" class="mx-auto text-center">
                                                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#direccionesModal">Otra dirección de envío</button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    
                                            
                                            @if($loop->last)                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @error('id_facturacion') <span class="error text-danger">{{ $message }}</span> @enderror
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-borderless table-borderless-custom @error('id_facturacion') border border-danger @enderror">
                                                        <thead>
                                                            <tr class="border-bottom">
                                                                <th scope="col"></th>
                                                                <th scope="col">Dirección de facturación</th>
                                                                <th scope="col">Editar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($facturaciones as $ft)
                                                                <tr class="border-bottom">
                                                                    <td>
                                                                        <label for="{{ 'selectedF-'.$loop->index }}"></label>
                                                                        <input type="radio" name="selectedF" id="{{ 'selectedF-'.$loop->index }}" value="{{ $ft->id }}" wire:model="id_facturacion">
                                                                    </td>
                                                                    <td>
                                                                        {{ $ft->direccion. ', '.$ft->departamento.' - '.$ft->municipio }}
                                                                        @if($ft->referencia)
                                                                            <br>
                                                                            <p class="font-weight-bold">Referencia: </p>                                                    
                                                                            {{ $ft->referencia }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-default" onclick="Livewire.emit('setIsFacturacion'); Livewire.emit('setValuesD', @js($ft));" data-toggle="modal" data-target="#direccionesModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                    </td>
                                                                </tr>
                                                                @if($loop->last)
                                                                    <tr>
                                                                        <td colspan="3" class="mx-auto text-center">
                                                                            <button type="button" class="btn btn-default" onclick="Livewire.emit('setIsFacturacion')" data-toggle="modal" data-target="#direccionesModal">Otra dirección de facturación</button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @empty
                                                                <tr>
                                                                    <td colspan="3" class="mx-auto text-center">
                                                                        <button type="button" class="btn btn-default" onclick="Livewire.emit('setIsFacturacion')" data-toggle="modal" data-target="#direccionesModal">Agregar dirección de Facturación</button>
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>                                                    
                                                
                                            @endif
                                        @empty
                                            <div class="row" id="frm">
                                                <div class="col-12">
                                                    <h6><span></span> ¿Tienes un cupón? <a href="#">Presiona 
                                                        aquí</a> para ingresar tú código.</h6>
                                                    <h6>Datos personales</h6>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="tlfFrm">Teléfono<span>*</span></label>
                                                                <input id="tlfFrm" type="text" @if (auth()->user()->telefono) value="{{ auth()->user()->telefono }}" @endif wire:model="telefono" class="form-control @error('telefono') invalid @enderror">
                                                                @error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h6 class="mt-4">Datos de envío</h6>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="telFrm">Dirección de envío<span>*</span></label>
                                                                <input id="telFrm" type="text" wire:model="direccion" class="form-control @error('direccion') invalid @enderror">
                                                                @error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="refFrm">Referencia de envío</label>
                                                                <input id="refFrm" type="text" wire:model="referencia" class="form-control @error('referencia') invalid @enderror">
                                                                @error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="dprtFrm">Departamento<span>*</span></label>
                                                                <div class="form-field">
                                                                    <i class="icon icon-arrow-down3"></i>
                                                                    <select id="dprtFrm" class="form-control @error('departamento') invalid @enderror" wire:model="departamento">
                                                                        @forelse ($departamentos as $dp)
                                                                            @if($loop->first)
                                                                                <option selected value="" style="display: none;">Seleccione un departamento</option>    
                                                                            @else
                                                                                <option value="{{ $dp->id }}">{{ $dp->nombre }}</option>
                                                                            @endif                                        
                                                                        @empty
                                                                        <option>Ocurrió un error, intentelo de nuevo recargando la pagina.</option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                                @error('departamento') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="mnpFrm">Municipio<span>*</span></label>
                                                                <div class="form-field">
                                                                    <i class="icon icon-arrow-down3"></i>
                                                                    <select id="mnpFrm" class="form-control @error('id_municipio') invalid @enderror" wire:model="id_municipio">
                                                                        @forelse ($municipios as $mp)
                                                                            @if($loop->first)
                                                                                <option value="" style="display: none;">Seleccione un municipio</option>    
                                                                            @else
                                                                                <option value="{{ $mp->id }}">{{ $mp->nombre }}</option>
                                                                            @endif                                        
                                                                        @empty
                                                                        <option>Seleccione un departamento.</option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                                @error('id_municipio') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <h6>Datos de facturación</h6>   
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="dfFrm">Dirección de facturación<span>*</span></label>
                                                                <input id="dfFrm" type="text" wire:model="direccionFacturaciones" class="form-control @error('direccionFacturaciones') invalid @enderror">
                                                                @error('direccionFacturaciones') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="refFrmx">Referencia de facturación</label>
                                                                <input id="refFrmx" type="text" wire:model="referenciaFacturaciones" class="form-control @error('referenciaFacturaciones') invalid @enderror">
                                                                @error('referenciaFacturaciones') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="dprtfFrm">Departamento<span>*</span></label>
                                                                <div class="form-field">
                                                                    <i class="icon icon-arrow-down3"></i>
                                                                    <select id="dprtfFrm" class="form-control @error('departamentoF') invalid @enderror" wire:model="departamentoF">
                                                                        @forelse ($departamentos as $dp)
                                                                            @if($loop->first)
                                                                                <option selected value="" style="display: none;">Seleccione un departamento</option>    
                                                                            @else
                                                                                <option value="{{ $dp->id }}">{{ $dp->nombre }}</option>
                                                                            @endif                                        
                                                                        @empty
                                                                        <option>Ocurrió un error, intentelo de nuevo recargando la pagina.</option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                                @error('departamentoF') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="mnpfFrm">Municipio<span>*</span></label>
                                                                <div class="form-field">
                                                                    <i class="icon icon-arrow-down3"></i>
                                                                    <select id="mnpfFrm" class="form-control @error('id_municipioFacturaciones') invalid @enderror" wire:model="id_municipioFacturaciones">
                                                                        @forelse ($municipiosF as $mp)
                                                                            @if($loop->first)
                                                                                <option value="" style="display: none;">Seleccione un municipio</option>    
                                                                            @else
                                                                                <option value="{{ $mp->id }}">{{ $mp->nombre }}</option>
                                                                            @endif                                        
                                                                        @empty
                                                                        <option>Seleccione un departamento.</option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                                @error('id_municipioFacturaciones') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="radio">
                                                                  <label><input type="checkbox" name="optradio" value="1" wire:model="sameData"> ¿Usar los mismos datos de envío? </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="tab-pane fade @if ($tabStore == 'tienda') show active @endif" id="pills-tienda" role="tabpanel" aria-labelledby="pills-tienda-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h4 class="text-center text-weight-bold text-monospace">Fashion Store</h4>
                                                    </div>                                    
                                                    <div class="col-12  text-center">
                                                        <input type="radio" name="isTienda" id="isTienda" value="1" wire:model="recoger_tienda">
                                                        <label for="isTienda">4a Calle, Chalatenango, Chalatenango</label>
                                                        @error('recoger_tienda') <span class="error text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="col-12 mx-auto text-center">
                                                        <a href="https://goo.gl/maps/7f2DnKKNGqhcR6eZA" target="_blank" style="color: #e53637;">Ver dirección</a>
                                                        {{-- <button type="submit">presioname</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>                    
            
                                
                            </div>
                            <div class="tab-pane fade @if ($tab == 'pago') show active @endif" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Metodos de Pago</h5>
                                    </div>
                                    @forelse ($metodosPagos as $pago)
                                        <div class="col-12">
                                            <div class="card card-body @if ($loop->first) mt-3 @endif mb-3">
                                                <a type="button" wire:click="$set('id_metodo_pago', @js($pago->id))"  data-toggle="collapse" data-target="#collapse-{{ $loop->index }}" aria-expanded="false" aria-controls="collapse-{{ $loop->index }}">
                                                    {{ $pago->nombre }}
                                                </a>
                                            </div>
                                            
                                            <div class="collapse @if ($id_metodo_pago == $pago->id) show @endif" id="collapse-{{ $loop->index }}">
                                                <div class="card card-body @if ($loop->first) mb-3 @endif">
                                                    <div class="col-12 text-center">                                                                
                                                        <input type="radio" name="pago" id="{{ $pago->nombre }}" value="{{ $pago->id }}" wire:model="id_metodo_pago" @if ($id_metodo_pago == $pago->id) checked @endif
                                                       
                                                        >
                                                        <label for="{{ $pago->nombre }}">{{ $pago->nombre }}</label>    
                                                        @error('id_metodo_pago') <span class="error text-danger">{{ $message }}</span> @enderror                            
                                                    </div>
                                                   @if($pago->qr)
                                                    @if (count(json_decode($pago->qr)) > 1)
                                                    @forelse (json_decode($pago->qr) as $img)
                                                    <div class="col-6 align-self-center">
                                                        <img src="{{ asset('storage/images/metodos_pagos/'.$img) }}" alt="{{ $pago->nombre }}" class="img-fluid rounded mx-auto  d-inline-block ">
                                                    </div>
                                                    @empty
                                                        
                                                    @endforelse
                                                    @else
                                                    <div class="col-12 align-self-center">
                                                        <img src="{{ asset('storage/images/metodos_pagos/'.json_decode($pago->qr)[0]) }}" alt="{{ $pago->nombre }}" class="img-fluid rounded mx-auto d-block">
                                                    </div>
                                                    @endif
                                                   @endif
                                                    <div class="col-12 form-group">
                                                        <h5 class="text-center mt-3">Número de {{ strtolower($pago->nombre) == 'chivo wallet' ? 'BTC' : 'cuenta' }} {{ $pago->nombre }}</h5><br>
                                                        <h5 class="text-danger text-center">{{ $pago->numero }}</h5>
                                                        <h5><b>Porfavor, adjunte una captura de pantalla, donde se muestre una imagen legible del comprobante de trasacción, proveído por {{ strtolower($pago->nombre) == 'chivo wallet' ? 'chivo wallet' : 'su banco' }}.</b></h5>
                                                        <div class="form-group">
                                                            <label for="mtd{{ $loop->index }}">Número de Trasacción<span>*</span></label>
                                                            <input id="mtd{{ $loop->index }}" type="text" wire:model="numero" class="form-control @error('numero') invalid @enderror">
                                                            @error('numero') <span class="error text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">                                
                                                        <label for="up-{{ $loop->index }}">Adjunte captura de pantalla del recibo de Trasacción<span class="text-danger">*</span></label>
                                                        <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" id="up-{{ $loop->index }}" wire:model="imagen">             
                                                        @error('imagen') <span class="error text-danger">{{ $message }}</span> @enderror               
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    @empty
                                        <div class="col mt-5">
                                            <h6>Metodos de pago no disponibles...</h6>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>                    
                    </form>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="cart-detail sticky-top">
                            <h2>Tú Orden</h2>
                            {{-- <div class="checkout__order__products">Product <span>Total</span></div> --}}
                            <ul>                                
                                @forelse ($cart as $c)
                                    <li>{{ '0'.$countCart++ }}. {{ $c['name']. ' x '.$c['quantity'] }} $ {{ number_format($c['price']*$c['quantity'], 2, '.', '') }}</li>
                                    <li><span class="w-100"></span></li>
                                @empty
                                    <li><span>Ocurrió un error, carrito vacio.</span></li>
                                @endforelse
                                <li><span>Subtotal</span> <span>${{ \Cart::getSubTotal(); }}</span></li>
                                <li><span>Total</span> <span>${{ \Cart::getTotal(); }}</span></li>
                            </ul>
                            <button type="submit" class="btn  @if ($tab != 'pago') d-none @endif" form="orderForm" wire:loading.attr="disabled" wire:target="venta">Finalizar Compra <div wire:loading wire:target="venta"><div class="spinner-grow text-success"></div></div></button>
                        </div>
                    </div>
                </div>            
        </div>
    </section>
    {{-- Modal Edit Direcciones --}}
    @if(count($direcciones))
        @livewire('frontend.direcciones')
        @livewire('frontend.edit-profile')
    @endif
    {{-- End Modal --}}

    @push('scripts')
        <script>
            /* window.onscroll = () => {
                if (window.pageYOffset > document.querySelector('.checkout__order').offsetTop) {
                    document.querySelector('.checkout__order').classList.add('pt-2');
                } else {
                    document.querySelector('.checkout__order').classList.remove('pt-2');
                }
            } */

            $('a[data-toggle="pill"]').on('show.bs.tab', function (e) {    
                // console.log(e.target); // newly activated tab
                // console.log(e.relatedTarget); // previous active tab
                
               switch (e.target.id) {
                   case 'carrito-tab':
                       console.log(e.target);
                       e.preventDefault();
                       location.href = @js(route('cart'));
                       break;
                    case 'entrega-tab':
                        console.log('enytra');
                        @this.tab = 'entrega'
                        break;
                    case 'pago-tab':
                        if (!validator()) {
                            e.preventDefault();
                            e.relatedTarget.classList.add('bg-danger');
                            if (document.querySelector('button[form="orderForm"]').classList.contains('d-none')) {
                                document.querySelector('button[form="orderForm"]').classList.add('d-none');
                            }
                        } else {
                            document.querySelector('button[form="orderForm"]').classList.remove('d-none');
                            @this.storeTab('pago');
                        }
                        break;
               }
            })

            function validator() {
                const frm = document.getElementById('frm');

                if (frm) {
                    if (@this.direccion && @this.id_municipio && @this.direccionFacturaciones && @this.id_municipioFacturaciones && @this.telefono || @this.recoger_tienda) {
                        return true;
                    }
                } else {
                    if (@this.id_facturacion && @this.$id_direccion && @this.telefono || @this.recoger_tienda) {
                        return true;
                    }
                }
            }
            $('.collapse').collapse()
            let collapses = document.querySelectorAll('.collapse');
            Array.from(collapses).forEach(i => {
                console.log(i.id);
                $(i.id).on('shown.bs.collapse', function (e) {
                    console.log(e);
                    @this.collapse = e.target.id
                })
                /* document.addEventListener('show.bs.collapse', function(e) {
                    @this.collapse = e.target.id;
                    console.log(e.target.id);
                }) */
            })
        </script>
    @endpush
</div>
