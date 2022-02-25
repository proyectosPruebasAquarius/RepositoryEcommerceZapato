@extends('frontend.index')

@section('title')
    Productos - Ecommerce
@endsection

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">                
                <p class="bread"><span><a href="{{ url('/') }}">Inicio</a></span> / <span>Productos</span></p>
            </div>
        </div>
    </div>

    @livewire('frontend.unfilter-products')
</div>
@endsection