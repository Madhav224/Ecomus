<div>

    <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <div class="heading text-center">New Arrival</div>
                        <p class="text-center text-2 text_black-2 mt_5">Shop through our latest selection of Fashion</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title --> 

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
                            {{-- <div id="categories" class="collapse show">
                                <ul class="list-categoris mb_36">
                                    @foreach($parent_categories as $parent_cate)
                                         <li class="cate-item">
                                            <label for="cate{{ $parent_cate->id }}">
                                                <input type="checkbox"
                                                    wire:model.live="filter.categories_ids"
                                                    value="{{ $parent_cate->id }}"
                                                    id="cate{{ $parent_cate->id }}">
                                                {{ $parent_cate->categorie_name }}
                                            </label>
                                        </li>
                                    @endforeach
                            
                                </ul>
                            </div> --}}
                            <!-- Category list -->
<div id="categories" class="collapse show">
    <ul class="list-categoris mb_36">
        @foreach($parent_categories as $parent_cate)
            <li class="cate-item">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="cate{{ $parent_cate->id }}" class="mb-0">
                        <input type="checkbox"
                            wire:model.live="filter.categories_ids"
                            value="{{ $parent_cate->id }}"
                            id="cate{{ $parent_cate->id }}">
                        {{ $parent_cate->categorie_name }}
                    </label>

                    @if($parent_cate->children->count())
                        {{-- <button class="btn btn-sm" type="button" data-bs-toggle="collapse"  aria-expanded="true" 
                            data-bs-target="#child-{{ $parent_cate->id }}" >
                            <span class="icon icon-arrow-up"></span>
                        </button> --}}
                        <button type="button"
        class="border-0 bg-transparent p-0 ms-2 category-collapse-toggle"
        data-bs-toggle="collapse"
        aria-expanded="false"
        data-bs-target="#child-{{ $parent_cate->id }}">
        <span class="icon icon-arrow-down"></span>
    </button>
                    @endif
                </div>

                
                @if($parent_cate->children->count())
                    <ul class="ms-3 collapse" id="child-{{ $parent_cate->id }}">
                        @foreach($parent_cate->children as $child)
                            <li class="cate-item">
                                <label for="cate{{ $child->id }}">
                                    <input type="checkbox"
                                        wire:model.live="filter.categories_ids"
                                        value="{{ $child->id }}"
                                        id="cate{{ $child->id }}">
                                    {{ $child->categorie_name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>

                        </div>
                        <div class="widget-facet">
                            <div class="facet-title"  data-bs-toggle="collapse" aria-expanded="true"
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

                     

                    
                    </aside>
                    <div class="wrapper-control-shop tf-shop-content" >
                        <div class="meta-filter-shop">
                          
                            
                            
                        </div>   <div class="tab-pane active show"  role="tabpanel">
                                <div class="grid-layout loadmore-item mb_30" data-grid="grid-4">
                                 {{-- @foreach ($products as $product)
                                    <div wire:loading.remove>  
                                        <x-product-card :slug="$product?->product_slug" />    
                                    </div>
                                 @endforeach --}}

                                 @foreach ($products as $product)
                                    <div wire:key="product-{{ $product->id }}">
                                        <x-product-card :slug="$product->product_slug" />
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
