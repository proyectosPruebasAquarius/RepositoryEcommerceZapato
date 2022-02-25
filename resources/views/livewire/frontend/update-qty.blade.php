<div>
    <div class="pro-qty-2"> 
        <span class="fa fa-angle-left dec qtybtn {{-- @if ($cartItems['quantity'] == 1) d-none @endif --}}"></span>
        <input type="number" min="1" max="{{ $maxQuantity }}" value="{{ $cartItems['quantity'] }}" id="count{{ $cartItems['id'] }}" name="{{ $cartItems['id'] }}">
        <span class="fa fa-angle-right inc qtybtn"></span>
    </div>
</div>
