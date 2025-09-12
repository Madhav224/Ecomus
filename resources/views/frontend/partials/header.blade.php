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
                                        <a href="#login" data-bs-toggle="modal" class="nav-icon-item">
                                            <i class="icon icon-account"></i>
                                        </a>
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
                                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded" {{--href="{{ route('frontend.account') }}"--}}>
                                                        <i class="icon icon-user"></i>
                                                        <span>My Account</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded" {{--href="{{ route('frontend.orders') }}"--}}>
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
                                        <span class="count-box" >
                                             {{ auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0 }}
                                        </span>                                    
                                    </a> 
                                    {{-- <a href="{{ route('wishlist') }}" class="nav-icon-item"
   x-data="{ count: {{ auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0 }} }"
   x-init="
        window.addEventListener('wishlist-updated', event => {
            count = event.detail.count
        })
   "
>
    <i class="icon icon-heart"></i>
    <span class="count-box" x-text="count"  ></span>
</a>
  --}}
                                </li>
                                <li class="nav-cart d-none d-md-flex"><a href="{{route('cart')}}" 
                                        class="nav-icon-item"><i class="icon icon-bag"></i><span
                                            class="count-box">0</span></a></li>

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
                                <li class="menu-item">
                                    <a href="{{route('shop')}}" class="item-link">Shop</a>
                                    
                                </li>
                                <li class="menu-item">
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
                                           
                                            {{-- <li class="menu-item-2">
                                                <a href="#" class="menu-link-text link text_black-2">My account</a>
                                                <div class="sub-menu submenu-default">
                                                    <ul class="menu-list">
                                                        <li><a href="my-account.html"
                                                                class="menu-link-text link text_black-2">My account</a>
                                                        </li>
                                                        <li><a href="my-account-orders.html"
                                                                class="menu-link-text link text_black-2">My order</a>
                                                        </li>
                                                        <li><a href="my-account-orders-details.html"
                                                                class="menu-link-text link text_black-2">My order
                                                                details</a></li>
                                                        <li><a href="my-account-address.html"
                                                                class="menu-link-text link text_black-2">My address</a>
                                                        </li>
                                                        <li><a href="my-account-edit.html"
                                                                class="menu-link-text link text_black-2">My account
                                                                details</a></li>
                                                        <li><a href="my-account-wishlist.html"
                                                                class="menu-link-text link text_black-2">My wishlist</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li> --}}
                                            {{-- <li><a href="invoice.html"
                                                    class="menu-link-text link text_black-2 position-relative">Invoice</a>
                                            </li> --}}
                                          
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item position-relative">
                                    <a href="{{route('blog')}}" class="item-link">Blog</a>
                                    
                                </li>
                              
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
                    <div class="toolbar-count">0</div>
                </div>
                <div class="toolbar-label">Wishlist</div>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="#shoppingCart" data-bs-toggle="modal">
                <div class="toolbar-icon">
                    <i class="icon-bag"></i>
                    <div class="toolbar-count">1</div>
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
                                                    </form></a>

                                            
                                        
                                    @endauth
            </div>
        </div>
    </div>
    <!-- /mobile menu -->

    {{-- <!-- canvasSearch -->
    <div class="offcanvas offcanvas-end canvas-search" id="canvasSearch">
        <div class="canvas-wrapper">
            <header class="tf-search-head">
                <div class="title fw-5">
                    Search our site
                    <div class="close">
                        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
                    </div>
                </div>
                <div class="tf-search-sticky">
                    <form class="tf-mini-search-frm">
                        <fieldset class="text">
                            <input type="text" placeholder="Search" class="" name="text" tabindex="0" value=""
                                aria-required="true" required="">
                        </fieldset>
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </form>
                </div>

            </header>
            <div class="canvas-body p-0">
                <div class="tf-search-content">
                    <div class="tf-cart-hide-has-results">
                        <div class="tf-col-quicklink">
                            <div class="tf-search-content-title fw-5">Quick link</div>
                          
                        </div>
                        <div class="tf-col-content">
                            <div class="tf-search-content-title fw-5">Need some inspiration?</div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /canvasSearch --> --}}

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

   
    <!-- shoppingCart -->
    <div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="header">
                    <div class="title fw-5">Shopping cart</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-mini-cart-threshold">
                        <div class="tf-progress-bar">
                            <span style="width: 50%;">
                                <div class="progress-car">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 0.875C0 0.391751 0.391751 0 0.875 0H13.5625C14.0457 0 14.4375 0.391751 14.4375 0.875V3.0625H17.3125C17.5867 3.0625 17.845 3.19101 18.0104 3.40969L20.8229 7.12844C20.9378 7.2804 21 7.46572 21 7.65625V11.375C21 11.8582 20.6082 12.25 20.125 12.25H17.7881C17.4278 13.2695 16.4554 14 15.3125 14C14.1696 14 13.1972 13.2695 12.8369 12.25H7.72563C7.36527 13.2695 6.39293 14 5.25 14C4.10706 14 3.13473 13.2695 2.77437 12.25H0.875C0.391751 12.25 0 11.8582 0 11.375V0.875ZM2.77437 10.5C3.13473 9.48047 4.10706 8.75 5.25 8.75C6.39293 8.75 7.36527 9.48046 7.72563 10.5H12.6875V1.75H1.75V10.5H2.77437ZM14.4375 8.89937V4.8125H16.8772L19.25 7.94987V10.5H17.7881C17.4278 9.48046 16.4554 8.75 15.3125 8.75C15.0057 8.75 14.7112 8.80264 14.4375 8.89937ZM5.25 10.5C4.76676 10.5 4.375 10.8918 4.375 11.375C4.375 11.8582 4.76676 12.25 5.25 12.25C5.73323 12.25 6.125 11.8582 6.125 11.375C6.125 10.8918 5.73323 10.5 5.25 10.5ZM15.3125 10.5C14.8293 10.5 14.4375 10.8918 14.4375 11.375C14.4375 11.8582 14.8293 12.25 15.3125 12.25C15.7957 12.25 16.1875 11.8582 16.1875 11.375C16.1875 10.8918 15.7957 10.5 15.3125 10.5Z">
                                        </path>
                                    </svg>
                                </div>
                            </span>
                        </div>
                        <div class="tf-progress-msg">
                            Buy <span class="price fw-6">$75.00</span> more to enjoy <span class="fw-6">Free
                                Shipping</span>
                        </div>
                    </div>
                    {{-- <div class="tf-mini-cart-wrap">
                        <div class="tf-mini-cart-main">
                            <div class="tf-mini-cart-sroll">
                                <div class="tf-mini-cart-items">
                                    <div class="tf-mini-cart-item">
                                        <div class="tf-mini-cart-image">
                                            <a href="product-detail.html">
                                                <img src="images/products/white-2.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="tf-mini-cart-info">
                                            <a class="title link" href="product-detail.html">T-shirt</a>
                                            <div class="meta-variant">Light gray</div>
                                            <div class="price fw-6">$25.00</div>
                                            <div class="tf-mini-cart-btns">
                                                <div class="wg-quantity small">
                                                    <span class="btn-quantity minus-btn">-</span>
                                                    <input type="text" name="number" value="1">
                                                    <span class="btn-quantity plus-btn">+</span>
                                                </div>
                                                <div class="tf-mini-cart-remove">Remove</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tf-mini-cart-item">
                                        <div class="tf-mini-cart-image">
                                            <a href="product-detail.html">
                                                <img src="images/products/white-3.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="tf-mini-cart-info">
                                            <a class="title link" href="product-detail.html">Oversized Motif T-shirt</a>
                                            <div class="price fw-6">$25.00</div>
                                            <div class="tf-mini-cart-btns">
                                                <div class="wg-quantity small">
                                                    <span class="btn-quantity minus-btn">-</span>
                                                    <input type="text" name="number" value="1">
                                                    <span class="btn-quantity plus-btn">+</span>
                                                </div>
                                                <div class="tf-mini-cart-remove">Remove</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-minicart-recommendations">
                                    <div class="tf-minicart-recommendations-heading">
                                        <div class="tf-minicart-recommendations-title">You may also like</div>
                                        <div class="sw-dots small style-2 cart-slide-pagination"></div>
                                    </div>
                                    <div dir="ltr" class="swiper tf-cart-slide">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="tf-minicart-recommendations-item">
                                                    <div class="tf-minicart-recommendations-item-image">
                                                        <a href="product-detail.html">
                                                            <img src="images/products/white-3.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="tf-minicart-recommendations-item-infos flex-grow-1">
                                                        <a class="title" href="product-detail.html">Loose Fit
                                                            Sweatshirt</a>
                                                        <div class="price">$25.00</div>
                                                    </div>
                                                    <div class="tf-minicart-recommendations-item-quickview">
                                                        <div class="btn-show-quickview quickview hover-tooltip">
                                                            <span class="icon icon-view"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="tf-minicart-recommendations-item">
                                                    <div class="tf-minicart-recommendations-item-image">
                                                        <a href="product-detail.html">
                                                            <img src="images/products/white-2.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="tf-minicart-recommendations-item-infos flex-grow-1">
                                                        <a class="title" href="product-detail.html">Loose Fit Hoodie</a>
                                                        <div class="price">$25.00</div>
                                                    </div>
                                                    <div class="tf-minicart-recommendations-item-quickview">
                                                        <div class="btn-show-quickview quickview hover-tooltip">
                                                            <span class="icon icon-view"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tf-mini-cart-bottom">
                            <div class="tf-mini-cart-tool">
                                <div class="tf-mini-cart-tool-btn btn-add-note">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18"
                                        fill="currentColor">
                                        <path
                                            d="M5.12187 16.4582H2.78952C2.02045 16.4582 1.39476 15.8325 1.39476 15.0634V2.78952C1.39476 2.02045 2.02045 1.39476 2.78952 1.39476H11.3634C12.1325 1.39476 12.7582 2.02045 12.7582 2.78952V7.07841C12.7582 7.46357 13.0704 7.77579 13.4556 7.77579C13.8407 7.77579 14.1529 7.46357 14.1529 7.07841V2.78952C14.1529 1.25138 12.9016 0 11.3634 0H2.78952C1.25138 0 0 1.25138 0 2.78952V15.0634C0 16.6015 1.25138 17.8529 2.78952 17.8529H5.12187C5.50703 17.8529 5.81925 17.5407 5.81925 17.1555C5.81925 16.7704 5.50703 16.4582 5.12187 16.4582Z">
                                        </path>
                                        <path
                                            d="M15.3882 10.0971C14.5724 9.28136 13.2452 9.28132 12.43 10.0965L8.60127 13.9168C8.51997 13.9979 8.45997 14.0979 8.42658 14.2078L7.59276 16.9528C7.55646 17.0723 7.55292 17.1993 7.58249 17.3207C7.61206 17.442 7.67367 17.5531 7.76087 17.6425C7.84807 17.7319 7.95768 17.7962 8.07823 17.8288C8.19879 17.8613 8.32587 17.8609 8.44621 17.8276L11.261 17.0479C11.3769 17.0158 11.4824 16.9543 11.5675 16.8694L15.3882 13.0559C16.2039 12.2401 16.2039 10.9129 15.3882 10.0971ZM10.712 15.7527L9.29586 16.145L9.71028 14.7806L12.2937 12.2029L13.2801 13.1893L10.712 15.7527ZM14.4025 12.0692L14.2673 12.204L13.2811 11.2178L13.4157 11.0834C13.6876 10.8115 14.1301 10.8115 14.402 11.0834C14.6739 11.3553 14.6739 11.7977 14.4025 12.0692Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="tf-mini-cart-tool-btn btn-add-gift">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.99566 2.73409C2.99566 0.55401 5.42538 -0.746668 7.23916 0.463462L8.50073 1.30516L9.7623 0.463462C11.5761 -0.746668 14.0058 0.55401 14.0058 2.73409V3.24744H14.8225C15.9633 3.24744 16.8881 4.17233 16.8881 5.31312V6.82566C16.8881 7.21396 16.5734 7.52873 16.1851 7.52873H15.8905V15.1877C15.8905 15.1905 15.8905 15.1933 15.8905 15.196C15.886 16.7454 14.6286 18 13.0782 18H3.92323C2.37003 18 1.11091 16.7409 1.11091 15.1877V7.52877H0.81636C0.42806 7.52877 0.113281 7.21399 0.113281 6.82569V5.31316C0.113281 4.17228 1.03812 3.24744 2.179 3.24744H2.99566V2.73409ZM4.40181 3.24744H7.79765V2.52647L6.45874 1.63317C5.57987 1.0468 4.40181 1.67677 4.40181 2.73409V3.24744ZM9.20381 2.52647V3.24744H12.5996V2.73409C12.5996 1.67677 11.4216 1.0468 10.5427 1.63317L9.20381 2.52647ZM2.179 4.6536C1.81472 4.6536 1.51944 4.94888 1.51944 5.31316V6.12261H5.73398L5.734 4.6536H2.179ZM5.73401 7.52877V13.9306C5.73401 14.1806 5.86682 14.4119 6.08281 14.5379C6.29879 14.6639 6.56545 14.6657 6.78312 14.5426L8.50073 13.5715L10.2183 14.5426C10.436 14.6657 10.7027 14.6639 10.9187 14.5379C11.1346 14.4119 11.2674 14.1806 11.2674 13.9306V7.52873H14.4844V15.1603C14.4844 15.1627 14.4843 15.1651 14.4843 15.1675V15.1877C14.4843 15.9643 13.8548 16.5938 13.0782 16.5938H3.92323C3.14663 16.5938 2.51707 15.9643 2.51707 15.1877V7.52877H5.73401ZM15.482 6.12258V5.31312C15.482 4.94891 15.1867 4.6536 14.8225 4.6536H11.2674V6.12258H15.482ZM9.86129 4.6536H7.14017V12.7254L8.15469 12.1518C8.36941 12.0304 8.63204 12.0304 8.84676 12.1518L9.86129 12.7254V4.6536Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="tf-mini-cart-tool-btn btn-estimate-shipping">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="18" viewBox="0 0 26 18"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 0.811989C0 0.36354 0.36354 0 0.811989 0H15.4278C15.8763 0 16.2398 0.36354 16.2398 0.811989V3.10596H21.0144C23.6241 3.10596 25.8643 5.05894 25.8643 7.61523V14.6414C25.8643 15.0899 25.5007 15.4534 25.0523 15.4534H23.545C23.2139 16.9115 21.9098 18 20.3514 18C18.7931 18 17.4889 16.9115 17.1578 15.4534H8.69534C8.36423 16.9115 7.0601 18 5.50175 18C3.9434 18 2.63927 16.9115 2.30815 15.4534H0.811989C0.36354 15.4534 0 15.0899 0 14.6414V0.811989ZM2.35089 13.8294C2.74052 12.4562 4.00366 11.4503 5.50175 11.4503C6.99983 11.4503 8.26298 12.4562 8.6526 13.8294H14.6158V1.62398H1.62398V13.8294H2.35089ZM16.2398 4.72994V7.95749H24.2403V7.61523C24.2403 6.08759 22.8649 4.72994 21.0144 4.72994H16.2398ZM24.2403 9.58147H16.2398V13.8294H17.2006C17.5902 12.4562 18.8533 11.4503 20.3514 11.4503C21.8495 11.4503 23.1126 12.4562 23.5023 13.8294H24.2403V9.58147ZM5.50175 13.0743C4.58999 13.0743 3.85087 13.8134 3.85087 14.7251C3.85087 15.6369 4.58999 16.376 5.50175 16.376C6.41351 16.376 7.15263 15.6369 7.15263 14.7251C7.15263 13.8134 6.41351 13.0743 5.50175 13.0743ZM20.3514 13.0743C19.4397 13.0743 18.7005 13.8134 18.7005 14.7251C18.7005 15.6369 19.4397 16.376 20.3514 16.376C21.2632 16.376 22.0023 15.6369 22.0023 14.7251C22.0023 13.8134 21.2632 13.0743 20.3514 13.0743Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="tf-mini-cart-bottom-wrap">
                                <div class="tf-cart-totals-discounts">
                                    <div class="tf-cart-total">Subtotal</div>
                                    <div class="tf-totals-total-value fw-6">$49.99 USD</div>
                                </div>
                                <div class="tf-cart-tax">Taxes and <a href="#">shipping</a> calculated at checkout</div>
                                <div class="tf-mini-cart-line"></div>
                                <div class="tf-cart-checkbox">
                                    <div class="tf-checkbox-wrapp">
                                        <input class="" type="checkbox" id="CartDrawer-Form_agree"
                                            name="agree_checkbox">
                                        <div>
                                            <i class="icon-check"></i>
                                        </div>
                                    </div>
                                    <label for="CartDrawer-Form_agree">
                                        I agree with the
                                        <a href="#" title="Terms of Service">terms and conditions</a>
                                    </label>
                                </div>
                                <div class="tf-mini-cart-view-checkout">
                                    <a href="view-cart.html"
                                        class="tf-btn btn-outline radius-3 link w-100 justify-content-center">View
                                        cart</a>
                                    <a href="checkout.html"
                                        class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Check
                                            out</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="tf-mini-cart-tool-openable add-note">
                            <div class="overplay tf-mini-cart-tool-close"></div>
                            <div class="tf-mini-cart-tool-content">
                                <label for="Cart-note" class="tf-mini-cart-tool-text">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                            viewBox="0 0 16 18" fill="currentColor">
                                            <path
                                                d="M5.12187 16.4582H2.78952C2.02045 16.4582 1.39476 15.8325 1.39476 15.0634V2.78952C1.39476 2.02045 2.02045 1.39476 2.78952 1.39476H11.3634C12.1325 1.39476 12.7582 2.02045 12.7582 2.78952V7.07841C12.7582 7.46357 13.0704 7.77579 13.4556 7.77579C13.8407 7.77579 14.1529 7.46357 14.1529 7.07841V2.78952C14.1529 1.25138 12.9016 0 11.3634 0H2.78952C1.25138 0 0 1.25138 0 2.78952V15.0634C0 16.6015 1.25138 17.8529 2.78952 17.8529H5.12187C5.50703 17.8529 5.81925 17.5407 5.81925 17.1555C5.81925 16.7704 5.50703 16.4582 5.12187 16.4582Z">
                                            </path>
                                            <path
                                                d="M15.3882 10.0971C14.5724 9.28136 13.2452 9.28132 12.43 10.0965L8.60127 13.9168C8.51997 13.9979 8.45997 14.0979 8.42658 14.2078L7.59276 16.9528C7.55646 17.0723 7.55292 17.1993 7.58249 17.3207C7.61206 17.442 7.67367 17.5531 7.76087 17.6425C7.84807 17.7319 7.95768 17.7962 8.07823 17.8288C8.19879 17.8613 8.32587 17.8609 8.44621 17.8276L11.261 17.0479C11.3769 17.0158 11.4824 16.9543 11.5675 16.8694L15.3882 13.0559C16.2039 12.2401 16.2039 10.9129 15.3882 10.0971ZM10.712 15.7527L9.29586 16.145L9.71028 14.7806L12.2937 12.2029L13.2801 13.1893L10.712 15.7527ZM14.4025 12.0692L14.2673 12.204L13.2811 11.2178L13.4157 11.0834C13.6876 10.8115 14.1301 10.8115 14.402 11.0834C14.6739 11.3553 14.6739 11.7977 14.4025 12.0692Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span>Add Order Note</span>
                                </label>
                                <textarea name="note" id="Cart-note" placeholder="How can we help you?"></textarea>
                                <div class="tf-cart-tool-btns justify-content-center">
                                    <div
                                        class="tf-mini-cart-tool-primary text-center w-100 fw-6 tf-mini-cart-tool-close">
                                        Close</div>
                                </div>
                            </div>
                        </div>
                        <div class="tf-mini-cart-tool-openable add-gift">
                            <div class="overplay tf-mini-cart-tool-close"></div>
                            <form class="tf-product-form-addgift">
                                <div class="tf-mini-cart-tool-content">
                                    <div class="tf-mini-cart-tool-text">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.65957 3.64545C4.65957 0.73868 7.89921 -0.995558 10.3176 0.617949L11.9997 1.74021L13.6818 0.617949C16.1001 -0.995558 19.3398 0.73868 19.3398 3.64545V4.32992H20.4286C21.9498 4.32992 23.1829 5.56311 23.1829 7.08416V9.10087C23.1829 9.61861 22.7632 10.0383 22.2454 10.0383H21.8528V20.2502C21.8528 20.254 21.8527 20.2577 21.8527 20.2614C21.8467 22.3272 20.1702 24 18.103 24H5.89634C3.82541 24 2.14658 22.3212 2.14658 20.2502V10.0384H1.75384C1.23611 10.0384 0.816406 9.61865 0.816406 9.10092V7.08421C0.816406 5.56304 2.04953 4.32992 3.57069 4.32992H4.65957V3.64545ZM6.53445 4.32992H11.0622V3.36863L9.27702 2.17757C8.10519 1.39573 6.53445 2.2357 6.53445 3.64545V4.32992ZM12.9371 3.36863V4.32992H17.4649V3.64545C17.4649 2.2357 15.8942 1.39573 14.7223 2.17756L12.9371 3.36863ZM3.57069 6.2048C3.08499 6.2048 2.69128 6.59851 2.69128 7.08421V8.16348H8.31067L8.3107 6.2048H3.57069ZM8.31071 10.0384V18.5741C8.31071 18.9075 8.48779 19.2158 8.77577 19.3838C9.06376 19.5518 9.4193 19.5542 9.70953 19.3901L11.9997 18.0953L14.2898 19.3901C14.58 19.5542 14.9356 19.5518 15.2236 19.3838C15.5115 19.2158 15.6886 18.9075 15.6886 18.5741V10.0383H19.9779V20.2137C19.9778 20.2169 19.9778 20.2201 19.9778 20.2233V20.2502C19.9778 21.2857 19.1384 22.1251 18.103 22.1251H5.89634C4.86088 22.1251 4.02146 21.2857 4.02146 20.2502V10.0384H8.31071ZM21.308 8.16344V7.08416C21.308 6.59854 20.9143 6.2048 20.4286 6.2048H15.6886V8.16344H21.308ZM13.8138 6.2048H10.1856V16.9672L11.5383 16.2024C11.8246 16.0405 12.1748 16.0405 12.461 16.2024L13.8138 16.9672V6.2048Z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="tf-gift-wrap-infos">
                                            <p>Do you want a gift wrap?</p>
                                            Only
                                            <span class="price fw-6">$5.00</span>
                                        </div>
                                    </div>
                                    <div class="tf-cart-tool-btns">
                                        <button type="submit"
                                            class="tf-btn fw-6 w-100 justify-content-center btn-fill animate-hover-btn radius-3"><span>Add
                                                a gift wrap</span></button>
                                        <div
                                            class="tf-mini-cart-tool-primary text-center w-100 fw-6 tf-mini-cart-tool-close">
                                            Cancel</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tf-mini-cart-tool-openable estimate-shipping">
                            <div class="overplay tf-mini-cart-tool-close"></div>
                            <div class="tf-mini-cart-tool-content">
                                <div class="tf-mini-cart-tool-text">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="15"
                                            viewBox="0 0 21 15" fill="currentColor">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M0.441406 1.13155C0.441406 0.782753 0.724159 0.5 1.07295 0.5H12.4408C12.7896 0.5 13.0724 0.782753 13.0724 1.13155V2.91575H16.7859C18.8157 2.91575 20.5581 4.43473 20.5581 6.42296V11.8878C20.5581 12.2366 20.2753 12.5193 19.9265 12.5193H18.7542C18.4967 13.6534 17.4823 14.5 16.2703 14.5C15.0582 14.5 14.0439 13.6534 13.7864 12.5193H7.20445C6.94692 13.6534 5.93259 14.5 4.72054 14.5C3.50849 14.5 2.49417 13.6534 2.23664 12.5193H1.07295C0.724159 12.5193 0.441406 12.2366 0.441406 11.8878V1.13155ZM2.26988 11.2562C2.57292 10.1881 3.55537 9.40578 4.72054 9.40578C5.88572 9.40578 6.86817 10.1881 7.17121 11.2562H11.8093V1.76309H1.7045V11.2562H2.26988ZM13.0724 4.17884V6.68916H19.295V6.42296C19.295 5.2348 18.2252 4.17884 16.7859 4.17884H13.0724ZM19.295 7.95226H13.0724V11.2562H13.8196C14.1227 10.1881 15.1051 9.40578 16.2703 9.40578C17.4355 9.40578 18.4179 10.1881 18.7209 11.2562H19.295V7.95226ZM4.72054 10.6689C4.0114 10.6689 3.43652 11.2437 3.43652 11.9529C3.43652 12.662 4.0114 13.2369 4.72054 13.2369C5.42969 13.2369 6.00456 12.662 6.00456 11.9529C6.00456 11.2437 5.42969 10.6689 4.72054 10.6689ZM16.2703 10.6689C15.5611 10.6689 14.9863 11.2437 14.9863 11.9529C14.9863 12.662 15.5611 13.2369 16.2703 13.2369C16.9794 13.2369 17.5543 12.662 17.5543 11.9529C17.5543 11.2437 16.9794 10.6689 16.2703 10.6689Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="fw-6">Estimate Shipping</span>
                                </div>
                                <div class="field">
                                    <p>Country</p>
                                    <select class="tf-select w-100" id="ShippingCountry_CartDrawer-Form"
                                        name="address[country]" data-default="">
                                        <option value="---" data-provinces="[]">---</option>
                                        <option value="Australia"
                                            data-provinces="[['Australian Capital Territory','Australian Capital Territory'],['New South Wales','New South Wales'],['Northern Territory','Northern Territory'],['Queensland','Queensland'],['South Australia','South Australia'],['Tasmania','Tasmania'],['Victoria','Victoria'],['Western Australia','Western Australia']]">
                                            Australia</option>
                                        <option value="Austria" data-provinces="[]">Austria</option>
                                        <option value="Belgium" data-provinces="[]">Belgium</option>
                                        <option value="Canada"
                                            data-provinces="[['Alberta','Alberta'],['British Columbia','British Columbia'],['Manitoba','Manitoba'],['New Brunswick','New Brunswick'],['Newfoundland and Labrador','Newfoundland and Labrador'],['Northwest Territories','Northwest Territories'],['Nova Scotia','Nova Scotia'],['Nunavut','Nunavut'],['Ontario','Ontario'],['Prince Edward Island','Prince Edward Island'],['Quebec','Quebec'],['Saskatchewan','Saskatchewan'],['Yukon','Yukon']]">
                                            Canada</option>
                                        <option value="Czech Republic" data-provinces="[]">Czechia</option>
                                        <option value="Denmark" data-provinces="[]">Denmark</option>
                                        <option value="Finland" data-provinces="[]">Finland</option>
                                        <option value="France" data-provinces="[]">France</option>
                                        <option value="Germany" data-provinces="[]">Germany</option>
                                        <option value="Hong Kong"
                                            data-provinces="[['Hong Kong Island','Hong Kong Island'],['Kowloon','Kowloon'],['New Territories','New Territories']]">
                                            Hong Kong SAR</option>
                                        <option value="Ireland"
                                            data-provinces="[['Carlow','Carlow'],['Cavan','Cavan'],['Clare','Clare'],['Cork','Cork'],['Donegal','Donegal'],['Dublin','Dublin'],['Galway','Galway'],['Kerry','Kerry'],['Kildare','Kildare'],['Kilkenny','Kilkenny'],['Laois','Laois'],['Leitrim','Leitrim'],['Limerick','Limerick'],['Longford','Longford'],['Louth','Louth'],['Mayo','Mayo'],['Meath','Meath'],['Monaghan','Monaghan'],['Offaly','Offaly'],['Roscommon','Roscommon'],['Sligo','Sligo'],['Tipperary','Tipperary'],['Waterford','Waterford'],['Westmeath','Westmeath'],['Wexford','Wexford'],['Wicklow','Wicklow']]">
                                            Ireland</option>
                                        <option value="Israel" data-provinces="[]">Israel</option>
                                        <option value="Italy"
                                            data-provinces="[['Agrigento','Agrigento'],['Alessandria','Alessandria'],['Ancona','Ancona'],['Aosta','Aosta Valley'],['Arezzo','Arezzo'],['Ascoli Piceno','Ascoli Piceno'],['Asti','Asti'],['Avellino','Avellino'],['Bari','Bari'],['Barletta-Andria-Trani','Barletta-Andria-Trani'],['Belluno','Belluno'],['Benevento','Benevento'],['Bergamo','Bergamo'],['Biella','Biella'],['Bologna','Bologna'],['Bolzano','South Tyrol'],['Brescia','Brescia'],['Brindisi','Brindisi'],['Cagliari','Cagliari'],['Caltanissetta','Caltanissetta'],['Campobasso','Campobasso'],['Carbonia-Iglesias','Carbonia-Iglesias'],['Caserta','Caserta'],['Catania','Catania'],['Catanzaro','Catanzaro'],['Chieti','Chieti'],['Como','Como'],['Cosenza','Cosenza'],['Cremona','Cremona'],['Crotone','Crotone'],['Cuneo','Cuneo'],['Enna','Enna'],['Fermo','Fermo'],['Ferrara','Ferrara'],['Firenze','Florence'],['Foggia','Foggia'],['Forlì-Cesena','Forlì-Cesena'],['Frosinone','Frosinone'],['Genova','Genoa'],['Gorizia','Gorizia'],['Grosseto','Grosseto'],['Imperia','Imperia'],['Isernia','Isernia'],['L'Aquila','L’Aquila'],['La Spezia','La Spezia'],['Latina','Latina'],['Lecce','Lecce'],['Lecco','Lecco'],['Livorno','Livorno'],['Lodi','Lodi'],['Lucca','Lucca'],['Macerata','Macerata'],['Mantova','Mantua'],['Massa-Carrara','Massa and Carrara'],['Matera','Matera'],['Medio Campidano','Medio Campidano'],['Messina','Messina'],['Milano','Milan'],['Modena','Modena'],['Monza e Brianza','Monza and Brianza'],['Napoli','Naples'],['Novara','Novara'],['Nuoro','Nuoro'],['Ogliastra','Ogliastra'],['Olbia-Tempio','Olbia-Tempio'],['Oristano','Oristano'],['Padova','Padua'],['Palermo','Palermo'],['Parma','Parma'],['Pavia','Pavia'],['Perugia','Perugia'],['Pesaro e Urbino','Pesaro and Urbino'],['Pescara','Pescara'],['Piacenza','Piacenza'],['Pisa','Pisa'],['Pistoia','Pistoia'],['Pordenone','Pordenone'],['Potenza','Potenza'],['Prato','Prato'],['Ragusa','Ragusa'],['Ravenna','Ravenna'],['Reggio Calabria','Reggio Calabria'],['Reggio Emilia','Reggio Emilia'],['Rieti','Rieti'],['Rimini','Rimini'],['Roma','Rome'],['Rovigo','Rovigo'],['Salerno','Salerno'],['Sassari','Sassari'],['Savona','Savona'],['Siena','Siena'],['Siracusa','Syracuse'],['Sondrio','Sondrio'],['Taranto','Taranto'],['Teramo','Teramo'],['Terni','Terni'],['Torino','Turin'],['Trapani','Trapani'],['Trento','Trentino'],['Treviso','Treviso'],['Trieste','Trieste'],['Udine','Udine'],['Varese','Varese'],['Venezia','Venice'],['Verbano-Cusio-Ossola','Verbano-Cusio-Ossola'],['Vercelli','Vercelli'],['Verona','Verona'],['Vibo Valentia','Vibo Valentia'],['Vicenza','Vicenza'],['Viterbo','Viterbo']]">
                                            Italy</option>
                                        <option value="Japan"
                                            data-provinces="[['Aichi','Aichi'],['Akita','Akita'],['Aomori','Aomori'],['Chiba','Chiba'],['Ehime','Ehime'],['Fukui','Fukui'],['Fukuoka','Fukuoka'],['Fukushima','Fukushima'],['Gifu','Gifu'],['Gunma','Gunma'],['Hiroshima','Hiroshima'],['Hokkaidō','Hokkaido'],['Hyōgo','Hyogo'],['Ibaraki','Ibaraki'],['Ishikawa','Ishikawa'],['Iwate','Iwate'],['Kagawa','Kagawa'],['Kagoshima','Kagoshima'],['Kanagawa','Kanagawa'],['Kumamoto','Kumamoto'],['Kyōto','Kyoto'],['Kōchi','Kochi'],['Mie','Mie'],['Miyagi','Miyagi'],['Miyazaki','Miyazaki'],['Nagano','Nagano'],['Nagasaki','Nagasaki'],['Nara','Nara'],['Niigata','Niigata'],['Okayama','Okayama'],['Okinawa','Okinawa'],['Saga','Saga'],['Saitama','Saitama'],['Shiga','Shiga'],['Shimane','Shimane'],['Shizuoka','Shizuoka'],['Tochigi','Tochigi'],['Tokushima','Tokushima'],['Tottori','Tottori'],['Toyama','Toyama'],['Tōkyō','Tokyo'],['Wakayama','Wakayama'],['Yamagata','Yamagata'],['Yamaguchi','Yamaguchi'],['Yamanashi','Yamanashi'],['Ōita','Oita'],['Ōsaka','Osaka']]">
                                            Japan</option>
                                        <option value="Malaysia"
                                            data-provinces="[['Johor','Johor'],['Kedah','Kedah'],['Kelantan','Kelantan'],['Kuala Lumpur','Kuala Lumpur'],['Labuan','Labuan'],['Melaka','Malacca'],['Negeri Sembilan','Negeri Sembilan'],['Pahang','Pahang'],['Penang','Penang'],['Perak','Perak'],['Perlis','Perlis'],['Putrajaya','Putrajaya'],['Sabah','Sabah'],['Sarawak','Sarawak'],['Selangor','Selangor'],['Terengganu','Terengganu']]">
                                            Malaysia</option>
                                        <option value="Netherlands" data-provinces="[]">Netherlands</option>
                                        <option value="New Zealand"
                                            data-provinces="[['Auckland','Auckland'],['Bay of Plenty','Bay of Plenty'],['Canterbury','Canterbury'],['Chatham Islands','Chatham Islands'],['Gisborne','Gisborne'],['Hawke's Bay','Hawke’s Bay'],['Manawatu-Wanganui','Manawatū-Whanganui'],['Marlborough','Marlborough'],['Nelson','Nelson'],['Northland','Northland'],['Otago','Otago'],['Southland','Southland'],['Taranaki','Taranaki'],['Tasman','Tasman'],['Waikato','Waikato'],['Wellington','Wellington'],['West Coast','West Coast']]">
                                            New Zealand</option>
                                        <option value="Norway" data-provinces="[]">Norway</option>
                                        <option value="Poland" data-provinces="[]">Poland</option>
                                        <option value="Portugal"
                                            data-provinces="[['Aveiro','Aveiro'],['Açores','Azores'],['Beja','Beja'],['Braga','Braga'],['Bragança','Bragança'],['Castelo Branco','Castelo Branco'],['Coimbra','Coimbra'],['Faro','Faro'],['Guarda','Guarda'],['Leiria','Leiria'],['Lisboa','Lisbon'],['Madeira','Madeira'],['Portalegre','Portalegre'],['Porto','Porto'],['Santarém','Santarém'],['Setúbal','Setúbal'],['Viana do Castelo','Viana do Castelo'],['Vila Real','Vila Real'],['Viseu','Viseu'],['Évora','Évora']]">
                                            Portugal</option>
                                        <option value="Singapore" data-provinces="[]">Singapore</option>
                                        <option value="South Korea"
                                            data-provinces="[['Busan','Busan'],['Chungbuk','North Chungcheong'],['Chungnam','South Chungcheong'],['Daegu','Daegu'],['Daejeon','Daejeon'],['Gangwon','Gangwon'],['Gwangju','Gwangju City'],['Gyeongbuk','North Gyeongsang'],['Gyeonggi','Gyeonggi'],['Gyeongnam','South Gyeongsang'],['Incheon','Incheon'],['Jeju','Jeju'],['Jeonbuk','North Jeolla'],['Jeonnam','South Jeolla'],['Sejong','Sejong'],['Seoul','Seoul'],['Ulsan','Ulsan']]">
                                            South Korea</option>
                                        <option value="Spain"
                                            data-provinces="[['A Coruña','A Coruña'],['Albacete','Albacete'],['Alicante','Alicante'],['Almería','Almería'],['Asturias','Asturias Province'],['Badajoz','Badajoz'],['Balears','Balears Province'],['Barcelona','Barcelona'],['Burgos','Burgos'],['Cantabria','Cantabria Province'],['Castellón','Castellón'],['Ceuta','Ceuta'],['Ciudad Real','Ciudad Real'],['Cuenca','Cuenca'],['Cáceres','Cáceres'],['Cádiz','Cádiz'],['Córdoba','Córdoba'],['Girona','Girona'],['Granada','Granada'],['Guadalajara','Guadalajara'],['Guipúzcoa','Gipuzkoa'],['Huelva','Huelva'],['Huesca','Huesca'],['Jaén','Jaén'],['La Rioja','La Rioja Province'],['Las Palmas','Las Palmas'],['León','León'],['Lleida','Lleida'],['Lugo','Lugo'],['Madrid','Madrid Province'],['Melilla','Melilla'],['Murcia','Murcia'],['Málaga','Málaga'],['Navarra','Navarra'],['Ourense','Ourense'],['Palencia','Palencia'],['Pontevedra','Pontevedra'],['Salamanca','Salamanca'],['Santa Cruz de Tenerife','Santa Cruz de Tenerife'],['Segovia','Segovia'],['Sevilla','Seville'],['Soria','Soria'],['Tarragona','Tarragona'],['Teruel','Teruel'],['Toledo','Toledo'],['Valencia','Valencia'],['Valladolid','Valladolid'],['Vizcaya','Biscay'],['Zamora','Zamora'],['Zaragoza','Zaragoza'],['Álava','Álava'],['Ávila','Ávila']]">
                                            Spain</option>
                                        <option value="Sweden" data-provinces="[]">Sweden</option>
                                        <option value="Switzerland" data-provinces="[]">Switzerland</option>
                                        <option value="United Arab Emirates"
                                            data-provinces="[['Abu Dhabi','Abu Dhabi'],['Ajman','Ajman'],['Dubai','Dubai'],['Fujairah','Fujairah'],['Ras al-Khaimah','Ras al-Khaimah'],['Sharjah','Sharjah'],['Umm al-Quwain','Umm al-Quwain']]">
                                            United Arab Emirates</option>
                                        <option value="United Kingdom"
                                            data-provinces="[['British Forces','British Forces'],['England','England'],['Northern Ireland','Northern Ireland'],['Scotland','Scotland'],['Wales','Wales']]">
                                            United Kingdom</option>
                                        <option value="United States"
                                            data-provinces="[['Alabama','Alabama'],['Alaska','Alaska'],['American Samoa','American Samoa'],['Arizona','Arizona'],['Arkansas','Arkansas'],['Armed Forces Americas','Armed Forces Americas'],['Armed Forces Europe','Armed Forces Europe'],['Armed Forces Pacific','Armed Forces Pacific'],['California','California'],['Colorado','Colorado'],['Connecticut','Connecticut'],['Delaware','Delaware'],['District of Columbia','Washington DC'],['Federated States of Micronesia','Micronesia'],['Florida','Florida'],['Georgia','Georgia'],['Guam','Guam'],['Hawaii','Hawaii'],['Idaho','Idaho'],['Illinois','Illinois'],['Indiana','Indiana'],['Iowa','Iowa'],['Kansas','Kansas'],['Kentucky','Kentucky'],['Louisiana','Louisiana'],['Maine','Maine'],['Marshall Islands','Marshall Islands'],['Maryland','Maryland'],['Massachusetts','Massachusetts'],['Michigan','Michigan'],['Minnesota','Minnesota'],['Mississippi','Mississippi'],['Missouri','Missouri'],['Montana','Montana'],['Nebraska','Nebraska'],['Nevada','Nevada'],['New Hampshire','New Hampshire'],['New Jersey','New Jersey'],['New Mexico','New Mexico'],['New York','New York'],['North Carolina','North Carolina'],['North Dakota','North Dakota'],['Northern Mariana Islands','Northern Mariana Islands'],['Ohio','Ohio'],['Oklahoma','Oklahoma'],['Oregon','Oregon'],['Palau','Palau'],['Pennsylvania','Pennsylvania'],['Puerto Rico','Puerto Rico'],['Rhode Island','Rhode Island'],['South Carolina','South Carolina'],['South Dakota','South Dakota'],['Tennessee','Tennessee'],['Texas','Texas'],['Utah','Utah'],['Vermont','Vermont'],['Virgin Islands','U.S. Virgin Islands'],['Virginia','Virginia'],['Washington','Washington'],['West Virginia','West Virginia'],['Wisconsin','Wisconsin'],['Wyoming','Wyoming']]">
                                            United States</option>
                                        <option value="Vietnam" data-provinces="[]">Vietnam</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <p>Zip code</p>
                                    <input type="text" name="text" placeholder="">
                                </div>
                                <div class="tf-cart-tool-btns">
                                    <a href="#"
                                        class="tf-btn fw-6 justify-content-center btn-fill w-100 animate-hover-btn radius-3"><span>Estimate</span></a>
                                    <div
                                        class="tf-mini-cart-tool-primary text-center fw-6 w-100 tf-mini-cart-tool-close">
                                        Cancel</div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- /shoppingCart -->

    <!-- modal compare -->
    {{-- <div class="offcanvas offcanvas-bottom canvas-compare" id="compare">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <div class="close-popup">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
                </div>
            </header>
            <div class="canvas-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="tf-compare-list">
                                <div class="tf-compare-head">
                                    <div class="title">Compare Products</div>
                                </div>
                                <div class="tf-compare-offcanvas">
                                    <div class="tf-compare-item">
                                        <div class="position-relative">
                                            <div class="icon">
                                                <i class="icon-close"></i>
                                            </div>
                                            <a href="product-detail.html">
                                                <img class="radius-3" src="images/products/orange-1.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="tf-compare-item">
                                        <div class="position-relative">
                                            <div class="icon">
                                                <i class="icon-close"></i>
                                            </div>
                                            <a href="product-detail.html">
                                                <img class="radius-3" src="images/products/pink-1.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-compare-buttons">
                                    <div class="tf-compare-buttons-wrap">
                                        <a href="compare.html"
                                            class="tf-btn radius-3 btn-fill justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn ">Compare</a>
                                        <div class="tf-compapre-button-clear-all link">
                                            Clear All
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- /modal compare -->

    <!-- modal quick_add -->
    <div class="modal fade modalDemo popup-quickadd" id="quick_add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    {{-- <div class="tf-product-info-item">
                        <div class="image">
                            <img src="images/products/orange-1.jpg" alt="">
                        </div>
                        <div class="content">
                            <a href="product-detail.html">Ribbed Tank Top</a>
                            <div class="tf-product-info-price">
                                <!-- <div class="price-on-sale">$8.00</div>
                                <div class="compare-at-price">$10.00</div>
                                <div class="badges-on-sale"><span>20</span>% OFF</div> -->
                                <div class="price">$18.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-variant-picker mb_15">
                        <div class="variant-picker-item">
                            <div class="variant-picker-label">
                                Color: <span class="fw-6 variant-picker-label-value">Orange</span>
                            </div>
                            <div class="variant-picker-values">
                                <input id="values-orange" type="radio" name="color" checked>
                                <label class="hover-tooltip radius-60" for="values-orange" data-value="Orange">
                                    <span class="btn-checkbox bg-color-orange"></span>
                                    <span class="tooltip">Orange</span>
                                </label>
                                <input id="values-black" type="radio" name="color">
                                <label class=" hover-tooltip radius-60" for="values-black" data-value="Black">
                                    <span class="btn-checkbox bg-color-black"></span>
                                    <span class="tooltip">Black</span>
                                </label>
                                <input id="values-white" type="radio" name="color">
                                <label class="hover-tooltip radius-60" for="values-white" data-value="White">
                                    <span class="btn-checkbox bg-color-white"></span>
                                    <span class="tooltip">White</span>
                                </label>
                            </div>
                        </div>
                        <div class="variant-picker-item">
                            <div class="variant-picker-label">
                                Size: <span class="fw-6 variant-picker-label-value">S</span>
                            </div>
                            <div class="variant-picker-values">
                                <input type="radio" name="size" id="values-s" checked>
                                <label class="style-text" for="values-s" data-value="S">
                                    <p>S</p>
                                </label>
                                <input type="radio" name="size" id="values-m">
                                <label class="style-text" for="values-m" data-value="M">
                                    <p>M</p>
                                </label>
                                <input type="radio" name="size" id="values-l">
                                <label class="style-text" for="values-l" data-value="L">
                                    <p>L</p>
                                </label>
                                <input type="radio" name="size" id="values-xl">
                                <label class="style-text" for="values-xl" data-value="XL">
                                    <p>XL</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-quantity mb_15">
                        <div class="quantity-title fw-6">Quantity</div>
                        <div class="wg-quantity">
                            <span class="btn-quantity minus-btn">-</span>
                            <input type="text" name="number" value="1">
                            <span class="btn-quantity plus-btn">+</span>
                        </div>
                    </div> --}}
                    <div class="tf-product-info-buy-button">
                        <form class="">
                            <a href="#"
                                class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>Add
                                    to cart -&nbsp;</span><span class="tf-qty-price">$18.00</span></a>
                            <div class="tf-product-btn-wishlist btn-icon-action">
                                <i class="icon-heart"></i>
                                <i class="icon-delete"></i>
                            </div>
                            <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                class="tf-product-btn-wishlist box-icon bg_white compare btn-icon-action">
                                <span class="icon icon-compare"></span>
                                <span class="icon icon-check"></span>
                            </a>
                            <div class="w-100">
                                <a href="#" class="btns-full">Buy with <img src="{{asset('frontend/images/payments/paypal.png')}}" alt=""></a>
                                <a href="#" class="payment-more-option">More payment options</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal quick_add -->


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
                            <img class="sizechart lazyload" data-src="{{asset('frontend/images/shop/products/size_chart2.jpg')}}"
                                src="{{asset('frontend/images/shop/products/size_chart2.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal find_size -->
