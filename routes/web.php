<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ApartmentController;
use App\Http\Middleware\TrackVisit;
use App\Http\Controllers\StatsController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/say/{message?}', [SiteController::class, 'say'])->name('site.say');
Route::get('/entry', [SiteController::class, 'entry'])->name('entry.form');
Route::post('/entry', [SiteController::class, 'entryStore'])->name('entry.store');
Route::view('/about', 'site.about')->name('site.about');
Route::view('/contact', 'site.contact')->name('site.contact');
Route::get('/realty', [SiteController::class, 'realty'])->name('realty.page');
Route::post('/realty/feedback', [SiteController::class, 'feedbackStore'])->name('realty.feedback');
Route::resource('country', CountryController::class);
Route::resource('apartment', ApartmentController::class);
Route::get('/stats', [StatsController::class, 'pages'])->name('stats.pages');
Route::get('/stats/detail', [StatsController::class, 'detail'])->name('stats.detail');
Route::get('/stats/search', [StatsController::class, 'searchStats'])->name('stats.search');