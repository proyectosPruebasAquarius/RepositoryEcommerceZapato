<div>
    <div class="row row-pb-lg">
        <div class="col-md-8">
            <div class="product-name d-flex">
                <div class="one-forth text-left px-4">
                    <span>Detalle del Producto</span>
                </div>
                <div class="one-eight text-center">
                    <span>Precio</span>
                </div>
                <div class="one-eight text-center">
                    <span>Cantidad</span>
                </div>
                <div class="one-eight text-center">
                    <span>Total</span>
                </div>
                <div class="one-eight text-center px-4">
                    <span>Remover</span>
                </div>
            </div>
            @forelse($cart as $key => $value)
                <div class="product-cart d-flex">
                    <div class="one-forth">
                        <div class="product-img" style="background-image: url({{ $value['attributes']['image'] ? asset('storage/'.json_decode($value['attributes']['image'])[0]) : asset('frontend/img/no-picture-frame.svg') }});">
                        </div>
                        <div class="display-tc">
                            <h3><a href="#">{{ $value['name'] }}</a></h3>
                            <h3>Talla: {{ \DB::table('tallas')->where('id', $value['attributes']['size'])->value('nombre') }} - <i class="fa fa-circle" aria-hidden="true" style="color: {{ \DB::table('colores')->where('id', $value['attributes']['color'])->value('color') }}"></i></h3>                            
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">${{ $value['price'] }}</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            {{-- <div style="display: flex">
                                <button class="btn bg-transparent">-</button>
                                <input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="1" min="1" max="100" onkeypress="this.style.width = ((this.value.length + 1) * 8) + 'px';">
                                <button class="btn bg-transparent">+</button>
                            </div> --}}
                             <livewire:frontend.update-qty :item="$value" :key="$value['id']"/>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">$ {{ number_format($value['price'] * $value['quantity'], 2, '.', '') }}</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <a type="button" class="closed" wire:click="removeFromCart(@js($value['id']))"></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="product-cart d-flex text-center">
                    Carrito Vacio.
                </div>
            @endforelse
        </div>
        <div class="total-wrap col-md-4 text-center sticky-top">
            <div class="total">
                <div class="sub">
                    <p><span>Subtotal:</span> <span>${{ \Cart::getSubTotal() }}</span></p>
                    {{-- <p><span>Total:</span> <span>${{ \Cart::getTotal() }}</span></p> --}}
                    {{-- <p><span>Discount:</span> <span>$45.00</span></p> --}}
                </div>
                <div class="grand-total">
                    <p><span><strong>Total:</strong></span> <span>${{ \Cart::getTotal() }}</span></p>
                    <p><a href="{{ route('checkout') }}" class="btn btn-primary">Finalizar Compra</a></p>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            
            /* window.addEventListener('reloadCart', () => {

            alert('Name updated to: ');

            }) */

            /* Livewire.on('reloadCart', e => {

                alert('hola' + e)
                var proQty = $('.pro-qty-2');
                proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
                proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');

            }) */

            window.addEventListener('render-span', e => {

                /* e.forEach(el => {
                    alert('Name updated to: ' + el);
                }) */

            })
        </script>
    @endpush
</div>
