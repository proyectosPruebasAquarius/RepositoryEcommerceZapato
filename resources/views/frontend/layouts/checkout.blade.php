@extends('frontend.index')

@section('title', 'Ecommerce - Checkout')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="{{ url('/') }}">Inicio</a></span> / <span><a href="{{ route('cart') }}">Carrito</a></span> / <span>Finalizar Compra</span></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    @livewire('frontend.checkout')
    <!-- Checkout Section End -->
    
@endsection