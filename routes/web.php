<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminProductController;

// Public Routes (Auto-logout admin when visiting)
Route::middleware(['admin.clear'])->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/shop', [ProductController::class, 'index']);
    Route::get('/product/{slug}', [ProductController::class, 'show']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::post('/cart/remove', [CartController::class, 'remove']);

    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/place-order', [CheckoutController::class, 'placeOrder']);
});

// Admin Login Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout']);

// Protected Admin Routes
Route::middleware(['admin.auth'])->group(function() {
    
    Route::get('/admin/orders', function() {
        $orders = \App\Models\Order::with('customer', 'items')->latest()->get();
        return view('admin.orders', compact('orders'));
    });
    
    Route::patch('/admin/orders/{order}/status', function(\App\Models\Order $order) {
        $order->update(['status' => request('status')]);
        return back();
    });
    
    Route::delete('/admin/orders/{order}', function(\App\Models\Order $order) {
        $order->delete();
        return back();
    });

    Route::get('/admin/products', [AdminProductController::class, 'index']);
    Route::get('/admin/products/create', [AdminProductController::class, 'create']);
    Route::post('/admin/products', [AdminProductController::class, 'store']);
    Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit']);
    Route::put('/admin/products/{product}', [AdminProductController::class, 'update']);
    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy']);
});
