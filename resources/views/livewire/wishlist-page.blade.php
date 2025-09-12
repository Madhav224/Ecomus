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
                    <p class="text-center w-full">Your wishlist is empty.</p>
                @endforelse
            </div>
        </div>
</section>
<!-- /Section Product -->

</div>
