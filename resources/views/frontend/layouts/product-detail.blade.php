@extends('frontend.index')

@section('title')
    {{ $producto .' - Ecommerce' }}
@endsection

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="{{ url('/') }}">Inicio</a></span> / <span><a href="{{ route('product.views', $title) }}">{{ $title }}</a></span> / <span><a href="{{ route('product.filter', [$title, $subTitle]) }}">{{ $subTitle }}</a></span> / <span>{{ $producto }}</span></p>
            </div>
        </div>
    </div>
</div>

<b class="screen-overlay"></b>
<!-- offcanvas panel right -->
<aside class="offcanvas-product offcanvas-right" id="my_offcanvas2">
    <header class="p-4 bg-light border-bottom">
      
      <h6 class="mb-0">Producto agregado al carrito </h6>
    </header>
    {{-- <nav class="list-group list-group-flush">
      <a href="#" class="list-group-item">Home</a>
      <a href="#" class="list-group-item">About us</a>
      <a href="#" class="list-group-item">Menu name 1</a>
      <a href="#" class="list-group-item">Menu name 2</a>
      <a href="#" class="list-group-item">Menu name 3</a>
    </nav> --}}
    <div class="offcanvas-body">
        
    </div>
  </aside>
  <!-- offcanvas panel right .end -->

@livewire('frontend.details', ['name' => $producto])
@endsection

@push('scripts')
    <script>
        window.addEventListener('show-canvas', event => {
            var offcanvas = document.getElementById('my_offcanvas2');
            offcanvas.classList.add('show');
            offcanvas.classList.add('offcanvas-active');
            document.querySelector('.screen-overlay').classList.add('show');
            let data = '';

            data += '<div class="card border-link">'
                data += '<div class="card-body">'
                    /* mb-3 ms-md-3 */
                    var img = event.detail.data['attributes']['image'] ? 'http://3.135.184.132/storage/'+JSON.parse(event.detail.data['attributes']['image'])[0] : @js(asset('frontend/img/no-picture-frame.svg'));
                    data += '<img src="'+img+'" class="col-12 col-md-6 float-md-start rounded img-fluid img-thumbnail me-md-3 border-0" alt="'+event.detail.data['attributes']['image']+'" width="70px" height="100px">'
                    data += '<h6 class="card-title">'+event.detail.data['name']+'</h6>'
                    data += '<p class="card-text">Unidades: '+event.detail.data['quantity']+'</p>'
                    data += '<p class="card-text">$'+(Math.round(event.detail.data['price']*event.detail.data['quantity'] * 100) / 100).toFixed(2)+'</p>'


                data += '</div>'

            data += '</div>'
            data += '<a type="button" class="btn  col-12 mt-2 text-white" style="background-color: #0d6efd !important;" href="{{ url('/carrito') }}">Continuar con la Compra</a>'
            document.querySelector('.offcanvas-body').innerHTML = data;
            setTimeout(() => {
                offcanvas.classList.remove('show');
                offcanvas.classList.remove('offcanvas-active');
                document.querySelector('.screen-overlay').classList.remove('show');
            }, 4000);
        })           
    </script>
@endpush