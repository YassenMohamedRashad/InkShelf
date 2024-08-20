<?php

use App\Http\Controllers\auth\GoogleAuthController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('register','pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');

    Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google_login');
    Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
});
