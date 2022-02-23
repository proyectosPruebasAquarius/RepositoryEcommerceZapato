@extends('frontend.index')

@section('title', 'Ecommerce - Checkout')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Finalizar Compra</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ url('/') }}">Inicio</a>
                            <a href="{{ route('cart') }}">Carrito</a>
                            <span>Finalizar Compra</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    @livewire('frontend.checkout')
    <!-- Checkout Section End -->
    
@endsection