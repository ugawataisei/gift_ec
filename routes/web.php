<?php

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

Route::get('/', function () {
    return view('user.welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth:users')->name('dashboard');

Route::prefix('items')->middleware('auth:users')->group(function () {
    Route::get('index', \App\Http\Actions\User\Item\ItemIndexAction::class)->name('item.index');
    Route::get('show/{id}', \App\Http\Actions\User\Item\ItemShowAction::class)->name('item.show');
});

require __DIR__ . '/auth.php';
