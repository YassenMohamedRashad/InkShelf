<?php

use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\Home;
use App\Livewire\Search;
use App\Livewire\SingleBook;
use App\Livewire\TrackOrders;
use App\Livewire\UserInfo;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('/', Home::class)->name('home');
Route::get('/search', Search::class)->name('search');
Route::get('/book/{id}', SingleBook::class)->name('single-book');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('user-info', UserInfo::class)->name('user-info');
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/track-orders', TrackOrders::class)->name('track-orders');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
