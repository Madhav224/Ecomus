<div>
    <!-- page-title -->
<div class="tf-page-title">
    <div class="container-full">
        <div class="heading text-center">Your wishlist</div>
    </div>
</div>
<!-- /page-title -->

<!-- Section Product -->
<section class="flat-spacing-2">
    <div class="container">
            <div class="grid-layout wrapper-shop" data-grid="grid-4">
                @forelse($wishlistItems as $item)
                    {{-- <x-product-card :product="$item->product" in-wishlist="true" /> --}}
                         <x-product-card :slug="$item->product?->product_slug" />
                @empty
                    <div class="text-center w-full" hidden>
                        
                        </div>
                @endforelse
            </div>
            @if($wishlistItems->isEmpty())
                    <div class="text-center w-full">
                         <img src="{{asset('upload/no-product-found.webp')}} " alt="">
                        <h5>Your wishlist is empty.</h5></div>

            @endif
        </div>
</section>
<!-- /Section Product -->

</div>
