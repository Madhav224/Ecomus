@extends('frontend.layouts.app')

@section('title', 'Wishlist')

@section('content')


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
                    <!-- card product 6 -->
                    <div class="card-product">
                        <div class="card-product-wrapper">
                            <div class="product-img">
                                <img class="lazyload img-product" data-src="images/products/light-green-1.jpg"
                                    src="images/products/light-green-1.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/light-green-2.jpg"
                                    src="images/products/light-green-2.jpg" alt="image-product">
                            </div>
                            <div class="list-product-btn type-wishlist">
                                <a href="#" class="box-icon bg_white wishlist">
                                    <span class="tooltip">Remove Wishlist</span>
                                    <span class="icon icon-delete"></span>
                                </a>
                            </div>
                            <div class="list-product-btn">
                                <a href="#quick_add" data-bs-toggle="modal"
                                    class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">Quick Add</span>
                                </a>
                                <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                    class="box-icon bg_white compare btn-icon-action">
                                    <span class="icon icon-compare"></span>
                                    <span class="tooltip">Add to Compare</span>
                                    <span class="icon icon-check"></span>
                                </a>
                                <a href="#quick_view" data-bs-toggle="modal"
                                    class="box-icon bg_white quickview tf-btn-loading">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Loose Fit Sweatshirt</a>
                            <span class="price">$10.00</span>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="tooltip">Light Green</span>
                                    <span class="swatch-value bg_light-green"></span>
                                    <img class="lazyload" data-src="images/products/light-green-1.jpg"
                                        src="images/products/light-green-1.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="tooltip">Black</span>
                                    <span class="swatch-value bg_dark"></span>
                                    <img class="lazyload" data-src="images/products/black-3.jpg"
                                        src="images/products/black-3.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="tooltip">Blue</span>
                                    <span class="swatch-value bg_blue-2"></span>
                                    <img class="lazyload" data-src="images/products/blue.jpg"
                                        src="images/products/blue.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="tooltip">Dark Blue</span>
                                    <span class="swatch-value bg_dark-blue"></span>
                                    <img class="lazyload" data-src="images/products/dark-blue.jpg"
                                        src="images/products/dark-blue.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="tooltip">White</span>
                                    <span class="swatch-value bg_white"></span>
                                    <img class="lazyload" data-src="images/products/white-6.jpg"
                                        src="images/products/white-6.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="tooltip">Light Grey</span>
                                    <span class="swatch-value bg_light-grey"></span>
                                    <img class="lazyload" data-src="images/products/light-grey.jpg"
                                        src="images/products/light-grey.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Section Product -->


@endsection