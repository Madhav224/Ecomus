{{-- <div>
    @php
    $product = \App\Models\Product::where('product_slug', $slug)->first();

    if ($product) {
        $images = is_array($product->product_images)
            ? $product->product_images
            : (json_decode($product->product_images, true) ?? []);

        $thumbnail = $product->product_thumbnail_image_url 
            ?? ($images[0] ?? asset('frontend/images/products/default.png'));

        $hover = $images[1] ?? null;
    }
@endphp

@if($product)
    <div class="card-product fl-item" wire:key="pdt{{ encrypt_to($product->id) }}">>
        <div class="card-product-wrapper">
            <a href="{{ route('product.details', $product->product_slug) }}" class="product-img">
                <img class="lazyload img-product"
                    data-src="{{ $thumbnail }}"
                    src="{{ $thumbnail }}"
                    alt="{{ $product->product_name }}">
                @if($hover)
                    <img class="lazyload img-hover"
                        data-src="{{ $hover }}"
                        src="{{ $hover }}"
                        alt="{{ $product->product_name }}">
                @endif
            </a>

            @if(!empty($product->size_variants))
                <div class="size-list">
                    @foreach($product->size_variants as $size)
                        <span>{{ $size['variant_value'] }}</span>
                    @endforeach
                </div>
            @endif

            
            <div class="list-product-btn">
                <a href="#quick_add" data-bs-toggle="modal"
                   class="box-icon bg_white quick-add tf-btn-loading">
                    <span class="icon icon-bag"></span>
                    <span class="tooltip">Quick Add</span>
                </a>

                <a href="javascript:void(0)" 
                   class="box-icon bg_white wishlist btn-icon-action">
                    <span class="icon icon-heart"></span>
                    <span class="tooltip">Add to Wishlist</span>
                    <span class="icon icon-delete"></span>
                </a>

                <a href="javascript:void(0)"
                   class="quick-view-btn box-icon bg_white"
                   data-url="{{ route('quick.view', $product->id) }}"
                   data-bs-toggle="modal"
                   data-bs-target="#quick_view">
                    <span class="icon icon-view"></span>
                    <span class="tooltip">Quick View</span>
                </a>
            </div>
        </div>

        <div class="card-product-info">
            <a href="{{ route('product.details', $product->product_slug) }}" class="title link">
                {{ $product->product_name }}
            </a>

            <span class="price">
                @if($product->product_discount)
                    <del>₹{{ number_format($product->product_mrp, 2) }}</del>
                    ₹{{ number_format($product->product_price, 2) }}
                @else
                    ₹{{ number_format($product->product_price, 2) }}
                @endif
            </span>
        </div>
    </div>
 
@endif

</div> --}}


<div class="swiper-slide" wire:key="pdt{{ encrypt_to($product->id) }}">
    <div class="product-item product-detail-item grid-type">
        <div class="product-main cursor-pointer block">
            <div class="product-thumb bg-white relative overflow-hidden rounded-2xl">

                @if ($product->isNewProduct())
                    <div
                        class="product-tag text-button-uppercase bg-green px-3 py-0.5 inline-block rounded-full absolute top-3 left-3 z-[1]">
                        New
                    </div>
                @endif

                <!-- Wishlist -->
                <div class="list-action-right absolute top-3 right-3 max-lg:hidden">
                    <div
                        class="add-wishlist-btn w-[32px] h-[32px] flex items-center justify-center rounded-full bg-white duration-300 relative">
                        <div class="tag-action bg-black text-white caption2 px-1.5 py-0.5 rounded-sm ">
                            Add To Wishlist
                        </div>
                        <i class="ph ph-heart text-lg"></i>
                    </div>
                </div>

                @php
                    $images = is_array($product->product_images)
                        ? $product->product_images
                        : (json_decode($product->product_images, true) ?? []);

                    $main_image_1 = $product->product_thumbnail_image_url ?? ($images[0] ?? asset('frontend/images/products/default.png'));
                    $main_image_2 = $images[1] ?? $main_image_1;
                @endphp

                <!-- Product Images -->
                <a href="{{ route('product.details', $product->product_slug) }}">
                    <div class="product-img w-full h-full aspect-[3/4]">
                        <img key="0" class="w-full h-full object-cover duration-700 product-item-mainimg1"
                             src="{{ $main_image_1 }}" alt="{{ $product->product_name }}">
                        <img key="1" class="w-full h-full object-cover duration-700 product-item-mainimg2"
                             src="{{ $main_image_2 }}" alt="{{ $product->product_name }}">
                    </div>
                </a>

                

                <!-- Add to Cart -->
                <div class="list-action add_cart_container px-5 absolute w-full bottom-5">
                    <input type="hidden" class="cart_product_qty" value="1">
                    <input type="hidden" class="cart_product_id" value="{{ encrypt_to($product->id) }}">
                    <button
                        class="product-add-cart w-full text-button-uppercase py-2 text-center rounded-full bg-white hover:bg-black hover:text-white">
                        <span class="max-lg:hidden">Add To Cart</span>
                        <i class="ph ph-shopping-bag-open lg:hidden text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-infor mt-4 lg:mb-7">
                <div class="product-name text-title duration-300">
                    {{ $product->product_name }}
                </div>

                @if(!empty($product->size_variants))
                    <div class="list-color list-color-image max-md:hidden flex items-center gap-3 flex-wrap duration-500">
                        @foreach($product->size_variants as $index => $size)
                            <div class="color-item product-color-item w-12 h-12 rounded-xl duration-300 relative {{ $index == 0 ? 'active' : '' }}">
                                <span class="flex items-center justify-center w-full h-full rounded-xl bg-gray-100 text-sm">
                                    {{ $size['variant_value'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="product-price-block flex items-center gap-2 flex-wrap mt-1 duration-300 relative z-[1]">
                    <div class="product-price text-title">₹{{ number_format($product->product_price, 2) }}</div>
                    @if($product->product_discount)
                        <div class="product-origin-price caption1 text-secondary2">
                            <del>₹{{ number_format($product->product_mrp, 2) }}</del>
                        </div>
                        <div class="product-sale caption1 font-medium bg-green px-3 py-0.5 inline-block rounded-full">
                            {{ $product->product_discount }}%
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>











{{-- 
<div class="swiper-slide" wire:key="pdt{{ encrypt_to($product->id) }}">
    <div class="product-item product-detail-item grid-type">
        <div class="product-main cursor-pointer block">
            <div class="product-thumb bg-white relative overflow-hidden rounded-2xl">

                @if ($product->isNewProduct())
                    <div
                        class="product-tag text-button-uppercase bg-green px-3 py-0.5 inline-block rounded-full absolute top-3 left-3 z-[1]">
                        New
                    </div>
                @endif
                <!-- Wishlist / Compare buttons -->
                <div class="list-action-right  absolute top-3 right-3 max-lg:hidden">
             
                    <div
                        class="add-wishlist-btn  w-[32px] h-[32px] flex items-center justify-center rounded-full bg-white duration-300 relative {{ $wishlistActive ? 'active' : '' }}">
                        <div class="tag-action bg-black text-white caption2 px-1.5 py-0.5 rounded-sm ">
                            Add To Wishlist</div>
                        <i class="{{ $wishlistActive ? 'ph-heart text-lg ph-fill' : 'ph ph-heart text-lg' }}"></i>
                      
                    </div>
                    
                </div>

             
                <?php

                $firstVariant = $productVariant->first();

                $main_image_1 = $firstVariant?->product_variant_thumbnail_image_url ?? $product?->product_thumbnail_image_url;
                $main_image_2 = $firstVariant?->product_variant_images_url ? $firstVariant?->product_variant_images_url[1] ?? ($firstVariant?->product_variant_images_url[0] ?? $main_image_1) : $product->product_images_url[1] ?? ($product->product_images_url[0] ?? $main_image_1);

                ?>

                <!-- Product images -->
                <a href="{{ route('product.details', $product->product_slug) }}">
                    <div class="product-img w-full h-full aspect-[3/4]">
                        <img key="0" class="w-full h-full object-cover duration-700 product-item-mainimg1"
                            src="{{ $main_image_1 }}" alt="img">
                        <img key="1" class="w-full h-full object-cover duration-700 product-item-mainimg2"
                            src="{{ $main_image_2 }}" alt="img">
                    </div>
                </a>
                <!-- Action buttons -->
                <div class="list-action add_cart_container px-5 absolute w-full bottom-5">
                   
                    <input type="hidden" class="cart_product_qty" value="1">
                    <input type="hidden" class="cart_product_id" value="{{ encrypt_to($product?->id) }}">
                    <input type="hidden" class="cart_product_variant_id"
                        value="{{ encrypt_to($firstVariant?->id ?? 0) }}">
                    <button
                        class="product-add-cart w-full text-button-uppercase py-2 text-center rounded-full  bg-white hover:bg-black hover:text-white">
                        <span class="max-lg:hidden">Add To Cart</span>
                        <i class="ph ph-shopping-bag-open lg:hidden text-xl"></i>
                    </button>

                </div>
            </div>

            <!-- Product Info -->
            <div class="product-infor mt-4 lg:mb-7">
               
                <div class="product-name text-title duration-300">
                    {{ $product->product_name }}
                </div>

                <div class="list-color list-color-image max-md:hidden flex items-center gap-3 flex-wrap duration-500">
                    @foreach ($productVariant as $index => $variant)
                        <div class="color-item product-color-item w-12 h-12 rounded-xl duration-300 relative {{ $index == 0 ? 'active' : '' }}"
                            data-default1="{{ $product->product_thumbnail_image_url }}"
                            data-default2="{{ $product->product_images_url[1] ?? ($product->product_images_url[0] ?? $product->product_thumbnail_image_url) }}"
                            data-vid="{{ encrypt_to($variant?->id) }}" data-did="{{ encrypt_to(0) }}"
                            data-variantimg1="{{ $variant?->product_variant_thumbnail_image_url ?? $product?->product_thumbnail_image_url }}"
                            data-variantimg2="{{ $variant?->product_variant_images_url[1] ??
                                ($variant?->product_variant_images_url[0] ?? $product?->product_thumbnail_image_url) }}">

                            <img src="{{ $variant?->product_variant_thumbnail_image_url ?? $product?->product_thumbnail_image_url }}"
                                alt="{{ $variant?->product_variant_thumbnail_image_url ?? $product?->product_thumbnail_image_url }}"
                                class="rounded-xl w-full h-full ">
                            <div class="tag-action bg-black text-white caption2 capitalize px-1.5 py-0.5 rounded-sm">
                                {{ implode('/', $variant?->variant_combination) }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="product-price-block flex items-center gap-2 flex-wrap mt-1 duration-300 relative z-[1]">
                    <div class="product-price text-title">&#8377;{{ $product->product_price }}
                    </div>
                    <div class="product-origin-price caption1 text-secondary2">
                        <del>&#8377;{{ $product->product_mrp }}</del>
                    </div>
                    <div class="product-sale caption1 font-medium bg-green px-3 py-0.5 inline-block rounded-full">
                        {{ $product->product_discount }}%</div>
                </div>
            </div>
        </div>
    </div>
</div>



 --}}

