
    <!-- modal login -->
    <div class="modal modalCentered fade form-sign-in modal-part-content" id="login">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Log in</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-login-form">
                    <form method="POST" action="{{ route('frontend.login') }}">
                        @csrf
                        <div class="tf-field style-1">
                            <input class="tf-field-input tf-input" type="email" name="email" placeholder=" " required>
                            <label class="tf-field-label">Email *</label>
                        </div>
                        <div class="tf-field style-1">
                            <input class="tf-field-input tf-input" type="password" name="password" placeholder=" " required>
                            <label class="tf-field-label">Password *</label>
                        </div>
                    
                        <div>
                            <a href="#forgotPassword" data-bs-toggle="modal" class="btn-link link">Forgot your password?</a>
                        </div>
                    
                        <div class="bottom">
                            <div class="w-100">
                                <button type="submit"
                                    class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                                    <span>Log in</span>
                                </button>
                            </div>
                            <div class="w-100">
                                <a href="#register" data-bs-toggle="modal" class="btn-link fw-6 w-100 link">
                                    New customer? Create your account
                                    <i class="icon icon-arrow1-top-left"></i>
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal modalCentered fade form-sign-in modal-part-content" id="forgotPassword">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Reset your password</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-login-form">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="tf-field style-1">
                            <input class="tf-field-input tf-input" type="email" name="email" placeholder=" " required>
                            <label class="tf-field-label">Email *</label>
                        </div>
                    
                        <div class="bottom">
                            <div class="w-100">
                                <button type="submit"
                                    class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                                    <span>Reset password</span>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal modalCentered fade form-sign-in modal-part-content" id="register">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Register</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-login-form">
                    <form method="POST" action="{{ route('frontend.register') }}">
                        @csrf
                        <div class="tf-field style-1">
                            <input class="tf-field-input tf-input" type="text" name="name" placeholder=" " required>
                            <label class="tf-field-label">Full Name *</label>
                        </div>
                    
                        <div class="tf-field style-1">
                            <input class="tf-field-input tf-input" type="email" name="email" placeholder=" " required>
                            <label class="tf-field-label">Email *</label>
                        </div>

                        <div class="tf-field style-1 mb_15">
                            <input class="tf-field-input tf-input" placeholder=" " type="text" id="phone_no" name="phone_no" required>
                            <label class="tf-field-label" for="phone_no">Phone number *</label>
                        </div>
                    
                        <div class="tf-field style-1">
                            <input class="tf-field-input tf-input" type="password" name="password" placeholder=" " required>
                            <label class="tf-field-label">Password *</label>
                        </div>
                    
                        <div class="tf-field style-1">
                            <input class="tf-field-input tf-input" type="password" name="password_confirmation" placeholder=" " required>
                            <label class="tf-field-label">Confirm Password *</label>
                        </div>
                    
                        <div class="bottom">
                            <div class="w-100">
                                <button type="submit"
                                    class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                                    <span>Register</span>
                                </button>
                            </div>
                            <div class="w-100">
                                <a href="#login" data-bs-toggle="modal" class="btn-link fw-6 w-100 link">
                                    Already have an account? Log in here
                                    <i class="icon icon-arrow1-top-left"></i>
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- /modal login -->
   