<?php

use App\Http\Controllers\Admin\DomainPricingController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\DomainRegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', LandingController::class)->name('home');

// Domain Routes
Route::controller(DomainController::class)->group(function () {
    Route::get('/domains', 'index')->name('domains.search');
    Route::post('/domains/check', 'search')->name('domains.search');
});

Route::prefix('domain')->middleware(['auth'])->group(function () {
    Route::get('/register', [DomainRegistrationController::class, 'index'])->name('domain.register');
    Route::post('/store', [DomainRegistrationController::class, 'register'])->name('domain.register.post');
});

// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin'], 'as' => 'admin.'], function () {
    Route::resource('domain-pricings', DomainPricingController::class);

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('domains', \App\Http\Controllers\Admin\DomainController::class)->except(['create', 'store']);

    Route::resource('users', UsersController::class);

    Route::resource('permissions', PermissionsController::class);

    Route::resource('roles', RolesController::class);

    Route::post('settings/media', [SettingController::class, 'storeMedia'])->name('settings.storeMedia');
    Route::post('settings/ckmedia', [SettingController::class, 'storeCKEditorImages'])->name('settings.storeCKEditorImages');
    Route::resource('settings', SettingController::class);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
        Route::post('profile/two-factor', [ChangePasswordController::class, 'toggleTwoFactor'])->name('password.toggleTwoFactor');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
