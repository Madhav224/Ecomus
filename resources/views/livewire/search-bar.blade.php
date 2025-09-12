
 <div class="search-bar" style="position: relative;">
        <button class="search-submit" tabindex="0">
            <i class="icon icon-search" style="color: black"></i>
        </button>
        
 {{-- Livewire search input --}}
        <input type="search" class="search-input w-sm-75 w-md-50" style="padding: 0;margin:0;outline:none;border:none;" placeholder="Search here..." 
               wire:model.live="query" tabindex="0" autocomplete="off">

             
                <div class="sub-menu submenu-default">

                    @if(strlen($query) >= 1)
                        @if($products || $categories)
                            <ul class="autocomplete-dropdown menu-list" wire:ignore>

                                {{-- Products --}}
                                @if($products)
                                    {{-- <li style="font-weight: bold; padding: 8px 12px; color: #666;">Products</li> --}}
                                    @foreach($products as $product)
                                        <li>
                                            <a href="{{ route('product.detail', $product->product_slug) }}">
                                                <i class="icon icon-search" style="margin-right: 8px;"></i>
                                                {{ $product->product_name }}
                                            </a>
                                        </li>
                                    @endforeach

                                @endif

                                {{-- Categories --}}
                                @if($categories)
                                    {{-- <li style="font-weight: bold; padding: 8px 12px; color: #666;">Categories</li> --}}
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('shop', $category->categorie_slug) }}">
                                                <i class="icon icon-search" style="margin-right: 8px;"></i>
                                                {{ $category->categorie_name }}
                                            </a>
                                        </li>
                                    @endforeach

                                @endif

                            </ul>
                        @else
                        <ul class="autocomplete-dropdown menu-list">
                            <li class="no-results">No products or categories found.</li>
                            </ul>
                        @endif
                    @endif

        </div>
    </div>
    
