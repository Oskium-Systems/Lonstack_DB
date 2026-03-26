<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetOtpMail;
use App\Models\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ForgotPasswordController extends Controller
{

    use HandlesLoginResponse;

    // Show email/phone input form
    public function showEmailForm()
    {
        if (Auth::check()) {
            return redirect()->intended(route('login'));
        }

        return view('auth.forgot-password.request');
    }



    // Submit email/phone and send OTP
    public function submitEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email_or_phone' => ['required', 'string', 'max:255'],
        ]);

        // Rate limit — max 3 attempts per 10 minutes per IP
        $rateLimiterKey = 'forgot-password:' . $request->ip();

        if (RateLimiter::tooManyAttempts($rateLimiterKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            return back()->with('error', "Too many attempts. Please wait {$seconds} seconds before trying again.");
        }

        RateLimiter::hit($rateLimiterKey, 600);

        $input = trim($request->email_or_phone);

        $user = User::where('email', $input)
            ->orWhere('phone', $input)
            ->first();


        if (!$user) {
            return back()->with('info', 'If an account exists with those details, an OTP has been sent.');
        }

        // Guard — inactive accounts should not reset password
        if (!$user->active) {
            return back()->with('error', 'This account has been deactivated. Please contact support.');
        }

        try {
            DB::beginTransaction();

            $otp   = sprintf('%06d', random_int(0, 999999));
            $token = Str::random(64);

            // Delete any existing pending reset for this user
            ResetPassword::where('user_id', $user->id)->delete();

            ResetPassword::create([
                'user_id'      => $user->id,
                'code'         => $otp,
                'token'        => $token,
                'status'       => 'pending',
                'expires_at'   => Carbon::now()->addMinutes(10),
                'attempts'     => 0,
                'lockout_until' => null,
            ]);


            Mail::to($user->email)->send(new PasswordResetOtpMail($user, $otp));

            DB::commit();

            // Clear rate limiter on success so legitimate users aren't penalised
            RateLimiter::clear($rateLimiterKey);

            return redirect()->route('forgot-password.verify', ['token' => $token])
                ->with('info', 'If an account exists with those details, an OTP has been sent.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Forgot password OTP send failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    // Show OTP confirmation form
    public function showConfirmCodeForm(Request $request, string $token): mixed
    {
        $resetPassword = ResetPassword::where('token', $token)
            ->where('status', 'pending')
            ->first();

        if (!$resetPassword) {
            return redirect()->route('forgot-password.request')
                ->with('error', 'Invalid or expired reset link. Please try again.');
        }

        $user = User::find($resetPassword->user_id);

        // Guard — user deleted after reset was requested
        if (!$user) {
            $resetPassword->delete();
            return redirect()->route('forgot-password.request')
                ->with('error', 'Account not found. Please try again.');
        }

        // Lockout check
        $isLockedOut    = false;
        $lockoutExpires = 0;

        if ($resetPassword->lockout_until) {
            if (Carbon::now()->lt($resetPassword->lockout_until)) {
                // Still locked out
                $isLockedOut    = true;
                $lockoutExpires = $resetPassword->lockout_until->timestamp;
            } else {
                // Lockout has expired — reset attempts
                $resetPassword->attempts      = 0;
                $resetPassword->lockout_until = null;
                $resetPassword->save();
            }
        }

        // The user can still resend from the verify page
        $otpExpired = Carbon::now()->gt($resetPassword->expires_at);

        return view('auth.forgot-password.verify', [
            'token'              => $token,
            'maskedEmail'        => $this->maskEmail($user->email),
            'otp_expires_at_unix' => $resetPassword->expires_at->timestamp,
            'isLockedOut'        => $isLockedOut,
            'lockoutExpires'     => $lockoutExpires,
            'otpExpired'         => $otpExpired,
        ]);
    }




    // Verify password OTP
    public function verifyPasswordOtp(Request $request, string $token): RedirectResponse
    {
        $request->validate([
            'otp'   => ['required', 'array', 'size:6'],
            'otp.*' => ['required', 'digits:1'],
        ], [
            'otp.required' => 'Please enter the 6-digit verification code.',
            'otp.size'     => 'The verification code must be 6 digits.',
            'otp.*.digits' => 'Each digit must be a single number.',
        ]);

        $resetPassword = ResetPassword::where('token', $token)
            ->where('status', 'pending')
            ->first();

        if (!$resetPassword) {
            return redirect()->route('forgot-password.request')
                ->with('error', 'Invalid or expired reset link. Please start again.');
        }

        // Lockout check
        if ($resetPassword->lockout_until) {
            if (Carbon::now()->lt($resetPassword->lockout_until)) {
                return redirect()->route('forgot-password.verify', ['token' => $token])
                    ->with('error', 'Too many failed attempts. Please wait before trying again.');
            }

            // Lockout expired — reset attempts
            $resetPassword->attempts      = 0;
            $resetPassword->lockout_until = null;
            $resetPassword->save();
        }

        // Expiry check BEFORE OTP comparison
        if (Carbon::now()->gt($resetPassword->expires_at)) {
            return redirect()->route('forgot-password.verify', ['token' => $token])
                ->with('error', 'OTP has expired. Please request a new one.');
        }

        $otp = implode('', $request->otp);

        // OTP comparison
        if (!hash_equals((string) $resetPassword->code, (string) $otp)) {

            try {
                DB::beginTransaction();

                $resetPassword->attempts += 1;

                if ($resetPassword->attempts >= 5) {
                    $resetPassword->lockout_until = Carbon::now()->addMinutes(15);
                }

                $resetPassword->save();

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('OTP attempt update failed: ' . $e->getMessage());
            }

            $attemptsLeft = max(0, 5 - $resetPassword->attempts);

            return redirect()->route('forgot-password.verify', ['token' => $token])
                ->with(
                    'error',
                    $attemptsLeft > 0
                        ? "Invalid OTP. You have {$attemptsLeft} attempt(s) left."
                        : 'Too many failed attempts. Please wait 15 minutes before trying again.'
                );
        }

        // OTP correct, mark as verified
        try {
            DB::beginTransaction();

            $resetPassword->status = 'verified';
            $resetPassword->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('OTP verification status update failed: ' . $e->getMessage());
            return redirect()->route('forgot-password.verify', ['token' => $token])
                ->with('error', 'Something went wrong. Please try again.');
        }

        return redirect()->route('forgot-password.reset', ['token' => $token])
            ->with('success', 'OTP verified. Please set your new password.');
    }




    // Resend OTP
    public function resendOtp(string $token): RedirectResponse
    {
        // Rate limiting — max 3 resends per 10 minutes per token
        $rateLimiterKey = 'forgot-password-resend:' . $token;

        if (RateLimiter::tooManyAttempts($rateLimiterKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            return redirect()->route('forgot-password.verify', ['token' => $token])
                ->with('error', "Too many resend attempts. Please wait {$seconds} seconds.");
        }

        $resetPassword = ResetPassword::where('token', $token)
            ->where('status', 'pending')
            ->first();

        if (!$resetPassword) {
            return redirect()->route('forgot-password.request')
                ->with('error', 'Invalid or expired reset link. Please start again.');
        }

        // Guard - respect active lockout, don't let resend bypass it
        if ($resetPassword->lockout_until && Carbon::now()->lt($resetPassword->lockout_until)) {
            return redirect()->route('forgot-password.verify', ['token' => $token])
                ->with('error', 'Your account is temporarily locked. Please wait before requesting a new code.');
        }

        $user = User::find($resetPassword->user_id);

        if (!$user) {
            $resetPassword->delete();
            return redirect()->route('forgot-password.request')
                ->with('error', 'Account not found. Please try again.');
        }

        try {
            DB::beginTransaction();

            $otp = sprintf('%06d', random_int(0, 999999));

            $resetPassword->code          = $otp;
            $resetPassword->expires_at    = Carbon::now()->addMinutes(10);
            $resetPassword->attempts      = 0;
            $resetPassword->lockout_until = null;
            $resetPassword->save();


            Mail::to($user->email)->send(new PasswordResetOtpMail($user, $otp));

            DB::commit();

            // Track resend attempts AFTER success
            RateLimiter::hit($rateLimiterKey, 600);

            return redirect()->route('forgot-password.verify', ['token' => $token])
                ->with('success', 'A new OTP has been sent to your email address.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Forgot password OTP resend failed: ' . $e->getMessage());
            return redirect()->route('forgot-password.verify', ['token' => $token])
                ->with('error', 'Failed to resend OTP. Please try again.');
        }
    }



    // Show reset password form
    public function showResetPasswordForm(string $token): mixed
    {
        $resetPassword = ResetPassword::where('token', $token)
            ->where('status', 'verified')
            ->first();

        if (!$resetPassword) {
            return redirect()->route('forgot-password.request')
                ->with('error', 'Invalid or expired reset link. Please start again.');
        }

        $user = User::find($resetPassword->user_id);

        if (!$user) {
            $resetPassword->delete();
            return redirect()->route('forgot-password.request')
                ->with('error', 'Account not found. Please try again.');
        }

        // Give the user 30 minutes from OTP verification to set their password
        if (Carbon::now()->gt($resetPassword->updated_at->addMinutes(30))) {
            $resetPassword->delete();
            return redirect()->route('forgot-password.request')
                ->with('error', 'Your reset session has expired. Please start again.');
        }

        return view('auth.forgot-password.reset', [
            'token' => $token,
        ]);
    }

    // Submit new password
    public function submitResetPassword(Request $request, string $token): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'password.required'  => 'The password field cannot be empty.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        $resetPassword = ResetPassword::where('token', $token)
            ->where('status', 'verified')
            ->first();

        if (!$resetPassword) {
            return redirect()->route('forgot-password.request')
                ->with('error', 'Invalid or expired reset link. Please start again.');
        }

        $user = User::find($resetPassword->user_id);

        if (!$user) {
            $resetPassword->delete();
            return redirect()->route('forgot-password.request')
                ->with('error', 'Account not found. Please try again.');
        }


        if (Carbon::now()->gt($resetPassword->updated_at->addMinutes(30))) {
            $resetPassword->delete();
            return redirect()->route('forgot-password.request')
                ->with('error', 'Your reset session has expired. Please start again.');
        }

        // Guard - prevent reusing the same password
        if (Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Your new password cannot be the same as your current password.');
        }

        try {
            DB::beginTransaction();

            // Update password
            $user->password = Hash::make($request->password);
            $user->save();

            // Mark token as completed
            $resetPassword->status = 'completed';
            $resetPassword->save();

            DB::commit();

            //
            // Keep DB tidy — delete completed/old records except current
            ResetPassword::where('user_id', $user->id)
                ->where('status', 'completed')
                ->where('id', '!=', $resetPassword->id)
                ->delete();

            // Log user in automatically after reset
            Auth::login($user);
            $request->session()->regenerate();

            return $this->sendLoginResponse($request);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Password reset submission failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Helper function to mask email
    private function maskEmail(string $email): string
    {
        if (!str_contains($email, '@')) {
            return '****';
        }

        [$username, $domain] = explode('@', $email, 2);

        $visibleCount   = min(2, max(1, strlen($username) - 1));
        $maskedUsername = substr($username, 0, $visibleCount)
            . str_repeat('*', max(1, strlen($username) - $visibleCount));

        $dotPos       = strpos($domain, '.');
        $domainLabel  = substr($domain, 0, $dotPos);
        $tld          = substr($domain, $dotPos);

        $visibleDomain = min(2, max(1, strlen($domainLabel) - 1));
        $maskedDomain  = substr($domainLabel, 0, $visibleDomain)
            . str_repeat('*', max(1, strlen($domainLabel) - $visibleDomain))
            . $tld;

        return $maskedUsername . '@' . $maskedDomain;
    }
}
