<?php

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
        Route::get('/test-books', function (GoogleBooksApi $googleBooksApi) {
            return $googleBooksApi->makeAPIRequest("subject: 'Science Fiction'");
        });
        Route::get('/test', function (GoogleBooksApi $googleBooksApi) {
            return $googleBooksApi->makeAPIRequest("علوم");
        });
        Route::get('/test-locale', function () {
            Book::create([
                'author_id' => Author::factory()->create()->id,
                'category_id' => Book_category::factory()->create()->id,
                'en' => [
                    'title' => 'Test Book',
                    'description' => 'Test Book Description',
                ],
                'ar' => [
                    'title' => 'الكتاب التجريبي',
                    'description' => 'وصف الكتاب التجريبي',
                ]
            ]);
        });
        require __DIR__ . '/auth.php';
    });
    // Registers routes to support the interactive components...
});
