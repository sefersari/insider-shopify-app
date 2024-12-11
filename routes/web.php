<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
})->middleware('auth');

Route::controller(AuthController::class)
    ->group(static function () {
        Route::get('app/login', 'loginView')
            ->name('login');

        Route::post('app/login', 'login')
            ->name('login-action');

        Route::get('app/register', 'registerView')
            ->name('register');

        Route::post('app/register', 'register')
            ->name('registerAction');

        Route::post('/logout', 'logout')->name('logout');
    });

Route::controller(SettingController::class)
    ->prefix('app/')
    ->group(static function () {
        Route::get('setting', 'index')
            ->name('settingView');

        Route::post('update', 'update');
    });

Route::controller(OrderController::class)
    ->prefix('app/')
    ->group(static function () {
        Route::get('orders', 'index')
            ->name('orderList');

        Route::get('fetch-orders', 'fetchOrders')
            ->name('orders');

        Route::get('fetch-marketplace-orders', 'fetchMarketPlaceOrders')
            ->name('fetchMarketPlaceOrders');

    });


