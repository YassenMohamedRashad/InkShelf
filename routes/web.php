<?php

use App\Livewire\Cart;
use App\Livewire\Home;
use App\Livewire\SingleBook;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('/', Home::class)->name('home');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/book/{id}', SingleBook::class)->name('single-book');
    Route::get('/cart', Cart::class)->name('cart');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
