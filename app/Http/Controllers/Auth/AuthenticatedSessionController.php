<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\VerificationMail;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    use HandlesLoginResponse;
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {

        // Validate credentials and attempt login
        $request->authenticate();

        $user = User::find(Auth::id());

        // dd($user);

        // check if user needs verification
        if (!$user->email_verified_at) {
            Auth::logout();

            // dd('Email not verified');

            try {
                DB::beginTransaction();

                $otp = sprintf('%06d', random_int(0, 999999));
                $verificationToken = Str::random(40);

                $user->email_verification_otp = $otp;
                $user->email_verification_token = $verificationToken;
                $user->email_verification_token_expires_at = now()->addMinutes(2);
                $user->save();

                $email_subject = 'Welcome to FinWise - Verify Your Email';
                $email_content = 'Use the OTP provided to confirm your email and join the community!';

                // DB::commit();

                // Send verification email
                Mail::to($user->email)->send(new VerificationMail($user, $email_subject, $email_content, $otp));

                DB::commit();


                return redirect()->route('email.verify.otp', ['token' => $verificationToken])->with('info', 'Please verify your email. A verification code has been sent.');
            } catch (Exception $e) {
                DB::rollBack();

                // dd($e->getMessage());
                return redirect()->route('login')->with('error', 'Verification process failed.' . $e->getMessage());
            }
        }

        $request->session()->regenerate();

        return $this->sendLoginResponse($request);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
