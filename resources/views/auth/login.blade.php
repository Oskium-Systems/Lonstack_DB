@extends('layouts.app')

@section('content')
    <div class="account-content">

        <div class="login-wrapper bg-img">

            <div class="login-content authent-content">

                <form method="POST" action="{{ route('login') }}" data-submit-spinner data-spinner-text="Processing...">
                    @csrf

                    <div class="login-userset">

                        <a href="{{ route('home') }}">
                            <div class="login-logo logo-normal">
                                <img src="{{ asset('image/logo/logo-black.png') }}" alt="img" />
                            </div>
                        </a>


                        <a href="{{ route('home') }}" class="login-logo logo-white">
                            <img src="{{ asset('image/logo/logo-black.png') }}" alt="Img" />
                        </a>

                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4 class="fs-16">Sign in to access your dashboard and manage your activities.</h4>
                        </div>



                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label" for="email">
                                Email
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control border-end-0" placeholder="Enter your email" autofocus
                                    autocomplete="username" />
                                <span class="input-group-text border-start-0">
                                    <i class="ti ti-mail"></i>
                                </span>
                            </div>
                            @error('email')
                                <span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="password">
                                Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="pass-group">
                                <input type="password" id="password" name="password" class="pass-input form-control"
                                    placeholder="Enter your password" />
                                <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                            </div>
                            @error('password')
                                <span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Remember Me + Forgot Password --}}
                        <div class="form-login authentication-check">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center justify-content-between">
                                    <div class="custom-control custom-checkbox">
                                        <label class="checkboxs ps-4 mb-0 pb-0 line-height-1 fs-16 text-gray-6">
                                            <input type="checkbox" id="remember_me" name="remember" class="form-control"
                                                {{ old('remember') ? 'checked' : '' }} />
                                            <span class="checkmarks"></span>
                                            Remember me
                                        </label>
                                    </div>
                                    <div class="text-end">
                                        <a class="text-orange fs-16 fw-medium"
                                            href="{{ route('forgot-password.request') }}">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">
                                Sign In
                            </button>
                        </div>

                        {{-- Register Link --}}
                        <div class="signinform">
                            <h4>
                                New on our platform?
                                <a href="{{ route('register') }}" class="hover-a">Create an account</a>
                            </h4>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
