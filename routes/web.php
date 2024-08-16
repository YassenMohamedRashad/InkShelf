<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\ProfileController;
use App\Models\Author;
use App\Models\Book;
use App\Models\Book_category;
use App\Services\GoogleBooksApi;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('splade')->group(function () {
    Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
        Route::spladeWithVueBridge();

        // Registers routes to support password confirmation in Form and Link components...
        Route::spladePasswordConfirmation();

        // Registers routes to support Table Bulk Actions and Exports...
        Route::spladeTable();

        // Registers routes to support async File Uploads with Filepond...
        Route::spladeUploads();

        Route::get('/', function () {
            return view('home');
        })->name('home');

        Route::middleware('auth')->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->middleware(['verified'])->name('dashboard');

            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });


        Route::get('/test', function (GoogleBooksApi $googleBooksApi) {
            $book = Book::find(1);
            $categories = $book->categories;
            return $categories;
        });


        Route::get('/live_search', [BooksController::class, 'live_search'])->name('books.live_search');

        require __DIR__ . '/auth.php';
    });
});
