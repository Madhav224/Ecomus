
    <div class="swiper-slide" wire:key="pdt{{ encrypt_to($product->id) }}" lazy="true">
    <div class="card-product">

        {{-- Product Image --}}
        <div class="card-product-wrapper relative group">
            @php
                $images = is_array($product->product_images)
                    ? $product->product_images
                    : (json_decode($product->product_images, true) ?? []);

                $main_image = $product->product_thumbnail_image_url ?? ($images[0] ?? asset('frontend/images/products/default.png'));
                $hover_image = $images[1] ?? $main_image;
            @endphp

            <a href="{{ route('product.detail', $product->product_slug) }}" class="product-img block relative aspect-[3/4] overflow-hidden">
                <img 
                    class="lazyload img-product w-full h-full object-cover transition-opacity duration-700 group-hover:opacity-0"
                    data-src="{{ $main_image }}"
                    src="{{ $main_image }}"
                    alt="{{ $product->product_name }}"
                >
                
    @if ($hover_image)
        <img 
            class="lazyload img-hover absolute inset-0 w-full h-full object-cover transition-opacity duration-700 group-hover:opacity-100"
            data-src="{{ asset($hover_image) }}"
            src="{{ asset($hover_image) }}"
            alt="{{ $product->product_name }} hover"
        >
    @endif

            </a>

            {{-- Action Buttons --}}
            <div class="list-product-btn absolute top-3 right-3 flex flex-col gap-2">
                {{-- Add to Cart --}}
                <livewire:cart-button :product-id="$product->id" {{--:variant-id="$selectedVariantId"--}} />


                {{-- Wishlist --}}
               
                <livewire:wishlist-button :productId="$product->id" />


                {{-- Quick View --}}
                {{-- <a href="javascript:void(0)" 
                   data-url="{{ route('quick.view', $product->id) }}"
                   data-bs-toggle="modal" 
                   data-bs-target="#quick_view"
                   class="box-icon bg_white quickview tf-btn-loading"
                >
                    <span class="icon icon-view"></span>
                    <span class="tooltip">Quick View</span>
                </a> --}}
               
            </div>
        </div>

        {{-- Product Info --}}
        <div class="card-product-info mt-3 text-center">
            <a href="{{ route('product.detail', $product->product_slug) }}" class="title link font-semibold">
                {{ $product->product_name }}
            </a>

            {{-- Pricing --}}
            <div class="mt-1">
                <span class="price font-bold text-gray-900">
                    ₹{{ number_format($product->product_price, 2) }}
                </span>
                @if($product->product_discount)
                    <del class="text-gray-300 text-sm ml-2">
                        ₹{{ number_format($product->product_mrp, 2) }}
                    </del>
                @endif
            </div>
        </div>
    </div>
</div>
