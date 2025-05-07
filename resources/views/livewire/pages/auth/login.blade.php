<div>
    <style>
        /* (unchanged styles, same as yours) */
        .register-form .text-start span {
            background-color: rgba(233, 236, 239, 0);
            border-style: none;
            color: #ffffff;
        }

        .register-form form .text-start {
            color: #ffffff;
            font-weight: 600;
        }

        div .login-wrapper {
            transform: translatex(0px) translatey(0px);
        }

        .register-form .text-start i {
            color: #ffffff;
        }

        #phone {
            color: #ffffff;
            font-size: 16px;
            padding-left: 5px;
        }

        #password {
            font-size: 16px;
        }

        .login-wrapper .col-lg-8 {
            padding: 16px 16px 20px 17px;
        }

        .login-wrapper .row .col-lg-8 .register-form form .text-start .input-group span {
            font-weight: 400 !important;
        }
    </style>

    <div>
        <style>
            /* Same styles as before (unchanged) */
        </style>

        <div class="text-center login-wrapper d-flex align-items-center justify-content-center bg-light">
            <div class="background-shape"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-10 col-lg-8">
                        <img class="p-4 bg-white big-logo rounded-circle" src="assets/img/core-img/logo-white.png"
                            alt="">

                        <!-- Login/Register Form -->
                        <div class="mt-5 register-form">
                            <form wire:submit.prevent="{{ $otpSent ? 'verifyOtp' : ($showOtp ? 'sendOtp' : 'login') }}">

                                {{-- Phone Field --}}
                                <div class="mb-4 text-start">
                                    <label class="form-label">Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                        <span class="input-group-text">+91</span>
                                        <input wire:model.lazy="phone" type="text" id="phone"
                                            class="form-control" placeholder="Phone Number (without +91)"
                                            {{ $otpSent ? 'disabled' : '' }}>
                                    </div>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Password Login --}}
                                @if (!$showOtp)
                                    {{-- Password Field --}}
                                    <div class="mb-4 text-start">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                            <input wire:model.lazy="password" type="password" id="password"
                                                class="form-control" placeholder="Password">
                                            <span class="input-group-text" style="cursor: pointer;"
                                                onclick="togglePassword()">
                                                <i class="fa-solid fa-eye" id="toggleIcon"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endif

                                {{-- OTP Input --}}
                                @if ($showOtp && $otpSent)
                                    <div class="mb-4 text-start">
                                        <label class="form-label">Enter OTP</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                            <input wire:model.lazy="otp" type="text" class="form-control"
                                                placeholder="Enter OTP">
                                        </div>
                                        @error('otp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="mt-2 text-end">
                                            <a href="#" wire:click.prevent="sendOtp"
                                                class="text-light text-decoration-underline">Resend OTP</a>
                                        </div>
                                    </div>
                                @endif

                                {{-- Login or Send/Verify OTP Button --}}
                                <button type="submit" class="btn btn-warning btn-lg w-100"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove>
                                        {{ $showOtp ? ($otpSent ? 'Verify OTP' : 'Send OTP') : 'Log In' }}
                                    </span>
                                    <span wire:loading><i class="fa fa-spinner fa-spin me-2"></i> Processing...</span>
                                </button>
                            </form>

                            {{-- Toggle between OTP and Password login --}}
                            <div class="mt-2 text-end">
                                <a href="#" class="text-light text-decoration-underline"
                                    wire:click.prevent="toggleLoginMethod">
                                    {{ $showOtp ? 'Use Password to Login' : 'Login with OTP.' }}
                                </a>
                            </div>
                        </div>

                        <!-- Login Meta -->
                        <div class="mt-3 login-meta-data">
                            <a class="mb-1 forgot-password d-block" href="forget-password.html">Forgot Password?</a>
                            <p class="mb-0">Didn't have an account? <a class="mx-1" href="register.html">Register
                                    Now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Toggle Password JS --}}
        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.getElementById('toggleIcon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }
        </script>
    </div>

</div>
