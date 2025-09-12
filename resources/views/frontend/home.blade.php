@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<style>
    .brand-item img {
    width: 150px;        /* fixed width */
    height: 70px;        /* fixed height */
    object-fit: contain; /* keeps aspect ratio */
    display: block;
}
</style>
      <!-- Slider -->
       <section class="tf-slideshow slideshow-effect slider-effect-fade position-relative">
                    <div dir="ltr" class="swiper tf-sw-slideshow"
                        data-preview="1" data-tablet="1" data-mobile="1"
                        data-centered="false" data-space="0" data-loop="true"
                        data-auto-play="true" data-delay="3500" data-speed="2000">

                        <div class="swiper-wrapper">
                            @foreach($sliders as $slide)
                                <div class="swiper-slide" lazy="true">
                                    <div class="slider-effect wrap-slider">
                                        <div class="content-left">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="box-content">
                                                            <h1 class="heading fade-item fade-item-1">{{ $slide->heading_text }}</h1>
                                                            <p class="desc fade-item fade-item-2">{{ $slide->sub_heading_text }}</p>

                                                            @if($slide->link)
                                                                <a href="{{route('shop')}}"
                                                                class="fade-item fade-item-3 tf-btn btn-light-icon animate-hover-btn btn-xl radius-3">
                                                                <span>Shop collection</span>
                                                                <i class="icon icon-arrow-right"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="img-slider">
                                         <img class="lazyload"
                                         data-src="{{ asset($slide->image) }}"
                                         src="{{ asset($slide->image) }}"
                                         alt="{{ $slide->heading_text }}">  
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="wrap-pagination">
                        <div class="container">
                            <div class="sw-dots line-pagination sw-pagination-slider"></div>
                        </div>
                    </div>
                </section>

        <!-- /Slider -->

       <!-- Collection -->
<section class="flat-spacing-12 bg_grey-3">
    <div class="container">
        <div class="flat-title flex-row justify-content-between align-items-center px-0 wow fadeInUp"
            data-wow-delay="0s">
            <h3 class="title">Season Collection</h3>
            <a href="{{ route('shop') }}" class="tf-btn btn-line">View all categories<i
                    class="icon icon-arrow1-top-left"></i></a>
        </div>
        <div class="hover-sw-nav hover-sw-2">
            <div dir="ltr" class="swiper tf-sw-collection" data-preview="6" data-tablet="3" data-mobile="2"
                data-space-lg="50" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                <div class="swiper-wrapper">
                    @forelse($categories as $category)
                        <div class="swiper-slide" lazy="true">
                            <div class="collection-item-circle hover-img">
                                <a href="{{ route('shop', $category->categorie_slug) }}" class="collection-image img-style">

                                    @php
                                        $bannerImage = $category->images->where('categorie_image_type', 'banner')->first();
                                        $imagePath = $bannerImage ? json_decode($bannerImage->categorie_image_path)[0] : 'images/collections/collection-circle-1.jpg';
                                    @endphp
                                    <img class="lazyload" 
                                         data-src="{{ asset($imagePath) }}"
                                         src="{{ asset($imagePath) }}" 
                                         alt="{{ $category->categorie_name }}">
                                </a>
                                <div class="collection-content text-center">
                                    <a href="{{ route('shop', $category->categorie_slug) }}" 
                                        class="link title fw-5">{{ $category->categorie_name }}</a>

                                    <div class="count">Available</div> {{-- Static text instead of count --}}
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback if no categories -->
                        <div class="swiper-slide">
                            <div class="collection-item-circle hover-img">
                                <div class="collection-content text-center">
                                    <p>No categories available</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="sw-dots style-2 sw-pagination-collection justify-content-center"></div>
            <div class="nav-sw nav-next-slider nav-next-collection"><span class="icon icon-arrow-left"></span>
            </div>
            <div class="nav-sw nav-prev-slider nav-prev-collection"><span class="icon icon-arrow-right"></span>
            </div>
        </div>
    </div>
</section>
<!-- /Collection -->
      

         <!-- Sale Product -->
        <section class="flat-spacing-17">
            <div class="container">
                <div class="flat-animate-tab">
                    <ul class="widget-tab-3 d-flex justify-content-center wow fadeInUp" data-wow-delay="0s"
                        role="tablist">
                        <li class="nav-tab-item" role="presentation">
                            <a href="#bestSeller" class="active" data-bs-toggle="tab">Best seller</a>
                        </li>
                        {{-- <li class="nav-tab-item" role="presentation">
                            <a href="#newArrivals" data-bs-toggle="tab">New arrivals</a>
                        </li>
                        <li class="nav-tab-item" role="presentation">
                            <a href="#onSale" data-bs-toggle="tab">On Sale</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content">
                       <div class="tab-pane active show" id="bestSeller" role="tabpanel">
                                <div class="grid-layout loadmore-item" data-grid="grid-4">
                                    @foreach ($products as $product)
                                    <div wire:loading.remove>
                                        {{-- wire:target="loadProducts" --}}
                                        <x-product-card :slug="$product?->product_slug" />
                                    </div>
                                    @endforeach
                                </div>

                               
                            </div>


                        <div class="tab-pane" id="newArrivals" role="tabpanel">
                            <div class="grid-layout loadmore-item" data-grid="grid-4">
                                    
                            </div>

                            
                        </div>
                        <div class="tab-pane" id="onSale" role="tabpanel">
                            <div class="grid-layout loadmore-item" data-grid="grid-4">

                            </div>
 
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /Sale Product -->


       <!-- Banner Collection -->
<section>
    <div class="container-full">
        <div dir="ltr" class="swiper tf-sw-recent" 
             data-preview="3" data-tablet="3" data-mobile="1.3"
             data-space-lg="30" data-space-md="15" data-space="15" 
             data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
            
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                    <div class="swiper-slide" lazy="true">
                        <div class="collection-item-v4 hover-img">
                            <div class="collection-inner">
                                <a href="{{ route('shop') }}" class="collection-image img-style">
                                    <img class="lazyload " style="height: 500px; object-fit: cover;"
                                        data-src="{{ $banner->image }}"
                                        src="{{ $banner->image }}"
                                        alt="{{ $banner->heading_text }}">
                                </a>
                                <div class="collection-content wow fadeInUp" data-wow-delay="0s">
                                    <p class="subheading">{{ $banner->sub_heading_text ?? 'Special Offer' }}</p>
                                    <h5 class="heading">{{ $banner->heading_text ?? 'Collection' }}</h5>
                                    <a href="{{ route('shop') }}"
                                       class="tf-btn style-3 fw-6 btn-light-icon radius-3 animate-hover-btn">
                                       <span>Shop now</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
<!-- /Banner Collection -->

        <!-- Icon box -->
        <section class="flat-spacing-1 flat-iconbox">
            <div class="container">
                <div class="wrap-carousel wrap-mobile wow fadeInUp" data-wow-delay="0s">
                    <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                        <div class="swiper-wrapper wrap-iconbox">
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-row">
                                    <div class="icon">
                                        <i class="icon-shipping"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title fw-4">Free Shipping</div>
                                        <p>Free shipping over order $120</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-row">
                                    <div class="icon">
                                        <i class="icon-payment fs-22"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title fw-4">Flexible Payment</div>
                                        <p>Pay with Multiple Credit Cards</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-row">
                                    <div class="icon">
                                        <i class="icon-return fs-20"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title fw-4">14 Day Returns</div>
                                        <p>Within 30 days for an exchange</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-row">
                                    <div class="icon">
                                        <i class="icon-suport"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title fw-4">Premium Support</div>
                                        <p>Outstanding premium support</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Icon box -->
       
         <!-- Location -->
        {{-- <section>
            <div class="container">
                <div class="flat-location">
                    <div class="banner-map">
                        <img class="lazyload" data-src="{{asset('frontend/images/country/map-1.jpg')}}" src="{{asset('frontend/images/country/map-1.jpg')}}"
                            alt="map">
                    </div>
                    <div class="content">
                        <h3 class="heading wow fadeInUp" data-wow-delay="0s">Toronto Store</h3>
                        <p class="subtext wow fadeInUp" data-wow-delay="0s">
                            301 Front St W Toronto, Canada
                            <br>
                            support@ecomus.com
                            <br>
                            (08) 8942 1299
                        </p>
                        <p class="subtext wow fadeInUp" data-wow-delay="0s">
                            Mon - Fri, 8:30am - 10:30pm
                            <br>
                            Saturday, 8:30am - 10:30pm
                            <br>
                            Sunday Closed
                        </p>
                        <a href="https://maps.app.goo.gl/RKWwwsLvWKtvTHNq8" target="_self"
                            class="tf-btn btn-line collection-other-link fw-6 wow fadeInUp" data-wow-delay="0s">Get
                            Directions<i class="icon icon-arrow1-top-left"></i></a>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- /Location -->
      <!-- brand -->
            <section class="flat-spacing-1">
                <div class="container">
                    <div dir="ltr" class="swiper tf-sw-brand" data-loop="false" data-play="false" data-preview="6"
                        data-tablet="3" data-mobile="2" data-space-lg="0" data-space-md="0">
                        <div class="swiper-wrapper">
                            @forelse($brands as $brand)
                                <div class="swiper-slide">
                                    <div class="brand-item">
                                        <a href="{{ url($brand->brand_path) }}" title="{{ $brand->brand_name }}">
                                            <img class="lazyload brand-logo" 
                                                data-src="{{ asset($brand->brand_image) }}"
                                                src="{{ asset($brand->brand_image) }}" 
                                                alt="{{ $brand->brand_name }}"
                                                onerror="this.src='{{ asset('frontend/images/brand/default-brand.png') }}'">
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <!-- Fallback if no brands -->
                                <div class="swiper-slide">
                                    <div class="brand-item">
                                        <div style="padding: 20px; text-align: center; color: #999;">
                                            No brands available
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="sw-dots style-2 sw-pagination-brand justify-content-center"></div>
                </div>
            </section>
<!-- /brand -->       
      
@endsection
