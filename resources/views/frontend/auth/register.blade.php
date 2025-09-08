@extends('frontend.layouts.app')

@section('title', 'Register')

@section('content')

<!-- page-title -->
        <div class="tf-page-title style-2">
            <div class="container-full">
                <div class="heading text-center">Register</div>
            </div>
        </div>
        <!-- /page-title -->


        
        <section class="flat-spacing-10">
            <div class="container">
                <div class="form-register-wrap">
                    <div class="flat-title align-items-start gap-0  px-0">
                        <h5 class="">Register</h5>
                        {{-- <p class="text_black-2">Sign up for early Sale access plus tailored new arrivals, trends and
                            promotions. To opt out, click unsubscribe in our emails</p> --}}
                    </div>
                    <div>
                     <form id="register-form" action="{{ route('frontend.register') }}" method="POST">
                        @csrf
                        <div class="tf-field style-1 mb_15">
                            <input class="tf-field-input tf-input" type="text" name="name" placeholder=" " required>
                            <label class="tf-field-label">Full Name *</label>
                        </div>
                    
                        <div class="tf-field style-1 mb_15">
                            <input class="tf-field-input tf-input" type="email" name="email" placeholder=" " required>
                            <label class="tf-field-label">Email *</label>
                        </div>

                        <div class="tf-field style-1 mb_15">
                            <input class="tf-field-input tf-input" placeholder=" " type="text" id="phone_no" name="phone_no" required>
                            <label class="tf-field-label" for="phone_no">Phone number *</label>
                        </div>
                    
                        <div class="tf-field style-1 mb_15">
                            <input class="tf-field-input tf-input" type="password" name="password" placeholder=" " required>
                            <label class="tf-field-label">Password *</label>
                        </div>
                    
                        <div class="tf-field style-1 mb_15">
                            <input class="tf-field-input tf-input" type="password" name="password_confirmation" placeholder=" " required>
                            <label class="tf-field-label">Confirm Password *</label>
                        </div>
                    
                        <div class="bottom mb_20">
                            <div class="w-100 mb_10">
                                <button type="submit"
                                    class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                                    <span>Register</span>
                                </button>
                            </div>
                            <div class="w-100 text-center mt_15">
                                <a href="{{route('frontend.login')}}"  class="tf-btn btn-line">
                                    Already have an account? Log in here
                                    <i class="icon icon-arrow1-top-left"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </section>

      


@endsection