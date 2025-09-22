<div class="">
@php
    $isProductDetail = request()->routeIs('product.detail'); // adjust route name if needed
@endphp

@if($isProductDetail)
    {{-- Product Detail Page Button --}}
    <a href="javascript:void(0);" 
       wire:click="addToCart" 
       class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart">
        <span>Add to cart</span>
    </a>
@else
{{-- Other Pages (Shop, Wishlist, etc.) --}}
    {{-- <button 
        wire:click="addToCart" 
        class="box-icon bg-white shadow-md hover:bg-black hover:text-white border-0 !outline-none">
        <span class="icon icon-bag"></span>
        <span class="tooltip">Add to cart</span>
    </button> --}}
    
@endif
</div>

