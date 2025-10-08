<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrivacyConsentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/consents', [App\Http\Controllers\Admin\ConsentController::class, 'index'])->name('admin.consents');
});

require __DIR__.'/auth.php';


Route::get('/', function () {
    return view('welcome');
});

Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

Route::post('/privacy-consent/accept', [PrivacyConsentController::class, 'accept'])->name('privacy.accept');
Route::post('/privacy-consent/decline', [PrivacyConsentController::class, 'decline'])->name('privacy.decline');



