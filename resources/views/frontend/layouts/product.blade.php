@extends('frontend.index')

@section('title')
    {{ ucfirst($subTitle) }} - Ecommerce
@endsection

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                @php
                    if (strpos($subTitle, '+')) {
                        $newTitle = str_replace('+', ' ', $subTitle);            
                    } else {
                        $newTitle = $subTitle;
                    }
                @endphp
                <p class="bread"><span><a href="{{ url('/') }}">Inicio</a></span> / <span><a href="{{ route('product.views', $title) }}">{{ $title }}</a></span> / <span>{{ $newTitle }}</span></p>
            </div>
        </div>
    </div>

    @livewire('frontend.grids', ['categoria' => $title, 'sub_categoria' => $newTitle])
</div>
@endsection