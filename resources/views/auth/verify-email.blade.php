@extends('layouts.app')

@section('content')
    <div class="account-content">

        <div class="login-wrapper bg-img">

            <div class="login-content authent-content">

                <form method="POST" action="{{ route('email.verify.submit', $token) }}" data-submit-spinner
                    data-spinner-text="Verifying..." id="otpForm">
                    @csrf

                    <div class="login-userset">

                        <div class="login-logo logo-normal">
                            <img src="assets/img/logo.svg" alt="img" />
                        </div>

                        <a href="" class="login-logo logo-white">
                            <img src="assets/img/logo-white.svg" alt="Img" />
                        </a>

                        <div class="login-userheading">
                            <h3>Email Verification</h3>
                            <h4 class="fs-16">Enter the 6-digit code sent to <strong>{{ $maskedEmail }}</strong></h4>
                        </div>

                        {{-- Lockout banner --}}
                        @if ($isLockedOut)
                            <div class="alert alert-danger" role="alert">
                                <strong>Too many attempts.</strong> Please wait
                                <span id="lockoutTimer">--:--</span> before trying again.
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif


                        <div class="otp-input text-center">
                            <div class="d-flex align-items-center justify-content-center mb-3 gap-2">
                                {{-- 4 inputs to match your controller's size:4 validation --}}
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="text" name="otp[]" maxlength="1" inputmode="numeric" pattern="[0-9]"
                                        class="form-control otp-input-field text-center fs-26 fw-bold rounded py-3"
                                        style="width: 100%;" {{ $isLockedOut || $i > 0 ? 'disabled' : '' }}
                                        autocomplete="off" required />
                                @endfor
                            </div>

                            {{-- OTP expiry timer --}}
                            <div class="mb-3">
                                <span class="badge bg-danger" id="timerBadge">
                                    <i class="ti ti-clock me-1"></i>
                                    <span id="timer">--:--</span>
                                </span>
                            </div>

                            {{-- Resend --}}
                            <div class="mb-3">
                                <p class="text-muted text-center fs-16">
                                    Didn't receive the code?
                                    <a href="#" id="resendBtn" class="text-primary"
                                        onclick="event.preventDefault(); document.getElementById('resendForm').submit();">
                                        Resend OTP
                                    </a>
                                </p>
                            </div>
                        </div>


                        {{-- Submit --}}
                        <div class="form-login">
                            <button type="submit" id="submitButton" class="btn btn-login w-100"
                                {{ $isLockedOut ? 'disabled' : '' }}>
                                Verify &amp; Proceed
                            </button>
                        </div>



                        <div class="signinform text-center mt-3">
                            <h4>Return to <a href="{{ route('login') }}" class="hover-a">Sign In</a></h4>
                        </div>


                    </div>

                </form>

                {{-- Hidden resend form --}}
                <form action="{{ route('email.resend.otp', $token) }}" method="POST" id="resendForm" style="display:none;">
                    @csrf
                </form>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const otpInputs = document.querySelectorAll('.otp-input-field');
            const otpForm = document.getElementById('otpForm');
            const resendBtn = document.getElementById('resendBtn');
            const timerEl = document.getElementById('timer');
            const timerBadge = document.getElementById('timerBadge');
            const lockoutTimerEl = document.getElementById('lockoutTimer');

            const isLockedOut = {{ $isLockedOut ? 'true' : 'false' }};
            const lockoutExpires = {{ $lockoutExpires ?? 0 }};
            const otpExpiresAt = {{ $otp_expires_at_unix }} * 1000;

            // ── Lockout countdown
            if (isLockedOut && lockoutExpires > 0) {
                disableResend();

                const lockoutInterval = setInterval(function() {
                    const remaining = (lockoutExpires * 1000) - Date.now();
                    if (remaining <= 0) {
                        clearInterval(lockoutInterval);
                        location.reload();
                        return;
                    }
                    if (lockoutTimerEl) {
                        lockoutTimerEl.textContent = formatTime(remaining);
                    }
                }, 1000);
            }

            // ── OTP input UX (only when not locked out)
            if (!isLockedOut) {
                otpInputs[0].disabled = false;
                otpInputs[0].focus();

                otpInputs.forEach(function(input, index) {

                    input.addEventListener('input', function() {
                        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1);

                        if (this.value && index < otpInputs.length - 1) {
                            otpInputs[index + 1].disabled = false;
                            otpInputs[index + 1].focus();
                        }

                        // Auto-submit when all 4 filled
                        if (index === otpInputs.length - 1 && this.value) {
                            const allFilled = Array.from(otpInputs).every(i => i.value.length ===
                                1);
                            if (allFilled) otpForm.submit();
                        }
                    });

                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Backspace') {
                            if (this.value === '' && index > 0) {
                                otpInputs[index - 1].focus();
                            } else {
                                this.value = '';
                            }
                        }
                    });

                    input.addEventListener('paste', function(e) {
                        e.preventDefault();
                        const digits = e.clipboardData.getData('text').replace(/[^0-9]/g, '');
                        digits.split('').forEach(function(d, i) {
                            if (otpInputs[index + i]) {
                                otpInputs[index + i].disabled = false;
                                otpInputs[index + i].value = d;
                            }
                        });
                        const next = Math.min(index + digits.length, otpInputs.length - 1);
                        otpInputs[next].focus();
                    });
                });
            }

            // ── OTP expiry countdown
            const now = Date.now();
            let timeLeft = otpExpiresAt - now;

            if (timeLeft <= 0 || isLockedOut) {
                // Already expired or locked
                markExpired();
            } else {
                disableResend(); // disable resend while timer is running

                const timerInterval = setInterval(function() {
                    timeLeft -= 1000;
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        markExpired();
                        if (!isLockedOut) enableResend();
                    } else {
                        timerEl.textContent = formatTime(timeLeft);
                    }
                }, 1000);

                timerEl.textContent = formatTime(timeLeft); // initial render
            }

            // ── Helpers 
            function formatTime(ms) {
                const totalSeconds = Math.floor(ms / 1000);
                const m = Math.floor(totalSeconds / 60);
                const s = totalSeconds % 60;
                return String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
            }

            function markExpired() {
                timerEl.textContent = 'Expired';
                timerBadge.classList.replace('bg-danger', 'bg-warning');
            }

            function disableResend() {
                resendBtn.style.pointerEvents = 'none';
                resendBtn.style.opacity = '0.5';
                resendBtn.style.cursor = 'not-allowed';
            }

            function enableResend() {
                resendBtn.style.pointerEvents = 'auto';
                resendBtn.style.opacity = '1';
                resendBtn.style.cursor = 'pointer';
            }
        });
    </script>
@endpush
