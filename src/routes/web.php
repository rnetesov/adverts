<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Cabinet\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('email/verify/{code}', [VerificationController::class, 'verify'])->name('email.verify');

Route::group([
    'prefix' => 'cabinet',
    'as' => 'cabinet.',
    'middleware' => 'auth'
], function () {
    Route::get('', [HomeController::class, 'index'])->name('home');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth'
], function () {
    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::match(['put', 'patch'],'/users/verify/{user}', [UserController::class, 'verify'])->name('users.verify');
    Route::resource('regions', RegionController::class);
    Route::resource('categories', CategoryController::class);
    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.',
    ], function () {
        Route::match(['put', 'patch'], 'categories/{category}/up', [CategoryController::class, 'up'])->name('up');
        Route::match(['put', 'patch'], 'categories/{category}/down', [CategoryController::class, 'down'])->name('down');
        Route::match(['put', 'patch'], 'categories/{category}/first', [CategoryController::class, 'first'])->name('first');
        Route::match(['put', 'patch'], 'categories/{category}/last', [CategoryController::class, 'last'])->name('last');
    });
});
