<?php

use App\Http\Controllers\DomainController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', LandingController::class)->name('home');

// Domain Routes
Route::controller(DomainController::class)->group(function () {
    Route::get('/domains', 'index')->name('domains.search');
    Route::post('/domains/check', 'check')->name('domains.check');
    Route::get('/domains/register', 'showRegistrationForm')->name('domains.register.form');
    Route::post('/domains/register', 'register')->name('domains.register');
});
