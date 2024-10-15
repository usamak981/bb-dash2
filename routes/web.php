<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\UserController;

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


// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('images-not-found-count', [HomeController::class, 'imagesNotFoundCount'])->name('images-not-found-count');
Route::get('/objekts/{objekt}', [HomeController::class, 'show'])->name('objekts');
Route::get('/objekts-item/{objekt}', [HomeController::class, 'showVersionB'])->name('objekts-b');
Route::group(['middleware' => 'auth'], function (){

    // Two factor Routes
    Route::group(['middleware' => '2fa-check'], function () {
        Route::get('two-factor-auth', [TwoFactorAuthController::class, 'index'])->name('2fa.index');
        Route::post('two-factor-auth', [TwoFactorAuthController::class, 'store'])->name('2fa.store');
        Route::get('two-factor-auth/resent', [TwoFactorAuthController::class, 'resend'])->name('2fa.resend');
    });

    // Two factor Authenticated Routes
    Route::group(['middleware' => '2fa'], function () {
        Route::get('references/list-data',[ReferenceController::class,'indexData'])->name('references.index.data');
        Route::resource('references', ReferenceController::class);

        Route::get('users/list-data', [UserController::class, 'indexData'])->name('users.index.data');
        Route::get('users/reset-password/{user}', [UserController::class, 'resetPassword'])->name('users.reset.password');
        Route::put('users/reset-password/{user}', [UserController::class, 'updatePassword'])->name('users.update.password');

        Route::resource('pictures', ImageController::class)->only(['index', 'update', 'destroy']);
        Route::get('exports/filter-data',[ExportDataController::class,'filterObjekts'])->name('exports.filter.data');
        Route::get('exports/list-data',[ExportDataController::class,'indexData'])->name('exports.index.data');
        Route::get('exports/references',[ExportDataController::class,'exportReferences'])->name('exports.download.data');
        Route::resource('exports', ExportDataController::class);

        Route::resource('users', UserController::class)->except('show');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});
