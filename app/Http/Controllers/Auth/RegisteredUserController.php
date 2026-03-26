<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    use HandlesLoginResponse;

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'The name field cannot be empty.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.required' => 'The email field cannot be empty.',
            'email.email' => 'Please enter a valid email address.',
            'email.lowercase' => 'The email must be in lowercase.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'The password field cannot be empty.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        try {
            DB::beginTransaction();

            // Generate OTP and verification token
            $otp = sprintf('%06d', random_int(0, 999999));
            $verificationToken = Str::random(40);


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
                'email_verification_otp' => $otp,
                'email_verification_token' => $verificationToken,
                'email_verification_token_expires_at' => Carbon::now()->addMinutes(2),
            ]);

            DB::commit();

            $email_subject = 'Welcome to BigHit - Verify Your Email';
            $email_content = 'Use the OTP provided to confirm your email and join the BigHit community!';

            // Send verification email
            Mail::to($user->email)->send(new VerificationMail($user, $email_subject, $email_content, $otp));




            return redirect()->route('email.verify.otp', ['token' => $verificationToken])
                ->with('info', 'We have sent you an OTP for your email verification.');
        } catch (Exception $e) {
            DB::rollback();
            Log::error('User registration failed: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function showVerificationForm(Request $request, $token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            abort(404, 'Invalid verification token');
        }

        // Guard: already verified
        if ($user->email_verified_at) {
            return redirect()->route('login')->with('info', 'Your email is already verified. Please sign in.');
        }

        $maskedEmail = $this->maskEmail($user->email);

        $otpExpiresAtUnix = $user->email_verification_token_expires_at
            ? $user->email_verification_token_expires_at->timestamp
            : now()->timestamp;

        // Lockout check
        $rateLimiterKey = 'otp:' . $token;
        $isLockedOut = RateLimiter::tooManyAttempts($rateLimiterKey, 5);
        $lockoutExpires = $isLockedOut ? RateLimiter::availableIn($rateLimiterKey) + now()->timestamp : null;

        return view('auth.verify-email', [
            'token'              => $token,
            'maskedEmail'        => $maskedEmail,   // ← was 'email', view uses $maskedEmail
            'otp_expires_at_unix' => $otpExpiresAtUnix,
            'isLockedOut'        => $isLockedOut,
            'lockoutExpires'     => $lockoutExpires,
        ]);
    }


    public function verifyOtp(Request $request, $token): RedirectResponse
    {
        $request->validate([
            'otp'   => ['required', 'array', 'size:6'],
            'otp.*' => ['required', 'digits:1'],
        ], [
            'otp.required'   => 'Please enter the 6-digit verification code.',
            'otp.size'       => 'The verification code must be 6 digits.',
            'otp.*.digits'   => 'Each digit must be a single number.',
        ]);

        $rateLimiterKey = 'otp:' . $token;

        // Brute-force protection
        if (RateLimiter::tooManyAttempts($rateLimiterKey, 5)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            return redirect()->route('email.verify', ['token' => $token])
                ->with('error', "Too many failed attempts. Try again in {$seconds} seconds.");
        }

        try {
            $user = User::where('email_verification_token', $token)->first();

            if (!$user) {
                return redirect()->route('login')->with('error', 'Invalid verification link.');
            }

            // Guard: already verified
            if ($user->email_verified_at) {
                return redirect()->route('login')->with('info', 'Email already verified. Please sign in.');
            }

            // Check expiry FIRST
            if ($user->email_verification_token_expires_at < now()) {
                return redirect()->route('email.verify.otp', ['token' => $token])
                    ->with('error', 'OTP has expired. Please request a new one.');
            }

            $otp = implode('', $request->otp);

            // Secure comparison
            if (!hash_equals((string) $user->email_verification_otp, (string) $otp)) {
                RateLimiter::hit($rateLimiterKey, 600);

                $attemptsLeft = 5 - RateLimiter::attempts($rateLimiterKey);

                return redirect()->route('email.verify.otp', ['token' => $token])
                    ->with(
                        'error',
                        $attemptsLeft > 0  ? "Invalid OTP. You have {$attemptsLeft} attempt(s) left." : 'Too many failed attempts. Please wait before trying again.'
                    );
            }

            DB::beginTransaction();

            $user->email_verified_at              = now();
            $user->email_verification_otp         = null;
            $user->email_verification_token       = null;
            $user->email_verification_token_expires_at = null;
            $user->save();

            Auth::login($user);
            $request->session()->regenerate();
            RateLimiter::clear($rateLimiterKey); // clear on success

            DB::commit();

            return $this->sendLoginResponse($request);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('OTP verification failed: ' . $e->getMessage());
            return redirect()->route('email.verify', ['token' => $token])
                ->with('error', 'Verification failed. Please try again.');
        }
    }


    public function resendOtp($token): RedirectResponse
    {
        $resendKey = 'resend-otp:' . $token;

        // Max 3 resends per 5 minutes
        if (RateLimiter::tooManyAttempts($resendKey, 3)) {
            $seconds = RateLimiter::availableIn($resendKey);
            return redirect()->back()
                ->with('error', "Too many resend attempts. Please wait {$seconds} seconds.");
        }

        try {
            $user = User::where('email_verification_token', $token)->first();

            if (!$user) {
                return redirect()->route('login')->with('error', 'Invalid verification link.');
            }

            // Guard: already verified
            if ($user->email_verified_at) {
                return redirect()->route('login')->with('info', 'Email already verified. Please sign in.');
            }

            DB::beginTransaction();

            $otp = sprintf('%04d', random_int(0, 9999));

            $user->email_verification_otp = $otp;
            $user->email_verification_token_expires_at     = Carbon::now()->addMinutes(2);
            $user->save();

            $email_subject = 'Welcome to BigHit - Verify Your Email';
            $email_content = 'Use the OTP provided to confirm your email and join the BigHit community!';

            // Mail inside transaction — if it throws, we rollback
            Mail::to($user->email)->send(new VerificationMail($user, $email_subject, $email_content, $otp));

            DB::commit();

            RateLimiter::hit($resendKey, 300);

            // Reset the OTP brute-force counter on resend
            RateLimiter::clear('otp:' . $token);

            return redirect()->back()->with('success', 'A new verification code has been sent to your email.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Resend OTP failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to resend OTP. Please try again.');
        }
    }



    /**
     * Mask the email address for display
     */
    private function maskEmail(string $email): string
    {
        // Safety guard
        if (!str_contains($email, '@')) {
            return '****';
        }

        [$username, $domain] = explode('@', $email, 2);


        $visibleCount    = min(2, max(1, strlen($username) - 1));
        $maskedUsername  = substr($username, 0, $visibleCount)
            . str_repeat('*', max(1, strlen($username) - $visibleCount));


        $dotPos          = strpos($domain, '.');
        $domainLabel     = substr($domain, 0, $dotPos);
        $tld             = substr($domain, $dotPos);

        $visibleDomain   = min(2, max(1, strlen($domainLabel) - 1));
        $maskedDomain    = substr($domainLabel, 0, $visibleDomain)
            . str_repeat('*', max(1, strlen($domainLabel) - $visibleDomain))
            . $tld;

        return $maskedUsername . '@' . $maskedDomain;
    }
}
