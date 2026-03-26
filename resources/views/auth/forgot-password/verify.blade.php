@extends('layouts.app')

@section('content')
    <div class="account-content">
        <div class="login-wrapper bg-img">
            <div class="login-content authent-content">

                {{-- OTP form --}}
                <form method="POST" action="{{ route('forgot-password.verify.submit', $token) }}" data-submit-spinner
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
                            <h3>Enter Verification Code</h3>
                            <h4 class="fs-16">
                                A 6-digit code was sent to <strong>{{ $maskedEmail }}</strong>
                            </h4>
                        </div>

                        {{-- Lockout banner --}}
                        @if ($isLockedOut)
                            <div class="alert alert-danger" role="alert">
                                <strong>Too many failed attempts.</strong>
                                Please wait <span id="lockoutTimer">--:--</span> before trying again.
                            </div>
                        @endif

                        {{-- OTP expired banner --}}
                        @if ($otpExpired && !$isLockedOut)
                            <div class="alert alert-warning" role="alert">
                                Your verification code has expired.
                                Please use the resend button below to get a new one.
                            </div>
                        @endif

                        {{-- 6 OTP inputs --}}
                        <div class="otp-input text-center">
                            <div class="d-flex align-items-center justify-content-center mb-3 gap-2">
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="text" name="otp[]" maxlength="1" inputmode="numeric" pattern="[0-9]"
                                        class="form-control otp-input-field text-center fs-26 fw-bold rounded py-3"
                                        style="width: 100%;" {{ $isLockedOut || $otpExpired || $i > 0 ? 'disabled' : '' }}
                                        autocomplete="off" required />
                                @endfor
                            </div>

                            {{-- Timer --}}
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
                                    <a href="#" id="resendBtn" class="text-primary">Resend OTP</a>
                                </p>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-login">
                            <button type="submit" id="submitButton" class="btn btn-login w-100"
                                {{ $isLockedOut || $otpExpired ? 'disabled' : '' }}>
                                Verify &amp; Proceed
                            </button>
                        </div>

                        {{-- Back to login --}}
                        <div class="signinform text-center mt-3">
                            <h4>
                                Return to
                                <a href="{{ route('login') }}" class="hover-a">Sign In</a>
                            </h4>
                        </div>

                    </div>
                </form>

                {{-- Resend form — sibling, NOT nested inside otpForm --}}
                <form action="{{ route('forgot-password.resend', $token) }}" method="POST" id="resendForm"
                    style="display:none;">
                    @csrf
                </form>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const otpInputs = document.querySelectorAll('.otp-input-field');
                const otpForm = document.getElementById('otpForm');
                const resendBtn = document.getElementById('resendBtn');
                const resendForm = document.getElementById('resendForm');
                const timerEl = document.getElementById('timer');
                const timerBadge = document.getElementById('timerBadge');
                const lockoutTimerEl = document.getElementById('lockoutTimer');

                const isLockedOut = {{ $isLockedOut ? 'true' : 'false' }};
                const otpExpired = {{ $otpExpired ? 'true' : 'false' }};
                const lockoutExpires = {{ $lockoutExpires ?? 0 }};
                const otpExpiresAt = {{ $otp_expires_at_unix }} * 1000;

                // ── Resend click
                resendBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    resendForm.submit();
                });

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

                // ── OTP input UX
                if (!isLockedOut && !otpExpired) {
                    otpInputs[0].disabled = false;
                    otpInputs[0].focus();

                    otpInputs.forEach(function(input, index) {

                        input.addEventListener('input', function() {
                            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1);

                            if (this.value && index < otpInputs.length - 1) {
                                otpInputs[index + 1].disabled = false;
                                otpInputs[index + 1].focus();
                            }

                            // Auto submit when all 6 filled
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
                let timeLeft = otpExpiresAt - Date.now();

                if (timeLeft <= 0 || isLockedOut || otpExpired) {
                    markExpired();
                    if (!isLockedOut) enableResend();
                } else {
                    disableResend();
                    timerEl.textContent = formatTime(timeLeft);

                    const timerInterval = setInterval(function() {
                        timeLeft -= 1000;
                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            markExpired();
                            if (!isLockedOut) enableResend();

                            // Disable inputs and submit on expiry
                            otpInputs.forEach(i => i.disabled = true);
                            document.getElementById('submitButton').disabled = true;
                        } else {
                            timerEl.textContent = formatTime(timeLeft);
                        }
                    }, 1000);
                }

                // ── Helpers 
                function formatTime(ms) {
                    const total = Math.floor(ms / 1000);
                    const m = Math.floor(total / 60);
                    const s = total % 60;
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
@endsection
