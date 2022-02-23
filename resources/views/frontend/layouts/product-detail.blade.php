@extends('frontend.index')

@section('title')

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


@livewire('frontend.details', ['name' => $producto])
@endsection