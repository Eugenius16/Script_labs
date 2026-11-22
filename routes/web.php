<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/say/{message?}', [SiteController::class, 'say'])->name('site.say');
Route::view('/about', 'site.about')->name('site.about');
Route::view('/contact', 'site.contact')->name('site.contact');


Route::get('/entry', [SiteController::class, 'entry'])->name('entry.form');
Route::post('/entry', [SiteController::class, 'entryStore'])->name('entry.store');


Route::get('/realty', [SiteController::class, 'realty'])->name('realty.page');
Route::post('/realty/feedback', [SiteController::class, 'feedbackStore'])->name('realty.feedback');


Route::resource('country', CountryController::class);


Route::get('/stats', [StatsController::class, 'pages'])->name('stats.pages');
Route::get('/stats/detail', [StatsController::class, 'detail'])->name('stats.detail');
Route::get('/stats/search', [StatsController::class, 'searchStats'])->name('stats.search');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/blog/admin', [BlogController::class, 'admin'])->name('blog.admin');
    Route::get('/blog/{blog}/tags', [BlogController::class, 'tags'])->name('blog.tags');
    Route::post('/blog/{blog}/tags', [BlogController::class, 'tagsStore'])->name('blog.tags.store');
    Route::resource('blog', BlogController::class)->except(['index', 'show']);

    Route::resource('filters', \App\Http\Controllers\FilterController::class)->except(['show']);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::resource('apartment', ApartmentController::class)->except(['index', 'show']);
});


Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/apartment', [ApartmentController::class, 'index'])->name('apartment.index');
Route::get('/apartment/{apartment}', [ApartmentController::class, 'show'])->name('apartment.show');

require __DIR__.'/auth.php';