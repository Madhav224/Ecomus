<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Ecomus')</title>
 <!-- font -->
    <link rel="stylesheet" href="fonts/fonts.css">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('frontend/fonts/font-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/styles.css')}}" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('images/logo/' . setting('site_favicon_logo')) }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo/' . setting('site_favicon_logo')) }}">

    <style>.user-avatar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #76a7e0; /* pick a brand color */
    color: #fff;
    font-weight: bold;
    font-size: 16px;
    text-transform: uppercase;
}
.nav-account .dropdown-toggle::after {
    display: none !important;
}

body {
  -webkit-user-select: none; /* Safari */
  -moz-user-select: none;    /* Firefox */
  -ms-user-select: none;     /* IE10+/Edge */
  user-select: none;         /* Standard */
}
</style>
  @livewireStyles
</head>
<body>

    @include('frontend.partials.header')

    <main>
        @yield('content')
    </main>
    
    @include('frontend.partials.footer')

    @include('frontend.partials.quickview')

    @include('frontend.auth.modals')
 
</script>
    <!-- Javascript -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lazysize.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/count-down.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/multiple-modal.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{asset('frontend/js/shop.js')}}"></script>
    <script src="{{asset('frontend/js/nouislider.min.js')}}"></script>
    
  <script>
    document.addEventListener("livewire:update", () => {
    // re-init your filter scripts
    initShopFilters();
});

  </script>
  
    @livewireScripts
</body>
</html>
