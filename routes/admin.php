<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
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

Route::middleware('auth:admin')->group(function () {
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
    return view('admin.welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth:admin')->name('dashboard');

Route::prefix('owners')->middleware('auth:admin')->group(function () {
    Route::get('index', \App\Http\Actions\Admin\Owner\OwnerIndexAction::class)->name('owner.index');
    Route::get('edit/{id}', \App\Http\Actions\Admin\Owner\OwnerEditAction::class)->name('owner.edit');
    Route::get('create', \App\Http\Actions\Admin\Owner\OwnerCreateAction::class)->name('owner.create');
    Route::post('update', \App\Http\Actions\Admin\Owner\OwnerUpdateAction::class)->name('owner.update');
    Route::post('store', \App\Http\Actions\Admin\Owner\OwnerStoreAction::class)->name('owner.store');
    Route::post('destroy', \App\Http\Actions\Admin\Owner\OwnerDestroyAction::class)->name('owner.destroy');
});

Route::prefix('expired-owners')->middleware('auth:admin')->group(function () {
    Route::get('index', \App\Http\Actions\Admin\ExpiredOwner\ExpiredOwnerIndexAction::class)->name('expired-owner.index');
    Route::post('destroy', \App\Http\Actions\Admin\ExpiredOwner\ExpiredOwnerDestroyAction::class)->name('expired-owner.destroy');
});
