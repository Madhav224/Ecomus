<div>

  <section class="flat-spacing-1">
            <div class="container">
                <div class="tf-shop-control grid-2 align-items-center">
                    <div class="tf-control-filter">
                        <span class="icon icon-filter"></span>
                    </div>
                    
                   
                    <div class="tf-control-sorting d-flex justify-content-end">
                        <div class="sort-product right flex items-center gap-3">
                            <div class="select-block relative">
                                <label for="select-filter" class="caption1 capitalize">Sort By :</label>
                                <select id="select-filter" name="sort_by"
                                    class="caption1 py-3 pl-4 md:pr-24 pr-12 rounded-2xl border border-line"
                                    wire:model.live="filter.sort_by">
                                    <option value="">Featured / Latest</option>
                                    <option value="soldQuantityHighToLow">Best Selling</option>
                                    <option value="discountHighToLow">Best Discount</option>
                                    <option value="priceHighToLow">Price High To Low</option>
                                    <option value="priceLowToHigh">Price Low To High</option>
                                </select>
                                <i class="ph ph-caret-down absolute top-1/2 -translate-y-1/2 md:right-4 right-2"></i>
                            </div>
                        </div>
                    </div>

                    

                </div>
               
                <div class="tf-row-flex">
                    <aside class="tf-shop-sidebar wrap-sidebar-mobile">
                        <div class="widget-facet wd-categories">
                            <!-- Heading -->
                            <div class="facet-title" 
                                data-bs-target="#categories" 
                                data-bs-toggle="collapse"
                                aria-expanded="true" 
                                aria-controls="categories">
                                <span>Product categories</span>
                                <span class="icon icon-arrow-up"></span>
                            </div>

                            <!-- Category list -->
                            <div id="categories" class="collapse show">
                                <ul class="list-categoris mb_36">
                                   @foreach($parent_categories as  $parent_cate)
                                        <li class="cate-item">
                                             <label
                                            data-item="{{ $parent_cate?->categorie_slug }}"
                                            for="cate{{ $parent_cate?->categorie_slug . $parent_cate?->id }}">

                                            
                                                <input type="checkbox" wire:model.live="filter.categories_ids"
                                                    value="{{ $parent_cate?->allCategoryIds() }}"
                                                    name="categories_ids[]"
                                                    id="cate{{ $parent_cate?->categorie_slug . $parent_cate?->id }}">
                                                {{ $parent_cate?->categorie_name }}
                                            
                                           
                                        </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true"
                                aria-controls="price">
                                <span>Price</span>
                                <span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="price" class="collapse show">
                                <div class="widget-price filter-price">
                                    
                                    <div wire:ignore x-data x-init="
                                        noUiSlider.create($refs.rangeSlider, {
                                            start: [{{ $filter['min_price'] }}, {{ $filter['max_price'] }}],
                                            connect: true,
                                            range: {
                                                min: {{ $priceRange->min_price }},
                                                max: {{ $priceRange->max_price }}
                                            }
                                        }).on('set', function(values) {
                                            $refs.minValue.innerText = '₹' + Math.round(values[0]);
                                            $refs.maxValue.innerText = '₹' + Math.round(values[1]);
                                            
                                            @this.set('filter.min_price', Math.round(values[0]));
                                            @this.set('filter.max_price', Math.round(values[1]));
                                        });
                                    ">
                                        <div class="price-val-range" x-ref="rangeSlider"></div>

                                        <div class="box-title-price">
                                            <span class="title-price">Price :</span>
                                            <div class="caption-price">
                                                <div class="price-val" x-ref="minValue" id="price-min-value">
                                                    ₹{{ $filter['min_price'] }}
                                                </div>
                                                <span>-</span>
                                                <div class="price-val" x-ref="maxValue" id="price-max-value">
                                                    ₹{{ $filter['max_price'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                         {{-- <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#size" data-bs-toggle="collapse" aria-expanded="true"
                                aria-controls="size">
                                <span>Size</span>
                                <span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="size" class="collapse show">
                                <ul class="tf-filter-group d-flex flex-wrap gap-3" style="list-style:none; padding:0; margin:0;">
                                    @foreach($variant_size as $size)
                                        <li class="list-item d-flex gap-12 align-items-center">
                                            <input type="checkbox" 
                                                name="sizes[]" 
                                                class="tf-check tf-check-size" 
                                                value="{{ $size->id }}" 
                                                id="size-{{ $size->id }}" 
                                                wire:model.live="filter.variant_sizes">
                                            <label for="size-{{ $size->id }}" class="label ms-1">
                                                <span>{{ $size->variant_name }}</span>&nbsp;
                                               
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div> --}}

                        <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#size" data-bs-toggle="collapse" aria-expanded="true"
                                aria-controls="size">
                                <span>Size</span>
                                <span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="size" class="collapse show">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($variant_size as $size)
                                        <div>
                                            <!-- Hidden checkbox -->
                                            <input type="checkbox" 
                                                class="d-none" 
                                                id="size-{{ $size->id }}" 
                                                value="{{ $size->id }}" 
                                                wire:model.live="filter.variant_sizes">
                                            
                                            <!-- Round pill label -->
                                            <label for="size-{{ $size->id }}" 
                                                class="size-pill @if(in_array($size->id, $filter['variant_sizes'])) active @endif">
                                                {{ $size->variant_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#color" data-bs-toggle="collapse" aria-expanded="true"
                                aria-controls="color">
                                <span>Color</span>
                                <span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="color" class="collapse show">
                                <div class="d-flex flex-wrap gap-2 mb_30">
                                    @foreach($variant_color as $color)
                                            @php
                                                $bgColor =
                                                    $color?->variant_value !== '#000000'
                                                        ? $color?->variant_value
                                                        : strtolower($color?->variant_name);
                                            @endphp
                                        <div class="color-batch">
                                            <!-- Hidden checkbox -->
                                            <input type="checkbox" 
                                                class="d-none" 
                                                id="color-{{ $color->id }}" 
                                                value="{{ $color->id }}" 
                                                wire:model.live="filter.variant_colors">

                                            <!-- Color circle + name -->
                                            <label for="color-{{ $color->id }}" 
                                                class="color-pill-label @if(in_array($color->id, $filter['variant_colors'])) active @endif">
                                                <span class="color-circle" style="background-color: {{ trim($bgColor) }};"></span>
                                                <span class="color-name">{{ ucfirst(strtolower($color->variant_name)) }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                       {{-- <div class="widget-facet">
                                <div class="facet-title" data-bs-target="#sale-products" data-bs-toggle="collapse"
                                    aria-expanded="true" aria-controls="sale-products">
                                    <span>Sale products</span>
                                    <span class="icon icon-arrow-up"></span>
                                </div>
                                <div id="sale-products" class="collapse show">
                                    <div class="widget-featured-products mb_36">

                                        @foreach($saleProducts as $product)
                                            @php
                                                // Decode images if stored as JSON
                                                $images = is_array($product->product_images)
                                                    ? $product->product_images
                                                    : (json_decode($product->product_images, true) ?? []);

                                                // Thumbnail
                                                $thumbnail = $product->product_thumbnail_image ?? ($images[0] ?? 'frontend/images/products/default.png');
                                            @endphp

                                            <div class="featured-product-item">
                                                <a href="{{ url('product/'.$product->id) }}" class="card-product-wrapper">
                                                    <img class="lazyload img-product"
                                                        data-src="{{ asset($thumbnail) }}"
                                                        src="{{ asset($thumbnail) }}"
                                                        alt="{{ $product->product_name }}">
                                                </a>
                                                <div class="card-product-info">
                                                    <a href="{{ url('product/'.$product->id) }}" class="title link">
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
                                        @endforeach 

                                    </div>
                                </div>
                            </div> --}}

                        <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#shipping" data-bs-toggle="collapse"
                                aria-expanded="true" aria-controls="shipping">
                                <span>Shipping & Delivery</span>
                                <span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="shipping" class="collapse show">
                                <ul class="widget-iconbox-list mb_36">
                                    <li class="iconbox-item">
                                        
                                        <div class="iconbox-content">
                                            <h4 class="iconbox-title">Free shipping</h4>
                                            <p class="iconbox-desc">Free iconbox for all US order</p>
                                        </div>
                                    </li>
                                    <li class="iconbox-item">
                                        
                                        <div class="iconbox-content">
                                            <h4 class="iconbox-title">Premium Support</h4>
                                            <p class="iconbox-desc">Support 24 hours a day</p>
                                        </div>
                                    </li>
                                    <li class="iconbox-item">
                                        
                                        <div class="iconbox-content">
                                            <h4 class="iconbox-title">30 Days Return</h4>
                                            <p class="iconbox-desc">You have 30 days to return</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                       {{-- <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#gallery" data-bs-toggle="collapse"
                                aria-expanded="true" aria-controls="gallery">
                                <span>Gallery</span>
                                <span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="gallery" class="collapse show">
                                <div class="grid-3 gap-4 mb_36">
                                    @foreach($galleryImages as $item)
                                        <a href="{{ $item['url'] }}" class="item-gallery ratio ratio-1x1">
                                            <img class="lazyload img-fluid w-100 h-100 object-fit-cover"
                                                data-src="{{ $item['image'] }}"
                                                alt="{{ $item['name'] }}">
                                        </a>
                                    @endforeach 
                                </div>
                            </div>
                        </div> --}}

                        <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#follow" data-bs-toggle="collapse"
                                aria-expanded="true" aria-controls="follow">
                                <span>Follow us</span>
                                <span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="follow" class="collapse show">
                                <ul class="tf-top-bar_item tf-social-icon d-flex gap-10">
                                    <li><a href="https://www.facebook.com" target="_blank" class="box-icon w_28 round social-facebook bg_line">
                                        <i class="icon fs-12 icon-fb"></i>
                                    </a></li>
                                    <li><a href="https://twitter.com" target="_blank" class="box-icon w_28 round social-twiter bg_line">
                                        <i class="icon fs-10 icon-Icon-x"></i>
                                    </a></li>
                                    <li><a href="https://www.instagram.com" target="_blank" class="box-icon w_28 round social-instagram bg_line">
                                        <i class="icon fs-12 icon-instagram"></i>
                                    </a></li>
                                    <li><a href="https://www.tiktok.com" target="_blank" class="box-icon w_28 round social-tiktok bg_line">
                                        <i class="icon fs-12 icon-tiktok"></i>
                                    </a></li>
                                    <li><a href="https://www.pinterest.com" target="_blank" class="box-icon w_28 round social-pinterest bg_line">
                                        <i class="icon fs-12 icon-pinterest-1"></i>
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                    <div class="wrapper-control-shop tf-shop-content">
                        <div class="meta-filter-shop">
                            <div id="product-count-grid" class="count-text"></div>
                            <div id="product-count-list" class="count-text"></div>
                            <div id="applied-filters"></div>
                            <button id="remove-all" class="remove-all-filters" style="display: none;">Remove All <i
                                    class="icon icon-close"></i></button>
                        </div>   <div class="tab-pane active show" id="bestSeller" role="tabpanel">
                                <div class="grid-layout loadmore-item mb_30" data-grid="grid-4">
                                 @foreach ($products as $product)
                                    <div wire:loading.remove>
                                        {{-- wire:target="loadProducts" --}}
                                        <x-product-card :slug="$product?->product_slug" />
                                            
                                    </div>
                                  
                
                                 @endforeach


                                    {{-- Pagination --}}
                                    <div class="mt-4">
                                        {{ $products->links() }}
                                    </div>
                                </div>

                                

                            </div>
                        
                    </div>
                </div>

            </div>
        </section>
        <div class="btn-sidebar-style2">
            <button data-bs-toggle="offcanvas" data-bs-target="#sidebarmobile" aria-controls="offcanvas"><i
                    class="icon icon-sidebar-2"></i></button>
        </div>


</div> 
