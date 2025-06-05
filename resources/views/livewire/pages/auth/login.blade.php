<div>
    <style>
        .register-form .text-start span {
            background-color: rgba(233, 236, 239, 0);
            border-style: none;
        }

        .register-form form .text-start {
            font-weight: 600;
        }

        div .login-wrapper {
            transform: translatex(0px) translatey(0px);
        }


        #phone {
            /* color: #ffffff; */
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
        /* Text end */
.register-form form .text-end{
 color:#020202;
}

/* Link */
.text-start .text-end a{
 color:#020202 !important;
 margin-right:3px;
 padding-right:5px;
}

/* Input */
.text-start .input-group #otp{
 display:block;
 flex-direction:row;
 font-size:16px;
 letter-spacing:8.7px;
 font-weight:500;
 text-transform:uppercase;
 word-spacing:1.2px;
}

/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Hepta+Slab:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Paragraph */
.login-wrapper p{
 color:#39a90d;
 font-size:16px;
 font-weight:600;
 font-family:'Hepta Slab', serif;
}


    </style>

    <div>

        <div class="text-center login-wrapper d-flex align-items-center justify-content-center bg-light">
            <div class="background-shape"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-10 col-lg-8">
                        <img class=" big-logo" src="assets/img/core-img/logo-white.png" alt="">
                        <h6 class=" text-dark">Sign Up to get started</h6>
                        <!-- Login/Register Form -->
                        <br>
                        <p>{{ session('message') }}</p>
                        <div class="mt-5 register-form">
                            <form wire:submit.prevent="{{ $otpSent ? 'verifyOtp' : ($showOtp ? 'sendOtp' : 'login') }}">
                                @if (!$otpSent)
                                    {{-- Phone Field --}}
                                    <div class="mb-4 text-start">
                                        <label class="form-label text-dark">Phone</label>
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
                                @endif
                                @if ($showOtp && $otpSent && !$showName)
                                    <div class="mb-4 text-start">
                                        <label class="form-label text-dark">Enter OTP</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                            <input type="text" class="form-control" id="otp"
                                                placeholder="______" maxlength="6"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                                wire:model.lazy="otp">
                                        </div>
                                        @error('otp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="mt-2 text-end">
                                            <a href="#" wire:click.prevent="sendOtp"
                                                class="text-dark">Resend OTP</a>
                                        </div>

                                    </div>
                                @endif

                               @if(!$showName)
                                <button type="submit" class="btn btn-theam btn-lg w-100" wire:loading.attr="disabled">
                                    <span wire:loading.remove>
                                        {{ $showOtp ? ($otpSent ? 'Verify OTP' : 'Send OTP') : 'Log In' }}
                                    </span>
                                    <span wire:loading><i class="fa fa-spinner fa-spin me-2"></i> Processing...</span>
                                </button>
                                @endif
                                @if ($showName)
                                    <div class="mb-4 text-start">
                                        <label class="form-label text-dark">Your Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                            <input wire:model.lazy="name" type="text" class="form-control"
                                                placeholder="Full Name">
                                        </div>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="button" class="btn btn-theam btn-lg w-100" wire:click="submitName"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove>Save & Login</span>
                                        <span wire:loading><i class="fa fa-spinner fa-spin me-2"></i> Saving...</span>
                                    </button>
                                @endif

                            </form>
                        </div>

                        <!-- Login Meta -->
                        <div class="mt-3 login-meta-data"> <br>
                            <a href="">Explore Products &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
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
