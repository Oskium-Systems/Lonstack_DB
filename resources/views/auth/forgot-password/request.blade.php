@extends('layouts.app')

@section('content')
    <div class="account-content">
        <div class="login-wrapper bg-img">
            <div class="login-content authent-content">

                <form method="POST" action="{{ route('forgot-password.submit') }}"
                    data-submit-spinner data-spinner-text="Sending OTP...">
                    @csrf

                    <div class="login-userset">

                        <div class="login-logo logo-normal">
                            <img src="assets/img/logo.svg" alt="img" />
                        </div>
                        <a href="" class="login-logo logo-white">
                            <img src="assets/img/logo-white.svg" alt="Img" />
                        </a>

                        <div class="login-userheading">
                            <h3>Forgot Password</h3>
                            <h4 class="fs-16">Enter your registered email or phone number and we'll send you a verification code.</h4>
                        </div>

                        {{-- Email or Phone --}}
                        <div class="mb-3">
                            <label class="form-label" for="email_or_phone">
                                Email or Phone
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    id="email_or_phone"
                                    name="email_or_phone"
                                    value="{{ old('email_or_phone') }}"
                                    placeholder="Enter your email or phone number"
                                    class="form-control border-end-0 @error('email_or_phone') is-invalid @enderror"
                                    required
                                    autofocus
                                    autocomplete="off"
                                />
                                <span class="input-group-text border-start-0">
                                    <i class="ti ti-mail"></i>
                                </span>
                            </div>
                            @error('email_or_phone')
                                <span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="form-login">
                            <button type="submit" class="btn btn-login w-100">
                                Send Verification Code
                            </button>
                        </div>

                        {{-- Back to login --}}
                        <div class="signinform">
                            <h4>
                                Remember your password?
                                <a href="{{ route('login') }}" class="hover-a">Sign In</a>
                            </h4>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
