 <!-- Header -->
<style>
.search-bar {
  --size: 32px;
  --padding: 8px;
  --expanded-width: 200px;

  display: flex;
  align-items: center;
  border-radius: 100px;

  border: 1px solid transparent; /* fallback for layout stability */
  box-shadow: 0 0 0 1px #d6d9e2; /* default border effect */

  overflow: visible;
  padding: var(--padding);
  width: var(--size);
  height: var(--size);
  transition: width 0.5s, box-shadow 0.5s;
}


.search-bar:focus-within {
  width: var(--expanded-width);
  box-shadow: 0 0 0 1px #2e2e2e; /* darker border on focus */
}


.search-input {
  font-size: 18px;
  color: #3a3a3a;
  background-color: transparent;
  border: none;
  outline: none;
  margin-left: 1rem;
  flex: 1;
   box-shadow: none;

  opacity: 0;
  transition: opacity 0.5s;
}

.search-bar:focus-within .search-input  {
  opacity: 1;

}

.search-submit {
  flex: none;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 18px;
  color: #fff;
  background-color: #fff ;
  border-radius: 50%;
  border: none;
  width: calc(var(--size) - var(--padding) * 2);
  aspect-ratio: 1;
  cursor: pointer;
}

.autocomplete-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #ddd;
    max-height: 300px;
    overflow-y: auto;
    z-index: 1000;
    border-radius: 4px;
    padding: 0;
    margin-top: 4px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.autocomplete-dropdown li {
    list-style: none;
    padding: 8px 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.autocomplete-dropdown li a {
    text-decoration: none;
    color: #333;
    display: flex;
    align-items: center;
    width: 100%;
}

.autocomplete-dropdown li:hover {
    background-color: #f7f7f7;
}

.autocomplete-dropdown i.icon-search {
    font-size: 14px;
    color: #999;
}

@media (max-width: 575.98px) {
  .search-bar {
    /* width: 120px; */
    --expanded-width: 130px; /* smaller width on xs devices */
  }
}

</style>
        <header id="header" class="header-default header-style-2">
            <div class="main-header line">
                <div class="container-full px_15 lg-px_40">
                    <div class="row wrapper-header align-items-center">
                        <div class="col-xl-5 tf-md-hidden">
                            <div class="tf-cur">
                                <div class="tf-currencies">
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
                        </div>
                        <div class="col-md-4 col-3 tf-lg-hidden">
                            <a href="#mobileMenu" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 16"
                                    fill="none">
                                    <path
                                        d="M2.00056 2.28571H16.8577C17.1608 2.28571 17.4515 2.16531 17.6658 1.95098C17.8802 1.73665 18.0006 1.44596 18.0006 1.14286C18.0006 0.839753 17.8802 0.549063 17.6658 0.334735C17.4515 0.120408 17.1608 0 16.8577 0H2.00056C1.69745 0 1.40676 0.120408 1.19244 0.334735C0.978109 0.549063 0.857702 0.839753 0.857702 1.14286C0.857702 1.44596 0.978109 1.73665 1.19244 1.95098C1.40676 2.16531 1.69745 2.28571 2.00056 2.28571ZM0.857702 8C0.857702 7.6969 0.978109 7.40621 1.19244 7.19188C1.40676 6.97755 1.69745 6.85714 2.00056 6.85714H22.572C22.8751 6.85714 23.1658 6.97755 23.3801 7.19188C23.5944 7.40621 23.7148 7.6969 23.7148 8C23.7148 8.30311 23.5944 8.59379 23.3801 8.80812C23.1658 9.02245 22.8751 9.14286 22.572 9.14286H2.00056C1.69745 9.14286 1.40676 9.02245 1.19244 8.80812C0.978109 8.59379 0.857702 8.30311 0.857702 8ZM0.857702 14.8571C0.857702 14.554 0.978109 14.2633 1.19244 14.049C1.40676 13.8347 1.69745 13.7143 2.00056 13.7143H12.2863C12.5894 13.7143 12.8801 13.8347 13.0944 14.049C13.3087 14.2633 13.4291 14.554 13.4291 14.8571C13.4291 15.1602 13.3087 15.4509 13.0944 15.6653C12.8801 15.8796 12.5894 16 12.2863 16H2.00056C1.69745 16 1.40676 15.8796 1.19244 15.6653C0.978109 15.4509 0.857702 15.1602 0.857702 14.8571Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6 text-center">
                            <a href="{{route('home')}}" class="logo-header">
                               <img 
                                    src="{{ asset('images/logo/' . setting('site_logo')) }}" 
                                    alt="{{ setting('site_name') }}" 
                                    class="logo">
                            </a>
                        </div>


                        <div class="col-xl-5 col-md-4 col-3">
                            <ul class="nav-icon d-flex justify-content-end align-items-center gap-20">
                              
                                <li class="nav-search menu-item position-relative">
                                     @livewire('search-bar')              
                                </li>            
                                <li class="nav-account">
                                    @guest
                                        {{-- Guest: Show login modal trigger --}}
                                        {{-- <a href="#login" data-bs-toggle="modal" class="nav-icon-item">
                                            <i class="icon icon-account"></i>
                                        </a> --}}

                                         @if (!Route::currentRouteNamed('client.login', 'frontend.register.form'))
                                            {{-- Guest: Show login modal trigger --}}
                                            <a href="#login" data-bs-toggle="modal" class="nav-icon-item">
                                                <i class="icon icon-account"></i>
                                            </a>
                                        @endif
                                    @endguest

                                    @auth
                                        {{-- Authenticated: Show dropdown --}}
                                        <div class="dropdown">
                                            <a href="#" class="nav-icon-item dropdown-toggle" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="user-avatar">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                </span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2"  aria-labelledby="accountDropdown">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded" href="{{ route('account.profile') }}">
                                                        <i class="icon icon-user"></i>
                                                        <span>My Account</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded" href="{{ route('account.orders') }}">
                                                        <i class="icon icon-bag"></i>
                                                        <span>My Orders</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form method="POST" action="{{ route('frontend.logout') }}">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 rounded text-danger">
                                                            <i class="icon icon-logout"></i>
                                                            <span>Logout</span>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>

                                        </div>
                                    @endauth
                                </li>

                                <li class="nav-wishlist">
                                    <a href="{{route('wishlist')}}" class="nav-icon-item">
                                        <i class="icon icon-heart"></i>
                                         @php
                                            $wishlistCount = auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0;
                                         @endphp

                                        @if($wishlistCount > 0)
                                            <span class="count-box">{{ $wishlistCount }}</span>
                                        @endif                                  
                                    </a> 
                               
                                </li>
                                <li class="nav-cart d-none d-md-flex">
                                    <a href="{{route('cart')}}" 
                                        class="nav-icon-item"><i class="icon icon-bag"></i> 
        
                                        @php
                                            $cartCount = auth()->check() ? auth()->user()->cart?->child->sum('qty') ?? 0 : 0;
                                        @endphp

                                        @if($cartCount > 0)
                                            <span class="count-box">{{ $cartCount }}</span>
                                        @endif
                                    </a>
                                </li>
  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom line tf-md-hidden">
                <div class="container-full px_15 lg-px_40">
                    <div class="wrapper-header d-flex justify-content-center align-items-center">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-ul d-flex align-items-center justify-content-center gap-30">
                                <li class="menu-item">
                                    <a href="{{ route('home') }}" class="item-link">Home</a>
                                    
                                </li>
                                {{-- <li class="menu-item">
                                    <a href="{{route('shop')}}" class="item-link">Shop</a>
                                    
                                </li> --}}
                                <x-header-menu />
                                {{-- <li class="menu-item">
                                    <a href="{{route('ourstore')}}" class="item-link">Our Store</a>
                                    
                                </li>
                                <li class="menu-item position-relative">
                                    <a href="#" class="item-link">Pages<i class="icon icon-arrow-down"></i></a>
                                    <div class="sub-menu submenu-default">
                                        <ul class="menu-list">
                                            <li>
                                                <a href="{{route('about-us')}}" class="menu-link-text link text_black-2">About
                                                    us</a>
                                            </li>
                                            
                                           
                                          
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item position-relative">
                                    <a href="{{route('blog')}}" class="item-link">Blog</a>
                                    
                                </li> --}}
                              
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </header>
        <!-- /Header -->


         <!-- gotop -->
    <button id="goTop">
        <span class="border-progress"></span>
        <span class="icon icon-arrow-up"></span>
    </button>
    <!-- /gotop -->

    <!-- toolbar-bottom -->
    <div class="tf-toolbar-bottom type-1150">
        <div class="toolbar-item">
            <a href="{{route('shop')}}" >
                <div class="toolbar-icon">
                    <i class="icon-shop"></i>
                </div>
                <div class="toolbar-label">Shop</div>
            </a>
        </div>

        <div class="toolbar-item">
            <a href="#canvasSearch" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
                <div class="toolbar-icon">
                    <i class="icon-search"></i>
                </div>
                <div class="toolbar-label">Search</div>
            </a>
        </div>
        <div class="toolbar-item">
            
                                    @guest
                                        <a href="#login" data-bs-toggle="modal">
                                            <div class="toolbar-icon">
                                                <i class="icon-account"></i>
                                            </div>
                                            <div class="toolbar-label">Account</div>
                                        </a>
                                    @endguest

                                    @auth
                                        {{-- Authenticated: Show dropdown --}}
                                
                                            <a href="#" class="nav-icon-item " >
                                                <span class="user-avatar">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                </span>
                                                <div class="toolbar-label">Account</div>
                                            </a>
                                            
                                        
                                    @endauth
        </div>
        <div class="toolbar-item">
            <a href="{{route('wishlist')}}">
                <div class="toolbar-icon">
                    <i class="icon-heart"></i>
                    <div class="toolbar-count">
                         {{ auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0 }}
                    </div>
                </div>
                <div class="toolbar-label">Wishlist</div>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="{{route('cart')}}" data-bs-toggle="modal">
                <div class="toolbar-icon">
                    <i class="icon-bag"></i>
                    <div class="toolbar-count">{{ auth()->check() ? auth()->user()->cart?->child->sum('qty') ?? 0 : 0 }}</div>
                </div>
                <div class="toolbar-label">Cart</div>
            </a>
        </div>
    </div>
    <!-- /toolbar-bottom -->

     <!-- modal delivery_return -->
    <div class="modal modalCentered fade modalDemo tf-product-modal modal-part-content" id="delivery_return">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Shipping & Delivery</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="overflow-y-auto">
                    <div class="tf-product-popup-delivery">
                        <div class="title">Delivery</div>
                        <p class="text-paragraph">All orders shipped with UPS Express.</p>
                        <p class="text-paragraph">Always free shipping for orders over US $250.</p>
                        <p class="text-paragraph">All orders are shipped with a UPS tracking number.</p>
                    </div>
                    <div class="tf-product-popup-delivery">
                        <div class="title">Returns</div>
                        <p class="text-paragraph">Items returned within 14 days of their original shipment date in same
                            as new condition will be eligible for a full refund or store credit.</p>
                        <p class="text-paragraph">Refunds will be charged back to the original form of payment used for
                            purchase.</p>
                        <p class="text-paragraph">Customer is responsible for shipping charges when making returns and
                            shipping/handling fees of original purchase is non-refundable.</p>
                        <p class="text-paragraph">All sale items are final purchases.</p>
                    </div>
                    <div class="tf-product-popup-delivery">
                        <div class="title">Help</div>
                        <p class="text-paragraph">Give us a shout if you have any other questions and/or concerns.</p>
                        <p class="text-paragraph">Email: <a href="mailto:{{ setting('site_email') }}">{{ setting('site_email') }}</a></p>
                        <p class="text-paragraph mb-0">Phone: <a href="tel:{{ setting('site_contact') }}">{{ setting('site_contact') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal delivery_return -->
   
    <!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="{{route('home')}}" class="collapsed mb-menu-link current" >
                            <span>Home</span>
                            
                        </a>
                       
                    </li>
                    <li class="nav-mb-item">
                        <a href="{{route('shop')}}" class="collapsed mb-menu-link current" 
                            >
                            <span>Shop</span>
                        </a>
                       
                    </li>
                    <li class="nav-mb-item">
                        <a href="{{route('ourstore')}}" class="collapsed mb-menu-link current" 
                            >
                            <span>Our Store</span>
                        </a>
                        
                    </li>
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-four" class="collapsed mb-menu-link current" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="dropdown-menu-four">
                            <span>Pages</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-four" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-navigation2">
                                 <li>
                                                <a href="{{route('about-us')}}" class="menu-link-text link text_black-2">About
                                                    us</a>
                                            </li>
                                            <li >
                                                <a href="{{route('contact')}}" class="menu-link-text link text_black-2">Contact</a>
                                            </li>
                                            <li >
                                                <a href="{{route('faq')}}" class="menu-link-text link text_black-2">FAQ</a>
                                               
                                            </li>
                                            <li>
                                                <a href="{{route('ourstore')}}" class="menu-link-text link text_black-2">Our Store</a>
                                               
                                            </li>
                                            <li><a href="{{route('timeline')}}"
                                                    class="menu-link-text link text_black-2 position-relative">Timeline
                                                    {{-- <div class="demo-label"><span class="demo-new">New</span></div> --}}
                                                </a>
                                            </li>
                                            <li><a href="{{route('cart')  }}"
                                                    class="menu-link-text link text_black-2 position-relative">View
                                                    cart</a></li>
                                            <li><a href="{{route('checkout')}}"
                                                    class="menu-link-text link text_black-2 position-relative">Check
                                                     out</a></li>
                                           
                            </ul>
                        </div>

                    </li>
                    <li class="nav-mb-item">
                        <a href="{{route('blog')}}" class="collapsed mb-menu-link current" >
                            <span>Blog</span>
                        </a>
                    </li>
                    
                </ul>
                <div class="mb-other-content">
                    <div class="d-flex group-icon">
                        <a href="{{route('wishlist')}}" class="site-nav-icon"><i class="icon icon-heart"></i>Wishlist</a>
                        {{-- <a href="#" class="site-nav-icon"><i class="icon icon-search"></i>Search</a> --}}
                          <div class="search-bar-container" >

                    @livewire('search-bar')

                </div>

                    </div>
                    <div class="mb-notice">
                        <a href="{{route('contact')}}" class="text-need">Need help ?</a>
                    </div>
                    <ul class="mb-info">
                        <li>Address: {{ setting('site_postal_address') }}</li>
                        <li>Email: <b><a href="mailto:{{ setting('site_email') }}">{{ setting('site_email') }}</a></b></li>
                        <li>Phone: <b><a href="tel:{{ setting('site_contact') }}">{{ setting('site_contact') }}</a></b></li>
                    </ul>
                </div>
            </div>
            <div class="mb-bottom d-flex justify-content-between ">
                @guest
                    <a href="#login"  data-bs-toggle="modal" class="site-nav-icon">
                        <i class="icon icon-account"></i>Login</a>                      
                 @endguest

                   @auth
                       {{-- Authenticated: Show dropdown --}}
            
                        <a href="#" class="nav-icon-item " >
                            <span class="user-avatar ml-3">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <div class="toolbar-label">Account</div>
                        </a>
                        <a href=""   class="site-nav-icon right-end ">
                           <form method="POST" action="{{ route('frontend.logout') }}">
                               @csrf
                               <button type="submit" class="dropdown-item d-flex align-items-center  py-2 rounded text-danger">
                                   <i class="icon icon-logout"></i>
                                   {{-- <span>Logout</span> --}}
                               </button>
                            </form>
                        </a>   
                   @endauth
            </div>
        </div>
    </div>
    <!-- /mobile menu -->

    <!-- toolbarShopmb -->
    <div class="offcanvas offcanvas-start canvas-mb toolbar-shop-mobile" id="toolbarShopmb">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="shop-default.html" class="tf-category-link mb-menu-link">
                            <div class="image">
                                <img src="images/shop/cate/cate1.jpg" alt="">
                            </div>
                            <span>Accessories</span>
                        </a>
                    </li>
                   
                  
                </ul>
            </div>
            <div class="mb-bottom">
                <a href="{{route('shop')}}" class="tf-btn fw-5 btn-line">View all collection<i
                        class="icon icon-arrow1-top-left"></i></a>
            </div>
        </div>
    </div>
    <!-- /toolbarShopmb -->

    <!-- modal find_size -->
    <div class="modal fade modalDemo tf-product-modal popup-findsize" id="find_size">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Size chart</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-rte">
                    <div class="tf-table-res-df">
                        <h6>Size guide</h6>
                        <table class="tf-sizeguide-table">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>US</th>
                                    <th>Bust</th>
                                    <th>Waist</th>
                                    <th>Low Hip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>XS</td>
                                    <td>2</td>
                                    <td>32</td>
                                    <td>24 - 25</td>
                                    <td>33 - 34</td>
                                </tr>
                                <tr>
                                    <td>S</td>
                                    <td>4</td>
                                    <td>34 - 35</td>
                                    <td>26 - 27</td>
                                    <td>35 - 26</td>
                                </tr>
                                <tr>
                                    <td>M</td>
                                    <td>6</td>
                                    <td>36 - 37</td>
                                    <td>28 - 29</td>
                                    <td>38 - 40</td>
                                </tr>
                                <tr>
                                    <td>L</td>
                                    <td>8</td>
                                    <td>38 - 29</td>
                                    <td>30 - 31</td>
                                    <td>42 - 44</td>
                                </tr>
                                <tr>
                                    <td>XL</td>
                                    <td>10</td>
                                    <td>40 - 41</td>
                                    <td>32 - 33</td>
                                    <td>45 - 47</td>
                                </tr>
                                <tr>
                                    <td>XXL</td>
                                    <td>12</td>
                                    <td>42 - 43</td>
                                    <td>34 - 35</td>
                                    <td>48 - 50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tf-page-size-chart-content">
                        <div>
                            <h6>Measuring Tips</h6>
                            <div class="title">Bust</div>
                            <p>Measure around the fullest part of your bust.</p>
                            <div class="title">Waist</div>
                            <p>Measure around the narrowest part of your torso.</p>
                            <div class="title">Low Hip</div>
                            <p class="mb-0">With your feet together measure around the fullest part of your hips/rear.
                            </p>
                        </div>
                        <div>
                            {{-- <img class="sizechart lazyload" data-src="{{asset('frontend/images/shop/products/size_chart2.jpg')}}"
                                src="{{asset('frontend/images/shop/products/size_chart2.jpg')}}" alt=""> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal find_size -->
