@extends('layouts.app')
@section('content')
    <div class="account-content">
        <div class="login-wrapper register-wrap bg-img">
            <div class="login-content authent-content">

                <form method="POST" action="{{ route('register') }}" data-submit-spinner
                    data-spinner-text="Creating account...">
                    @csrf

                    <div class="login-userset">

                        <a href="">
                            <div class="login-logo logo-normal">
                                <img src="assets/img/logo.svg" alt="Logo" />
                            </div>
                        </a>

                        <div class="login-userheading">
                            <h3>Register</h3>
                            <h4>Create New Dreamspos Account</h4>
                        </div>


                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label" for="name">
                                Name
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Enter your full name" class="form-control border-end-0 " required autofocus
                                    autocomplete="name" />
                                <span class="input-group-text border-start-0">
                                    <i class="ti ti-user"></i>
                                </span>
                            </div>
                            @error('name')
                                <span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label" for="email">
                                Email
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Enter your email address" class="form-control border-end-0 " required
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
                                <input type="password" id="password" name="password" placeholder="Create a strong password"
                                    class="pass-input form-control" required autocomplete="new-password" />
                                <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                            </div>
                            @error('password')
                                <span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">
                                Confirm Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="pass-group">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Re-enter your password" class="pass-inputs form-control" required
                                    autocomplete="new-password" />
                                <span class="ti toggle-passwords ti-eye-off text-gray-9"></span>
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Terms & Privacy --}}
                        <div class="form-login authentication-check mb-3">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="custom-control custom-checkbox">
                                        <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                            <input type="checkbox" name="terms" id="terms"
                                                {{ old('terms') ? 'checked' : '' }} required />
                                            <span class="checkmarks"></span>
                                            I agree to the
                                            <a href="#" class="text-primary">Terms &amp; Privacy</a>
                                        </label>
                                    </div>
                                    @error('terms')
                                        <span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-login">
                            <button type="submit" class="btn btn-login w-100">Sign Up</button>
                        </div>

                        {{-- Login Link --}}
                        <div class="signinform">
                            <h4>
                                Already have an account?
                                <a href="{{ route('login') }}" class="hover-a">Sign In Instead</a>
                            </h4>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
