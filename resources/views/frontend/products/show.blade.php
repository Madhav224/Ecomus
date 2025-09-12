@extends('frontend.layouts.app')

@section('title')
    @isset($product)
        {{ $product->product_name }}
    @else
        Product | My Shop
    @endisset
@endsection

@section('content')
{{-- <div class="container my-8">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6">
            @php
                $images = $product->product_images_url;
                $mainImage = $images[0] ?? $product->product_thumbnail_image_url;
            @endphp

            <div class="product-main-image mb-3">
                <img src="{{ $mainImage }}" alt="{{ $product->product_name }}" class="img-fluid">
            </div>

            @if(count($images) > 1)
            <div class="product-gallery d-flex gap-2">
                @foreach($images as $img)
                    <img src="{{ $img }}" alt="{{ $product->product_name }}" class="img-thumbnail" style="width:60px;height:60px;">
                @endforeach
            </div>
            @endif
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h1 class="product-title">{{ $product->product_name }}</h1>

            <div class="product-price mb-3">
                @if($product->product_discount)
                    <del>₹{{ number_format($product->product_mrp, 2) }}</del>
                    <span class="text-danger">₹{{ number_format($product->product_price, 2) }}</span>
                @else
                    <span>₹{{ number_format($product->product_price, 2) }}</span>
                @endif
            </div>

            <!-- Product Variants -->
            @if(!empty($product->size_variants))
            <div class="product-sizes mb-3">
                <label>Sizes:</label>
                <select class="form-select">
                    @foreach($product->size_variants as $size)
                        <option value="{{ $size['id'] }}">{{ $size['variant_value'] }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            @if(!empty($product->color_variants))
            <div class="product-colors mb-3">
                <label>Colors:</label>
                <div class="d-flex gap-2">
                    @foreach($product->color_variants as $color)
                        <div style="width:24px;height:24px;background:{{ $color['variant_value'] }};border:1px solid #ddd;border-radius:50%;"></div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Add to Cart -->
            <div class="mt-4">
                <form method="POST" action="{{ route('cart.add', $product->product_slug) }}" >
                    @csrf
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>

            <!-- Short Description -->
            @if(!empty($product->product_details))
                <div class="product-description mt-3">
                    <p>{{ $product->product_details['short_description'] ?? '' }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Full Description / Tabs (Optional) -->
    @if(!empty($product->product_details['full_description']))
    <div class="mt-5">
        <h4>Description</h4>
        <p>{{ $product->product_details['full_description'] }}</p>
    </div>
    @endif
</div> --}}

<style>
.color-batch {
    display: inline-block;  
}
.color-pill-label {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 4px 8px;
    border-radius: 20px;
    border: 2px solid #ccc;
    cursor: pointer;
    transition: all 0.2s;
    user-select: none;
}
.color-pill-label:hover {
    border-color: #000000;
}
label.size-pill {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 50%; /* makes it round */
    border: 2px solid #353232d5 !important;
    color: #1b1c1d;
    cursor: pointer;
    font-weight: 600;
    font-size: 18px;
    transition: all 0.2s;
    text-align: center;
      text-transform: uppercase; 
      margin-bottom: 30px;
}
label.size-pill:hover {
  border: 2px solid #000 !important;
}
</style>


         <livewire:product-detail :slug="$slug" />


         
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const thumbsSwiper = new Swiper(".tf-product-media-thumbs", {
        direction: "vertical",
        slidesPerView: 4,
        spaceBetween: 10,
        watchSlidesProgress: true,
    });

    const mainSwiper = new Swiper(".tf-product-media-main", {
        loop: true,
        navigation: {
            nextEl: ".thumbs-next",
            prevEl: ".thumbs-prev",
        },
        thumbs: {
            swiper: thumbsSwiper,
        },
    });
});

</script>

       
@endsection
