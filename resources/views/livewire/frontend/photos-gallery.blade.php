<div>
    <div class="owl-carousel">
        @forelse ($imagenes as $photo)
            <div class="item">
                <div class="product-entry border">
                    <a href="#" class="prod-img">
                        <img src="{{ asset('storage/'.  $photo) }}" class="img-fluid" alt="Product Image">
                    </a>
                </div>
            </div>
        @empty
            
        @endforelse
    </div>
</div>
