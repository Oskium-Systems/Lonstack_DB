@extends('layouts.app')

@section('content')
    <div class="account-content">
        <div class="login-wrapper bg-img">
            <div class="login-content authent-content">

                <form method="POST" action="{{ route('forgot-password.reset.submit', $token) }}"
                    data-submit-spinner data-spinner-text="Resetting...">
                    @csrf

                    <div class="login-userset">

                        <div class="login-logo logo-normal">
                            <img src="assets/img/logo.svg" alt="img" />
                        </div>
                        <a href="" class="login-logo logo-white">
                            <img src="assets/img/logo-white.svg" alt="Img" />
                        </a>

                        <div class="login-userheading">
                            <h3>Reset Password</h3>
                            <h4 class="fs-16">Create a strong new password for your account.</h4>
                        </div>

                        {{-- New Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="password">
                                New Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="pass-group">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Enter your new password"
                                    class="pass-input form-control @error('password') is-invalid @enderror"
                                    required
                                    autocomplete="new-password"
                                />
                                <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                            </div>
                            @error('password')
                                <span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">
                                Confirm New Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="pass-group">
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Re-enter your new password"
                                    class="pass-inputs form-control @error('password_confirmation') is-invalid @enderror"
                                    required
                                    autocomplete="new-password"
                                />
                                <span class="ti toggle-passwords ti-eye-off text-gray-9"></span>
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="form-login">
                            <button type="submit" class="btn btn-login w-100">
                                Reset Password
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
