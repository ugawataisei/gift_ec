<?php

use App\Http\Controllers\Owner\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Owner\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Owner\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Owner\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Owner\Auth\NewPasswordController;
use App\Http\Controllers\Owner\Auth\PasswordResetLinkController;
use App\Http\Controllers\Owner\Auth\RegisteredUserController;
use App\Http\Controllers\Owner\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

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
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth:owners')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


Route::get('/', function () {
    return view('owner.welcome');
});

Route::get('/dashboard', function () {
    return view('owner.dashboard');
})->middleware(['auth:owners'])->name('dashboard');

Route::prefix('shop')->middleware('auth:owners')->group(function () {
    Route::get('index', \App\Http\Actions\Owner\Shop\ShopIndexAction::class)->name('shop.index');
    Route::get('edit/{id}', \App\Http\Actions\Owner\Shop\ShopEditAction::class)->name('shop.edit');
    Route::post('update', \App\Http\Actions\Owner\Shop\ShopUpdateAction::class)->name('shop.update');
});

Route::prefix('image')->middleware('auth:owners')->group(function () {
    Route::get('index', App\Http\Actions\Owner\Image\ImageIndexAction::class)->name('image.index');
    Route::get('create', App\Http\Actions\Owner\Image\ImageCreateAction::class)->name('image.create');
    Route::get('edit/{id}', App\Http\Actions\Owner\Image\ImageEditAction::class)->name('image.edit');
    Route::post('update', App\Http\Actions\Owner\Image\ImageUpdateAction::class)->name('image.update');
    Route::post('store', App\Http\Actions\Owner\Image\ImageStoreAction::class)->name('image.store');
    Route::post('destroy', App\Http\Actions\Owner\Image\ImageDestroyAction::class)->name('image.destroy');
});

Route::prefix('product')->middleware('auth:owners')->group(function () {
    Route::get('index', App\Http\Actions\Owner\Product\ProductIndexAction::class)->name('product.index');
    Route::get('create', App\Http\Actions\Owner\Product\ProductCreateAction::class)->name('product.create');
    Route::get('edit/{id}', App\Http\Actions\Owner\Product\ProductEditAction::class)->name('product.edit');
    Route::post('update', App\Http\Actions\Owner\Product\ProductUpdateAction::class)->name('product.update');
    Route::post('store', App\Http\Actions\Owner\Product\ProductStoreAction::class)->name('product.store');
    Route::post('destroy', App\Http\Actions\Owner\Product\ProductDestroyAction::class)->name('product.destroy');
});
