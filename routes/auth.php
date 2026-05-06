<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('redirect.if.authenticated')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/verify-email/{token}', [RegisteredUserController::class, 'showVerificationForm'])->name('email.verify.otp');

    Route::post('/verify-otp/{token}', [RegisteredUserController::class, 'verifyOtp'])->name('email.verify.submit');

    Route::post('/resend-otp/{token}', [RegisteredUserController::class, 'resendOtp'])->name('email.resend.otp');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);


    Route::controller(ForgotPasswordController::class)->group(function () {

        // Step 1 — Enter email/phone
        Route::get('/forgot-password', 'showEmailForm')->name('forgot-password.request');
        Route::post('/forgot-password', 'submitEmail')->name('forgot-password.submit');

        // Step 2 — Enter OTP
        Route::get('/forgot-password/{token}', 'showConfirmCodeForm')->name('forgot-password.verify');
        Route::post('/forgot-password/{token}', 'verifyPasswordOtp')->name('forgot-password.verify.submit');
        Route::post('/forgot-password/{token}/resend', 'resendOtp')->name('forgot-password.resend');

        // Step 3 — Set new password
        Route::get('/reset-password/{token}', 'showResetPasswordForm')->name('forgot-password.reset');
        Route::post('/reset-password/{token}', 'submitResetPassword')->name('forgot-password.reset.submit');
    });
});



Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
