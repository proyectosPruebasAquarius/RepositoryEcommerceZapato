<div>
    <div class="navbar-cart">
        @guest
            <div class="d-inline">
                <a href="{{ route('login') }}" class="d-inline-block">Acceder <i class="far fa-user"></i></a>
            </div>
        @else
            <div class="dropdown d-block">
                <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(auth()->user()->id_tipo_usuario == 1)
                        <i class="far fa-user-shield"></i>
                    @else
                        <i class="fal fa-user"></i>
                    @endif                    
                </a>
                <div class="dropdown-menu p-2" aria-labelledby="dropdownMenu2">
                @if(auth()->user()->id_tipo_usuario == 1)
                    <a class="dropdown-item" type="button" href="#">Administración</a>
                @endif
                <a class="dropdown-item @if (request()->route()->getName() === 'perfil') active @endif" type="button" href="{{ route('perfil') }}">Perfil</a>                                    
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" type="button" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </div>
            </div>
        @endguest
        <div class="cart-items">
            <a href="javascript:void(0)" class="main-btn d-block">
                <i class="fal fa-shopping-cart"></i>
                <span class="total-items">{{ Cart::getTotalQuantity()}}</span>
            </a>

            <div class="shopping-item">
                <div class="dropdown-cart-header">
                    @if(count($cart) > 0)
                        <a href="{{ url('/carrito') }}">Ver Carrito</a>
                    @endif  
                    <a href="#" disabled><span>{{ Cart::getTotalQuantity()}} Productos</span></a>
                          
                </div>
                <ul class="shopping-list" style="max-height: 280px;  position: relative;">
                    @forelse ($cart as $item)
                        <li>
                            <button class="remove mr-3" title="Remover este producto" wire:click.prevent="removeCart(@js($item['id']))"><i class="fa fa-times"></i></button>
                            <div class="cart-img-head">
                                <a class="cart-img" href="#"><img class="img-fluid" src="{{ $item['attributes']['image'] ? asset('storage/'.json_decode($item['attributes']['image'])[0]) : asset('frontend/img/no-picture-frame.svg') }}" alt="#"></a>
                            </div>
                            <div class="content text-left">
                                <h4><a href="{{-- route('details',$item['name']) --}}">
                                    {{ $item['name'] }}</a></h4>
                                <p class="quantity">{{ $item['quantity'] }}x - <span class="amount">${{ number_format($item['price'], 2, '.', '') }}</span></p>
                                
                                <p>Talla: {{ \DB::table('tallas')->where('id', $item['attributes']['size'])->value('nombre') }} - <i class="fa fa-circle border border-dark rounded-circle" aria-hidden="true" style="color: {{ \DB::table('colores')->where('id', $item['attributes']['color'])->value('color') }}; background-color: {{ \DB::table('colores')->where('id', $item['attributes']['color'])->value('color') }}"></i></p>
                            </div>
                        </li>
                    @empty
                       <p class="text-center">{{ __('Carrito Vacio') }} </p>
                    @endforelse               
                </ul>
                <div class="bottom">
                    <div class="total">
                        <span>Total</span>
                        <span class="total-amount">${{ number_format(Cart::getTotal(), 2, '.', '') }}</span>
                    </div>
                    
                        @if(!\Cart::isEmpty())
                        <div class="button">
                            <a href="{{ route('checkout') }}" class="btn animate">Finalizar Compra</a>
                        </div>
                        @endif            
                    
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            window.addEventListener('reload-scrollBar', () => {
                var ps = new PerfectScrollbar('.shopping-list', {
                    wheelSpeed: 1,
                    wheelPropagation: true,
                    minScrollbarLength: 20
                });
            })

            var ps = new PerfectScrollbar('.shopping-list', {
                wheelSpeed: 1,
                wheelPropagation: true,
                minScrollbarLength: 20
            });
        </script>
    @endpush
</div>
