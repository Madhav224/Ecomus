  <!-- Footer -->
        <footer id="footer" class="footer background-gray md-pb-70">
            <div class="footer-wrap">
                <div class="footer-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="footer-infor">
                                    <div class="footer-logo">
                                        <a href="index.html">
                                            <img   src="{{ asset('images/logo/' . setting('site_logo')) }}" 
                                    alt="{{ setting('site_name') }}" >
                                        </a>
                                    </div>
                                    <ul>
                                       <li>
                                            <p>
                                                Address: {{ setting('site_postal_address') }}
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Email: <a href="mailto:{{ setting('site_email') }}">{{ setting('site_email') }}</a>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Phone: <a href="tel:{{ setting('site_contact') }}">{{ setting('site_contact') }}</a>
                                            </p>
                                        </li>

                                    </ul>
                                    <a href="{{route('ourstore')}}" class="tf-btn btn-line">Get direction<i
                                            class="icon icon-arrow1-top-left"></i></a>
                                    <ul class="tf-social-icon d-flex gap-10">
                                        <li><a href="https://www.facebook.com" class="box-icon w_34 round social-facebook social-line"><i
                                                    class="icon fs-14 icon-fb"></i></a></li>
                                        <li><a href="https://twitter.com" class="box-icon w_34 round social-twiter social-line"><i
                                                    class="icon fs-12 icon-Icon-x"></i></a></li>
                                        <li><a href="https://www.instagram.com" class="box-icon w_34 round social-instagram social-line"><i
                                                    class="icon fs-14 icon-instagram"></i></a></li>
                                        <li><a href="https://www.tiktok.com" class="box-icon w_34 round social-tiktok social-line"><i
                                                    class="icon fs-14 icon-tiktok"></i></a></li>
                                        <li><a href="https://www.pinterest.com" class="box-icon w_34 round social-pinterest social-line"><i
                                                    class="icon fs-14 icon-pinterest-1"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12 footer-col-block">
                                <div class="footer-heading footer-heading-desktop">
                                    <h6>Help</h6>
                                </div>
                                <div class="footer-heading footer-heading-moblie">
                                    <h6>Help</h6>
                                </div>
                                <ul class="footer-menu-list tf-collapse-content">
                                    <li>
                                        <a href="{{route('about-us')}}" class="footer-menu_item">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="{{route('faq')}}" class="footer-menu_item"> Returns + Exchanges
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('faq')}}" class="footer-menu_item">Shipping</a>
                                    </li>
                                    <li>
                                        <a href="{{route('faq')}}" class="footer-menu_item">Terms &amp;
                                            Conditions</a>
                                    </li>
                                    <li>
                                        <a href="{{route('faq')}}" class="footer-menu_item">FAQ’s</a>
                                    </li>
                                    <li>
                                        <a href="{{route('shop')}}" class="footer-menu_item">Compare</a>
                                    </li>
                                    <li>
                                        <a href="#" class="footer-menu_item">My Wishlist</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12 footer-col-block">
                                <div class="footer-heading footer-heading-desktop">
                                    <h6>About us</h6>
                                </div>
                                <div class="footer-heading footer-heading-moblie">
                                    <h6>About us</h6>
                                </div>
                                <ul class="footer-menu-list tf-collapse-content">
                                    <li>
                                        <a href="{{route('about-us')}}" class="footer-menu_item">Our Story</a>
                                    </li>
                                    <li>
                                        <a href="{{route('ourstore')}}" class="footer-menu_item">Visit Our Store</a>
                                    </li>
                                    <li>
                                        <a href="{{route('contact')}}" class="footer-menu_item">Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="#login" class="footer-menu_item">Account</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="footer-newsletter footer-col-block">
                                    <div class="footer-heading footer-heading-desktop">
                                        <h6>Sign Up for Email</h6>
                                    </div>
                                    <div class="footer-heading footer-heading-moblie">
                                        <h6>Sign Up for Email</h6>
                                    </div>
                                    <div class="tf-collapse-content">
                                        <div class="footer-menu_item">Sign up to get first dibs on new arrivals, sales,
                                            exclusive content, events and more!</div>
                                        <form class="form-newsletter" id="subscribe-form" action="#" method="post"
                                            accept-charset="utf-8" data-mailchimp="true">
                                            <div id="subscribe-content">
                                                <fieldset class="email">
                                                    <input type="email" name="email-form" id="subscribe-email"
                                                        placeholder="Enter your email...." tabindex="0"
                                                        aria-required="true">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button id="subscribe-button"
                                                        class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn"
                                                        type="button">Subscribe<i
                                                            class="icon icon-arrow1-top-left"></i></button>
                                                </div>
                                            </div>
                                            <div id="subscribe-msg"></div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div
                                    class="footer-bottom-wrap d-flex gap-20 flex-wrap justify-content-between align-items-center">
                                    <div class="footer-menu_item">© 2025 Ecomus Store. All Rights Reserved| Developed by Madhav Gediya </div>
                                    <div class="tf-payment">
                                        <img src="{{asset('frontend/images/payments/visa.png')}}" alt="">
                                        <img src="{{asset('frontend/images/payments/img-1.png')}}" alt="">
                                        <img src="{{asset('frontend/images/payments/img-2.png')}}" alt="">
                                        <img src="{{asset('frontend/images/payments/img-3.png')}}" alt="">
                                        <img src="{{asset('frontend/images/payments/img-4.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /Footer -->

