<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product}', [HomeController::class, 'show'])->name('product.show');

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Customer Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/checkout/{product}', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
});

// Admin Protected Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])->name('products.destroy');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');
});