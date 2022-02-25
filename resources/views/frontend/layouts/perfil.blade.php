@extends('frontend.index')

@section('title', 'Perfil - Ecommerce')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="{{ url('/') }}">Inicio</a></span> / <span>Perfil</span></p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <nav class="header__menu_tabs">
                        <ul class="nav  mb-3 list-inline d-flex justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item list-inline-item active">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Datos Personales</a>
                            </li>
                            <li class="nav-item list-inline-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Direcciones</a>
                            </li>
                            <li class="nav-item list-inline-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Valoraciones</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <span>
                                <div class="card border-0">
                                    <div class="card-body p-0 mx-auto">
                                        <img src="{{ asset('frontend/images/user.svg') }}" alt="User img" style="height: 100px; width: 100px">
                                    </div>
                                </div>
                            </span>
                            <div class="mx-auto text-center">
                                <span><i class="icon-calendar"></i> {{ date('d-m-Y', strtotime(auth()->user()->created_at)) }}</span>
                                <h5>{{ auth()->user()->name }}</h5>
                                <h6 style="letter-spacing: 3px;"><i class="fa fa-envelope text-warning" aria-hidden="true"></i> {{ auth()->user()->email }}</h6>
                                <h6 class="mt-3" style="letter-spacing: 3px;"><i class="fa fa-phone-square text-success" aria-hidden="true"></i> {{ auth()->user()->telefono ? auth()->user()->telefono : '...' }}</h6>
                                <a type="button" data-toggle="modal" data-target="#profileModal" class="mt-3">Editar Perfil</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row">
                                <div class="col-12 col-md-2">
                                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Dirección de envío</a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Dirección de facturación</a>
                                  </div>
                                </div>
                                <div class="col-12 col-md-10">
                                  <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        {{-- Inicio Tabla --}}
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-left"><b>Dirección de envío</b></th>
                                                        {{-- <th scope="col">Dirección de facturación</th> --}}
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
            
                                                    @forelse ($direcciones as $direccion)
                                                        <tr class="border-bottom">
                                                            <th scope="row" class="text-left text-muted" >{{ $direccion->direccion . ', ' . $direccion->departamento . ' - ' . $direccion->municipio }}. <br /> 
                                                                <b class="text-dark">{{ __('Referencia') }}</b> <br />
                                                                <span class="text-muted">{{ $direccion->referencia }}</span>
                                                            </th>
                                                            {{-- <th>Caserio Canyuco, canton chiapas. Chalatenango - Chalatenango</th> --}}
                                                            <th>
                                                                <button class="btn btn-default" onclick="Livewire.emit('setValuesD', @js($direccion))" data-toggle="modal" data-target="#direccionesModal"><i class="fal fa-edit text-success" aria-hidden="true"></i></button>
                                                                <button class="btn btn-default" onclick="trash(@js($direccion->id), 'envio')"><i class="fal fa-trash-alt text-danger" aria-hidden="true"></i></button>
                                                            </th>                                                
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <th colspan="2" class="text-center text-muted">No se encontraron datos de dirección.</th>
                                                        </tr>
                                                    @endforelse
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <button class="btn btn-outline-dark text-center mx-auto" data-toggle="modal" data-target="#direccionesModal">Agregar Dirección de envío <i class="fa fa-plus" aria-hidden="true"></i></button>
                                        {{-- Fin Tabla --}}
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        {{-- Inicio Tabla Facturacion --}}
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-left"><b>Dirección de facturación</b></th>
                                                        {{-- <th scope="col">Dirección de facturación</th> --}}
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
            
                                                    @forelse ($facturaciones as $direccion)
                                                        <tr class="border-bottom">
                                                            <th scope="row" class="text-left text-muted" >{{ $direccion->direccion . ', ' . $direccion->departamento . ' - ' . $direccion->municipio }}. <br /> 
                                                                <b class="text-dark">{{ __('Referencia') }}</b> <br />
                                                                <span class="text-muted">{{ $direccion->referencia }}</span>
                                                            </th>
                                                            {{-- <th>Caserio Canyuco, canton chiapas. Chalatenango - Chalatenango</th> --}}
                                                            <th>
                                                                <button class="btn btn-default" onclick="Livewire.emit('setIsFacturacion'); Livewire.emit('setValuesD', @js($direccion));" data-toggle="modal" data-target="#direccionesModal"><i class="fal fa-edit text-success" aria-hidden="true"></i></button>
                                                                <button class="btn btn-default" onclick="trash(@js($direccion->id), 'facturacion')"><i class="fal fa-trash-alt text-danger" aria-hidden="true"></i></button>
                                                            </th>                                                
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <th colspan="2" class="text-center text-muted">No se encontraron datos de dirección.</th>
                                                        </tr>
                                                    @endforelse
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <button class="btn btn-outline-dark text-center mx-auto" onclick="Livewire.emit('setIsFacturacion')" data-toggle="modal" data-target="#direccionesModal">Agregar Dirección de facturación <i class="fa fa-plus" aria-hidden="true"></i></button>
                                        {{-- Fin Tabla Facturacion --}}
                                    </div>
                                  </div>
                                </div>
                              </div>                            
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            @forelse ($valoraciones as $valoracion)
                                <div class="row mb-2">
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="card text-center w-auto border-0">                                  
                                            <div class="card-body">
                                                <h4 class="card-title text-danger">
                                                    <button class="btn btn-default link"type="button" href="{{ route('product.detail', [$valoracion->categoria, $valoracion->sub_categoria, $valoracion->nombre]) }}" onclick="location.href='{{ route('product.detail', [$valoracion->categoria, $valoracion->sub_categoria, $valoracion->nombre])}}'">{{ $valoracion->nombre }}</button>
                                                    <br>
                                                    <i class="fa @if ($valoracion->rating == 0.5) fa-star-half-o @elseif($valoracion->rating >= 1) fa-star @else fa-star-o @endif"></i>
                                                    <i class="fa @if ($valoracion->rating == 1.5) fa-star-half-o @elseif($valoracion->rating >= 2) fa-star @else fa-star-o @endif"></i>
                                                    <i class="fa @if ($valoracion->rating == 2.5) fa-star-half-o @elseif($valoracion->rating >= 3) fa-star @else fa-star-o @endif"></i>
                                                    <i class="fa @if ($valoracion->rating == 3.5) fa-star-half-o @elseif($valoracion->rating >= 4) fa-star @else fa-star-o @endif"></i>
                                                    <i class="fa @if ($valoracion->rating == 4.5) fa-star-half-o @elseif($valoracion->rating == 5) fa-star @else fa-star-o @endif"></i>  
                                                </h4>
                                              @if($valoracion->title && $valoracion->descripcion)
                                                <p class="card-text">
                                                    {{ $valoracion->title }}
                                                    <br>
                                                    {{ $valoracion->descripcion }}
                                                    
                                                </p>
                                              @endif
                                              <hr>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                            @empty
                                {{ __('No haz realizado ninguna valoración.') }}
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('frontend.direcciones')
    @livewire('frontend.edit-profile')

    @push('scripts')
    <script>
        'use strict';
        (function() {
            let uls = document.querySelector('.header__menu_tabs').querySelector('ul');
            let lis = uls.querySelectorAll('li');
            lis.forEach(e => {
                e.addEventListener('click', () => {
                    lis.forEach(e => {
                        e.classList.remove('active')
                    })
                    e.classList.add('active')
                }, false);
            });
        }())

        var trash = (id, type) => {
            if (type == 'facturacion') {
                Livewire.emit('setIsFacturacion');
            }

            Swal.fire({
            title: '¿Estás seguro que deseas eliminar este dato?',
            text: "¡Está acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('trashD', id)
            } else {
                Livewire.emit('cleanDirecciones');
            }
        })
        }
    </script>
    @endpush
</div>
@endsection