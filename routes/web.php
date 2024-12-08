<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoutesController;

Route::get('/admin', function () {
    return view('admin_landing'); 
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public routes
Route::get('/menu', [OrderController::class, 'showMenu'])->name('customer.menu');
Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [OrderController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/process_checkout', [OrderController::class, 'processCheckout'])->name('cart.process_checkout');
Route::get('/pay', [OrderController::class, 'checkout'])->name('cart.checkout');
Route::post('/orders/submit', [OrderController::class, 'submitOrder'])->name('orders.submit');
Route::get('/privacy', function () {
    return view('privacy'); 
});
Route::get('/aboutus', [RoutesController::class, 'showAbout'])->name('show.aboutus');

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/home', [AuthController::class, 'home'])->name('admin.home');


    Route::get('/admin/ongoing-orders', [OrderController::class, 'viewOngoingOrders'])->name('admin.ongoingOrders');
    Route::post('/admin/order/finish/{id}', [OrderController::class, 'finishOrder'])->name('admin.finishOrder');
    Route::post('/admin/order/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('admin.cancelOrder');

    // Reset and delete orders route
    Route::post('/admin/reset-orders', [OrderController::class, 'resetAndDeleteOrders'])->name('admin.resetAndDeleteOrders');

    Route::prefix('admin/menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::get('/create', [MenuController::class, 'create'])->name('admin.menu.create');
        Route::post('/store', [MenuController::class, 'store'])->name('admin.menu.store');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::post('/update/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
        Route::delete('/destroy/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
    });
});

Route::get('/', function () {
    return view('welcome');
});

